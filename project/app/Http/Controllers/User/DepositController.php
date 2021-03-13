<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting as GS;
use App\Models\Generalsetting;
use App\Models\Deposit;
use App\Classes\GeniusMailer;
use App\Models\Currency;
use App\Models\Transaction;
use Session;
use Auth;
use Datatables;
use App\Classes\Common;

class DepositController extends Controller
{
    public function __construct(){      
      $this->middleware('auth');
    }
    public function index() {
      return view('user.deposit.index');
    }

    public function tran_datatables() {
      	$datas = Transaction::where('user_id','=', Auth::guard('web')->user()->id)->orderBy('created_at', 'DESC')->get();
         //--- Integrating This Collection Into Datatables
		 return Datatables::of($datas)
		 		->editColumn('amount', function(Transaction $data) {
					$return = $data->type == 'plus' ? '+' : '-';
					$return .= Common::formatPrice($data->amount);
					return $return;
				})
				->editColumn('created_at', function(Transaction $data) {
					return date('d-M-Y',strtotime($data->created_at));
				})				
				->addColumn('action', function(Transaction $data) {
					if($data->method != 'cashback')
						return '<div class="action-list"><a href="javascript:;" data-href="'.route('user-trans-show',$data->id).'" data-toggle="modal" data-target="#trans-modal" class="txn-show mybtn1 sm sm1">View Details</a></div>';
					else
						return '';
				}) 
				->rawColumns(['details','action'])
				->toJson(); //--- Returning Json Data To Client Side
    }

    public function transactions() {
      return view('user.transactions');
    }

    public function transhow($id)
    {
      $data = Transaction::find($id);
      return view('load.transaction-details',compact('data'));
    }

    public function create() {      
      if (Session::has('currency'))
      {
        $data['curr'] = Currency::find(Session::get('currency'));
      }
      else
      {
        $data['curr'] = Currency::where('is_default','=',1)->first();
      }
      $data['gs'] = GS::first();
      return view('user.deposit.create', $data);
    }

    public function bank(Request $request) {
      $user = Auth::user();
      $settings = Generalsetting::findOrFail(1);
      $item_name = "Deposit Via Bank";
      $item_amount = $request->amount;
      if (Session::has('currency'))
      {
          $curr = Currency::find(Session::get('currency'));
      }
      else
      {
          $curr = Currency::where('is_default','=',1)->first();
      }
      echo $request->file('photo');
      if ($file = $request->file('photo')) 
      {       
          $name = time().$request->photo->getClientOriginalName();
          $file->move('assets/images/users/', $name);
          if($user->photo != null)
          {
              if (file_exists(public_path().'/assets/images/users/'.$user->photo)) {
                  unlink(public_path().'/assets/images/users/'.$user->photo);
              }
          }            
      } 
      $tax = $settings->bank_tax;
      $amount = $request->amount/(1+$tax/100);
      $deposit = new Deposit;
      $deposit->user_id = $user->id;
      $deposit->currency = $curr->sign;
      $deposit->currency_code = $curr->name;
      $deposit->currency_value = $curr->value;
      $deposit->amount = $amount / $curr->value;
      $deposit->reference_id = $request->reference_id;
      $deposit->method = 'Bank';
      $deposit->txnid = 'txn_'.str_random(4).time();
      $deposit->status = 0;
      if ($file = $request->file('photo')) {
        $deposit->photo = $name;
      }
      $deposit->save();
      return redirect()->route('user-dashboard')->with('success','Bank Deposit has been requested.');
    }

    public function surepaysuccess(Request $request) {
      $user = Auth::user();
      $settings = Generalsetting::findOrFail(1);
      $item_name = "Deposit Via Surepay";
      $item_amount = $request->amount;
      if (Session::has('currency'))
      {
          $curr = Currency::find(Session::get('currency'));
      }
      else
      {
          $curr = Currency::where('is_default','=',1)->first();
      }
      $tax = $settings->surepay_tax;
      $amount = $request->amount/(1+$tax/100);
      $deposit = new Deposit;
      $deposit->user_id = $user->id;
      $deposit->currency = $curr->sign;
      $deposit->currency_code = $curr->name;
      $deposit->currency_value = $curr->value;
      $deposit->amount = $amount / $curr->value;
      $deposit->reference_id = time();
      $deposit->method = 'Surepay';
      $deposit->txnid = 'txn_'.str_random(4).time();
      $deposit->status = 0;
      $deposit->save();
      return redirect()->route('user-dashboard')->with('success','Surepay Deposit has been requested.');
    }

    public function surepayerrormsg(Request $request) {
      $status = $request->status;
      if ($status == 0) {
          return redirect()->route('user-dashboard')->with('unsuccess','Unknown.');
      } elseif ($status == 1) {
          return redirect()->route('user-dashboard')->with('unsuccess','Accepted.');
      } elseif ($status == -1) {
          return redirect()->route('user-dashboard')->with('unsuccess','Rejected.');
      } elseif ($status == -2) {
          return redirect()->route('user-dashboard')->with('unsuccess','Error.');
      }
    }

    public function md5token(Request $request) {
      $token = md5($request->token);
      return ['token' => $token];
    }
}
