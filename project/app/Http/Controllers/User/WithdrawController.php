<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Support\Facades\Input;
use Validator;

class WithdrawController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

  	public function index()
    {
        $withdraws = Withdraw::where('user_id','=',Auth::guard('web')->user()->id)->where('type','=','user')->orderBy('id','desc')->get();
        $sign = Currency::where('is_default','=',1)->first();        
        return view('user.withdraw.index',compact('withdraws','sign'));
    }

    public function affilate_code()
    {
        $user = Auth::guard('web')->user();
        return view('user.withdraw.affilate_code',compact('user'));
    }
    
    public function affilate_users() {
        $user = Auth::guard('web')->user();
        $sup_user = null;
        if($user->sup_id>0) {
            $sup_user = User::findOrFail($user->sup_id);
        }
        $sub_users = User::where('sup_id', '=', $user->id)->where('is_vendor','=',0)->get();
        return view('user.withdraw.affilate_users', compact('user', 'sup_user', 'sub_users'));
    }
    
    public function get_affiliate_users(Request $request) {
        $user = Auth::guard('web')->user();
        $parent = $request->parent;
        $data = array();
        if ($user->id == 1) {
            $users = User::where('is_vendor','=',0)->where('sup_id', '=', 1)->get();
        } else {
            if(empty($parent) || $parent == '#') {
                $users = User::where('is_vendor','=',0)->where('id', '=', $user->id)->get();
            } else {
                $users = User::where('is_vendor','=',0)->where('sup_id', '=', $parent)->get();
            }
        }
        
        if($users->count()>0) {
            foreach($users as $user) {
                $children = User::where('is_vendor','=',0)->where('sup_id', '=', $user->id)->get()->count()>0;
                $icon = 'fas fa-user';
                if($children) $icon .= 's';
                $text = $user->name.' ('.$user->email.')';
                $text = mb_strlen($text,'utf-8') > 35 ? mb_substr($text,0,35,'utf-8').'...' : $text;
                $tmp = array(
                    'id' => $user->id,
                    'text' => $text,
                    'icon' => $icon.' icon-lg',
                    'children' => $children
                );
                if($parent == '#') $tmp['type'] = 'root';
                $data[] = $tmp;
            }
        }
        
        return response()->json($data);
    }


    public function create()
    {
        $sign = Currency::where('is_default','=',1)->first();
        return view('user.withdraw.withdraw' ,compact('sign'));
    }


    public function store(Request $request)
    {

        $from = User::findOrFail(Auth::guard('web')->user()->id);
        $curr = Currency::where('is_default','=',1)->first(); 
        $withdrawcharge = Generalsetting::findOrFail(1);
        $charge = $withdrawcharge->withdraw_fee;

        if($request->amount > 0){

            $amount = $request->amount;
            $amount = round(($amount / $curr->value),2);
            if ($from->affilate_income >= $amount){
                $fee = (($withdrawcharge->withdraw_charge / 100) * $amount) + $charge;
                $finalamount = $amount - $fee;
                if ($from->affilate_income >= $finalamount){
                $finalamount = number_format((float)$finalamount,2,'.','');

                $from->affilate_income = $from->affilate_income - $amount;
                $from->update();

                $newwithdraw = new Withdraw();
                $newwithdraw['user_id'] = Auth::guard('web')->user()->id;
                $newwithdraw['method'] = $request->methods;
                $newwithdraw['acc_email'] = $request->acc_email;
                $newwithdraw['iban'] = $request->iban;
                $newwithdraw['country'] = $request->acc_country;
                $newwithdraw['acc_name'] = $request->acc_name;
                $newwithdraw['address'] = $request->address;
                $newwithdraw['swift'] = $request->swift;
                $newwithdraw['reference'] = $request->reference;
                $newwithdraw['amount'] = $finalamount;
                $newwithdraw['fee'] = $fee;
                $newwithdraw['type'] = 'user';
                $newwithdraw->save();

                return response()->json('Withdraw Request Sent Successfully.'); 
            }else{
                return response()->json(array('errors' => [ 0 => 'Insufficient Balance.' ])); 

            }
            }else{
                return response()->json(array('errors' => [ 0 => 'Insufficient Balance.' ])); 

            }
        }
            return response()->json(array('errors' => [ 0 => 'Please enter a valid amount.' ])); 

    }
}
