<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\NewNotification;
use App\Models\AutodebitSubscription;
use App\Models\AutodebitOrder;
use App\Models\AutodebitInsurranceOrder;
use Auth;
use Session;

class AutoDebitController extends Controller
{
    public function autodebit(Request $request)
    {
        if (Auth::check()) {
            $ordered_autodebits = AutodebitOrder::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            $ordered_insurrances = AutodebitInsurranceOrder::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->get();

            return view('front.auto-debit', compact('ordered_autodebits', 'ordered_insurrances'));
        }
        return view('front.auto-debit');
    }

    public function storeshow()
    {
        $audodebit_stores = User::where('autodebit', 1)->pluck('shop_name');
        return json_encode($audodebit_stores);
    }

    public function getsubscription(Request $request)
    {
        $autodebit_name = $request->autodebit_name;
        $autodebit_store = User::where('shop_name', $autodebit_name)->first();
        $autodebit_subscriptions = AutoDebitSubscription::where('vendor_id', $autodebit_store->id)->get();
        Session::put('autodebit_subscriptions', $autodebit_subscriptions);

        if (Auth::check()) {
            $user_ordered_subscription = AutodebitOrder::where('user_id', Auth::user()->id)->where('vendor_id', $autodebit_store->id)->first();
            $user_ordered_insurrance = AutodebitInsurranceOrder::where('user_id', Auth::user()->id)->where('vendor_id', $autodebit_store->id)->first();
            if (!empty($user_ordered_subscription) || !empty($user_ordered_insurrance)) {
                return view('front.ajax-autodebit-subscription', compact('autodebit_subscriptions', 'autodebit_store', 'user_ordered_subscription', 'user_ordered_insurrance'));
            }
        }
        return view('front.ajax-autodebit-subscription', compact('autodebit_subscriptions', 'autodebit_store'));
    }

    public function ordersubscription(Request $request)
    {
        $term = $request->term;
        $description = $request->description;
        $subscription_id = $request->subscription_id;
        $shop_name = $request->shop_name;
        Session::put('shop_name', $shop_name);

        $autodebit_subscription = AutodebitSubscription::where('id', $subscription_id)->first();
        $user_ordered_shop = AutodebitOrder::where('user_id', Auth::user()->id)->where('vendor_id', $autodebit_subscription->vendor_id)->first();

        if (empty($user_ordered_shop)) {  //when no order in that shop
            $autodebit_order = new AutodebitOrder;
            $autodebit_order['user_id'] = Auth::user()->id;
            $autodebit_order['vendor_id'] = $autodebit_subscription->vendor_id;
            $autodebit_order['subscription_id'] = $autodebit_subscription->id;
            $autodebit_order['terms'] = $term;
            $autodebit_order['description'] = $description;
            $autodebit_order['status'] = 0;   //0-pending, 1-approve, 2-decline, 3-canceled, 4-expired
            $autodebit_order->save();
        } else {                            //when there is order in that shop
            $user_ordered_shop->terms = $term;
            $user_ordered_shop->description = $description;
            $user_ordered_shop->status = 0;
            $user_ordered_shop->subscription_id = $subscription_id;
            $user_ordered_shop->update();
        }

        return ['success' => true];
    }

    public function insurranceorder(Request $request)
    {
        $term = $request->term;
        $method = $request->method;
        $description = $request->description;
        $amount = $request->amount;
        $vendor_id = $request->vendor_id;
        Session::put('shop_name', User::where('id', '=', $vendor_id)->first()->shop_name);

        $user_ordered_shop = AutodebitInsurranceOrder::where('user_id', Auth::user()->id)->where('vendor_id', $vendor_id)->first();

        if (empty($user_ordered_shop)) {  //when no order in that shop
            $autodebit_order = new AutodebitInsurranceOrder;
            $autodebit_order['user_id'] = Auth::user()->id;
            $autodebit_order['vendor_id'] = $vendor_id;
            $autodebit_order['terms'] = $term;
            $autodebit_order['method'] = $method;
            $autodebit_order['amount'] = $amount;
            $autodebit_order['description'] = $description;
            $autodebit_order['status'] = 0;   //0-pending, 1-approve, 2-decline, 3-canceled, 4-expired
            $autodebit_order->save();
        } else {                            //when there is order in that shop
            $user_ordered_shop->terms = $term;
            $user_ordered_shop->method = $method;
            $user_ordered_shop->amount = $amount;
            $user_ordered_shop->description = $description;
            $user_ordered_shop->status = 0;
            $user_ordered_shop->update();
        }

        return ['success' => true];
    }
    
    public function removesubscription(Request $request)
    {
        $remove_subscription_id = $request->subscription_id;
        $shop_name = $request->shop_name;
        Session::put('shop_name', $shop_name);

        $autodebit_subscription = AutodebitSubscription::where('id', $remove_subscription_id)->first();
        // $user_ordered_shop = AutodebitOrder::where('user_id', Auth::user()->id)->where('vendor_id', $autodebit_subscription->vendor_id)->delete();
        $user_ordered_shop = AutodebitOrder::where('user_id', Auth::user()->id)->where('vendor_id', $autodebit_subscription->vendor_id)->first();
        $user_ordered_shop->status = 0;
        $user_ordered_shop->update();
        $notif = new NewNotification();
        $notif->sendautodebitcancelrequest($autodebit_subscription->vendor_id, Auth::user()->id);

        return ['success' => true];
    }

    public function removeinsurrance(Request $request)
    {
        $vendor_id = $request->vendor_id;
        Session::put('shop_name', User::where('id', '=', $vendor_id)->first()->shop_name);

        // AutodebitInsurranceOrder::where('user_id', Auth::user()->id)->where('vendor_id', $vendor_id)->delete();
        $user_ordered_shop = AutodebitInsurranceOrder::where('user_id', Auth::user()->id)->where('vendor_id', $vendor_id)->first();
        $user_ordered_shop->status = 0;
        $user_ordered_shop->update();
        $notif = new NewNotification();
        $notif->sendautodebitcancelrequest($vendor_id, Auth::user()->id);

        return ['success' => true];
    }

    public function autocategorystoreshow(Request $request)               // ---------------Ezy
    {
      $category_id = $request->category_id;

      if ($category_id != 0) { //when cateogory button press
        $vendors = User::whereIn('is_vendor', array(1,2))
                                ->where('autodebit', '=', 1)
                                ->where('category_id', 'like', '%'.','.$category_id.','.'%')
                                ->orwhere('category_id', 'like', '%'.'['.$category_id.','.'%')
                                ->orwhere('category_id', 'like', '%'.','.$category_id.']'.'%')
                                ->orwhere('category_id', 'like', '%'.'['.$category_id.']'.'%')
                                ->get();
        // $category_info = Category::where('id', '=', $category_id)->first();
      } else {
        $vendors = User::whereIn('is_vendor', array(1,2))->where('autodebit', '=', 1)->get();
        // $category_info = '';
      }

      if($request->ajax()) {  //when show all button press
        return view('front.ajax-nearby-autodebit-show', compact('vendors'));
      }

      return view('front.auto-debit', compact('vendors'));
    }
}
