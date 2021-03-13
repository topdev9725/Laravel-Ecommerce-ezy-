<?php

namespace App\Http\Controllers\Vendor;

use App\Models\User;
use App\Models\AutodebitOrder;
use App\Models\AutodebitInsurranceOrder;
use App\Models\AutodebitSubscription;
use App\Models\Generalsetting;
use Auth;
use App\Models\Currency;
use App\Models\NewNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use App\Classes\Common;

class AutodebitOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //*** JSON Request
    public function datatables(Request $request)
    {
        $pending = $request->pending;
        if(!isset($pending)) $pending = 0;
        if($pending)
            $datas = AutodebitOrder::where('vendor_id','=', Auth::guard('web')->user()->id)->where('status','=',0)->orderBy('created_at', 'DESC')->get();        
        else
            $datas = AutodebitOrder::where('vendor_id','=', Auth::guard('web')->user()->id)->orderBy('created_at', 'DESC')->get();        
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                ->addColumn('user_name', function(AutodebitOrder $data) {
                    $user = User::findOrFail($data->user_id);
                    return $user->name;
                })
                ->addColumn('email', function(AutodebitOrder $data) {
                    $user = User::findOrFail($data->user_id);
                    return $user->email;
                })
                ->addColumn('title', function(AutodebitOrder $data) {
                    $subscription = AutodebitSubscription::findOrFail($data->subscription_id);
                    $method = ['monthly'=>'Monthly', 'quarter'=>'Quarter', 'half_year'=>'Half Year', 'yearly'=>'Year'];
                    return $subscription->title.' / '.$method[$subscription->method];
                })
                ->addColumn('cost', function(AutodebitOrder $data) {
                    $subscription = AutodebitSubscription::findOrFail($data->subscription_id);
                    return Common::formatPrice($subscription->cost);
                })
                ->editColumn('created_at', function(AutodebitOrder $data) {
                    $created_at = date('d-M-Y',strtotime($data->created_at));
					return $created_at;
                })
				->addColumn('action', function(AutodebitOrder $data) {
                    $status = ['pending', 'approved', 'declined'];                    
                    if($data->status == 3) {
                        return '<span class="status_canceled">Canceled</span>';
                    } else if($data->status == 4) {
                            return '<span class="status_canceled">Expired</span>';
                    } else {
                        return '<select class="vendor-btn '.$status[$data->status].'">
                        <option value="'.route('vendor-autodebit-order-status',['slug' => $data->id, 'status' => 'pending']).'" '.($data->status == 0 ? 'selected' : "").'>Pending</option>
                        <option value="'.route('vendor-autodebit-order-status',['slug' => $data->id, 'status' => 'approved']).'" '.($data->status == 1 ? 'selected' : "").'>Approved</option>
                        <option value="'.route('vendor-autodebit-order-status',['slug' => $data->id, 'status' => 'declined']).'" '.($data->status == 2 ? 'selected' : "").'>Declined</option>
                        <option value="'.route('vendor-autodebit-order-status',['slug' => $data->id, 'status' => 'cancel']).'" '.($data->status == 3 ? 'selected' : "").'>Cancel</option>
                        </select>';
                    }
				}) 
				->rawColumns(['user_name', 'email', 'title', 'cost', 'duration', 'action'])
				->toJson(); //--- Returning Json Data To Client Side
    }

    //*** JSON Request
    public function insurrancedatatables(Request $request)
    {
        $pending = $request->pending;
        if(!isset($pending)) $pending = 0;
        if($pending)
            $datas = AutodebitInsurranceOrder::where('vendor_id','=', Auth::guard('web')->user()->id)->where('status','=',0)->orderBy('created_at', 'DESC')->get();        
        else
            $datas = AutodebitInsurranceOrder::where('vendor_id','=', Auth::guard('web')->user()->id)->orderBy('created_at', 'DESC')->get();        
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                ->addColumn('user_name', function(AutodebitInsurranceOrder $data) {
                    $user = User::findOrFail($data->user_id);
                    return $user->name;
                })
                ->addColumn('email', function(AutodebitInsurranceOrder $data) {
                    $user = User::findOrFail($data->user_id);
                    return $user->email;
                })
                ->addColumn('title', function(AutodebitInsurranceOrder $data) {
                    // $subscription = AutodebitSubscription::findOrFail($data->subscription_id);
                    $method = ['monthly'=>'Monthly', 'quarter'=>'Quarter', 'half_year'=>'Half Year', 'yearly'=>'Year'];
                    return $method[$data->method];
                })
                ->addColumn('cost', function(AutodebitInsurranceOrder $data) {
                    // $subscription = AutodebitSubscription::findOrFail($data->subscription_id);
                    return Common::formatPrice($data->amount);
                })
                ->editColumn('created_at', function(AutodebitInsurranceOrder $data) {
                    $created_at = date('d-M-Y',strtotime($data->created_at));
					return $created_at;
                })
				->addColumn('action', function(AutodebitInsurranceOrder $data) {
                    $status = ['pending', 'approved', 'declined'];                    
                    if($data->status == 3) {
                        return '<span class="status_canceled">Canceled</span>';
                    } else if($data->status == 4) {
                            return '<span class="status_canceled">Expired</span>';
                    } else {
                        return '<select class="vendor-btn '.$status[$data->status].'">
                        <option value="'.route('vendor-autodebit-insurrance-order-status',['slug' => $data->id, 'status' => 'pending']).'" '.($data->status == 0 ? 'selected' : "").'>Pending</option>
                        <option value="'.route('vendor-autodebit-insurrance-order-status',['slug' => $data->id, 'status' => 'approved']).'" '.($data->status == 1 ? 'selected' : "").'>Approved</option>
                        <option value="'.route('vendor-autodebit-insurrance-order-status',['slug' => $data->id, 'status' => 'declined']).'" '.($data->status == 2 ? 'selected' : "").'>Declined</option>
                        <option value="'.route('vendor-autodebit-insurrance-order-status',['slug' => $data->id, 'status' => 'cancel']).'" '.($data->status == 3 ? 'selected' : "").'>Cancel</option>
                        </select>';
                    }
				}) 
				->rawColumns(['user_name', 'email', 'title', 'cost', 'duration', 'action'])
				->toJson(); //--- Returning Json Data To Client Side
    }

  	public function index()
    {   
        return view('vendor.autodebit_orders.index');
    }

    public function insurrance()
    {   
        return view('vendor.autodebit_insurrance_orders.index');
    }

    public function pending()
    {   
        return view('vendor.autodebit_orders.pending');
    }

    public function insurrancepending()
    {   
        return view('vendor.autodebit_insurrance_orders.pending');
    }

    public function status($id, $status, Request $request)
    {
        $order = AutodebitOrder::where('id','=', $id)->first();
        // if ($order->status == 1){
        //     return redirect()->back()->with('success','This Order is Already Approved');
        // } else if($order->status == 3) {
        //     return redirect()->back()->with('success','This Order is Already Canceled');
        // } else if($order->status == 4) {
        //     return redirect()->back()->with('success','This Order is Already Expired');
        // }else{
            $vendor = Auth::user();
            $statuses = ['pending'=>0, 'approved'=>1, 'declined'=>2, 'cancel'=>3];
            $order->status = $statuses[$status];
            $order->update();
            if ($status == 'approved') {
                $sub_cost = AutodebitSubscription::where('id', $order->subscription_id)->first()->cost;
                $vendor->balance = $vendor->balance + $sub_cost;
                $vendor->save();
                $user = User::where('id', $order->user_id)->first();
                $user->balance = $user->balance - $sub_cost;
                $user->save();
            }
            if ($status == 'cancel') {
                AutodebitOrder::where('id', $id)->delete();
            }
            $notif = new NewNotification();
            $notif->setAutodebitOrderNotification($order);
            $pending = $request->pending;
            if(!isset($pending)) $pending = 0;
            if($pending)
                return redirect()->route('vendor-autodebit-order-pending')->with('success','Order Status Updated Successfully');
            else
                return redirect()->route('vendor-autodebit-order-index')->with('success','Order Status Updated Successfully');
        // }
    }

    public function insurrancestatus($id, $status, Request $request)
    {
        $order = AutodebitInsurranceOrder::where('id','=', $id)->first();
        if ($order->status == 1){
            return redirect()->back()->with('success','This Order is Already Approved');
        } else if($order->status == 3) {
            return redirect()->back()->with('success','This Order is Already Canceled');
        } else if($order->status == 4) {
            return redirect()->back()->with('success','This Order is Already Expired');
        }else{
            $vendor = Auth::user();
            $statuses = ['pending'=>0, 'approved'=>1, 'declined'=>2, 'cancel'=>3];
            $order->status = $statuses[$status];
            $order->update();
            if ($status == 'approved') {
                $sub_cost = $order->amount;
                $vendor->balance = $vendor->balance + $sub_cost;
                $vendor->save();
                $user = User::where('id', $order->user_id)->first();
                $user->balance = $user->balance - $sub_cost;
                $user->save();
            }
            if ($status == 'cancel') {
                AutodebitInsurranceOrder::where('id', $id)->delete();
            }
            $notif = new NewNotification();
            $notif->setAutodebitOrderNotification($order);
            $pending = $request->pending;
            if(!isset($pending)) $pending = 0;
            if($pending)
                return redirect()->route('vendor-autodebit-order-pending')->with('success','Order Status Updated Successfully');
            else
                return redirect()->route('vendor-autodebit-order-index')->with('success','Order Status Updated Successfully');
        }
    }

}
