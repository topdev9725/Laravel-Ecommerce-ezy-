<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting as GS;
use App\Models\Generalsetting;
use App\Models\User;
use App\Classes\GeniusMailer;
use App\Models\Currency;
use App\Models\Transaction;
use App\Models\NewNotification;
use App\Models\ScanAndPay;
use Session;
use Auth;
use Datatables;
use App\Classes\Common;
use Illuminate\Support\Facades\Hash;
use App\Classes\Affiliate;

class ScanpayController extends Controller
{
    public function __construct(){      
      	
	}
	
    public function index($id) {		
		if(empty($id)) {
			return view('errors.404');
		}
		$vendor = User::findOrFail($id);
		if(!$vendor) {
			return view('errors.404');
		}		
		$user = Auth::guard('web')->user();
      	return view('user.scanpay.index', compact('vendor', 'user'));
	}
	
	public function pay(Request $request) {
		$this->middleware('auth');
		$user = Auth::guard('web')->user();
		$vendor = User::findOrFail($request->vendor_id);
		$amount = $request->amount;
		$password = $request->password;
		if(!$vendor || !$amount || !$password) {
			return response()->json(['error'=>'Invalie Request']);
		}
		if($amount > $user->balance) {
			return response()->json(['error'=>'Insufficient Balance']);
		}
		if (!Hash::check($password, $user->password)) {
			return response()->json(['error'=>'Invalid Password']);
		}
		$user->balance -= $amount;
		$user->update();
		Session::put('payment_amount', $amount);
		$vendor->balance += $amount;
		$vendor->update();

		$sign = Currency::where('is_default','=',1)->first();
        $transaction = new Transaction;
        $transaction->txn_number = str_random(3).substr(time(), 6,8).str_random(3);
        $transaction->amount = $amount;
        $transaction->user_id = $user->id;
        $transaction->currency_sign = $sign->sign;
        $transaction->currency_code = $sign->name;
        $transaction->currency_value = $sign->value;
        $transaction->method = 'scanpay';
        $transaction->txnid = null;
        $transaction->details = 'Debit by Scan & Pay';
        $transaction->type = 'minus';
		$transaction->save();

		$scanpay = new ScanAndPay;
		$scanpay->user_id = $user->id;		
		$scanpay->vendor_id = $vendor->id;
		$scanpay->amount = $amount;
		$scanpay->save();

		$transaction = new Transaction;
        $transaction->txn_number = str_random(3).substr(time(), 6,8).str_random(3);
        $transaction->amount = $amount;
        $transaction->user_id = $vendor->id;
        $transaction->currency_sign = $sign->sign;
        $transaction->currency_code = $sign->name;
        $transaction->currency_value = $sign->value;
        $transaction->method = 'scanpay';
        $transaction->txnid = null;
        $transaction->details = '<b>'.$user->name.'</b> paid by scan';
        $transaction->type = 'plus';
		$transaction->save();
		
		$notif = new NewNotification;
		$notif->setScanPayNotification($user, $vendor, $amount);

		return response()->json(1);
	}

	public function addPinCode(Request $request) {
		$this->middleware('auth');
		$user = Auth::guard('web')->user();
		$pin_code = $request->pin_code;
		$password = $request->password;
		if(!$pin_code) {
			return response()->json(['error'=>'Please Enter Pin Code']);
		}
		if (!Hash::check($password, $user->password)) {
			return response()->json(['error'=>'Incorrect Password']);
		}
		$user->pin_code = bcrypt($pin_code);
		$user->update();
		return response()->json(1);
	}

	public function success($id) {
		$this->middleware('auth');
		$user = Auth::guard('web')->user();
		$vendor = User::findOrFail($id);
		return view('user.scanpay.success', compact('vendor', 'user'));
	}

}
