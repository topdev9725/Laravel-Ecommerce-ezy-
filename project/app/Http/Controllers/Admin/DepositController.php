<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\GeniusMailer;
use App\Models\Generalsetting;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Currency;
use App\Models\Transaction;
use App\Models\NewNotification;
use Session;
use Auth;
use Datatables;
use App\Classes\Common;

class DepositController extends Controller
{
    public function __construct(){      
      	$this->middleware('auth:admin');
    }
    public function stripe() {
      	return view('admin.deposit.stripe');
    }

    //*** JSON Request
    public function stripe_datatables()
    {
         $datas = Deposit::where('method','=','stripe')->orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
				->addColumn('user_name', function(Deposit $data) {
					$user = User::findOrFail($data->user_id);
					$name = '';
					if($user) $name = $user->name;
					return $name;
				})
				->addColumn('email', function(Deposit $data) {
					$user = User::findOrFail($data->user_id);
					$email = '';
					if($user) $email = $user->email;
					return $email;
				})
				->editColumn('amount', function(Deposit $data) {
					return Common::formatPrice($data->amount);
				})
				->editColumn('created_at', function(Deposit $data) {
					$created_at = date('d-M-Y',strtotime($data->created_at));
					return $created_at;
				})
				->editColumn('status', function(Deposit $data) {	
					$status = ['pending', 'completed'];
					return '<span class="deposit-status '.strtolower($status[$data->status]).'">'.$status[$data->status].'</span>';
				}) 
				->editColumn('updated_at', function(Deposit $data) {
					$updated_at = date('d-M-Y',strtotime($data->updated_at));
					if($data->status != 1) $updated_at = '';
					return $updated_at;
				})
				->addColumn('action', function(Deposit $data) {
					return '';
					
				}) 
				->rawColumns(['user_name','email','status','action'])
				->toJson(); //--- Returning Json Data To Client Side
	}
	
	//*** JSON Request
    public function bank_datatables()
    {
         $datas = Deposit::where('method','=','bank')->orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
				->addColumn('user_name', function(Deposit $data) {
					$user = User::findOrFail($data->user_id);
					$name = '';
					if($user) $name = $user->name;
					return $name;
				})
				->addColumn('email', function(Deposit $data) {
					$user = User::findOrFail($data->user_id);
					$email = '';
					if($user) $email = $user->email;
					return $email;
				})
				->editColumn('amount', function(Deposit $data) {
					return Common::formatPrice($data->amount);
				})
				->editColumn('photo', function(Deposit $data) {
					if (!empty($data->photo)) {
						return '<div><img src="'.url('/assets/images/users/'.$data->photo).'"/></div>';
					} else {
						return '<div>No image</div>';
					}
					
				})
				->editColumn('created_at', function(Deposit $data) {
					$created_at = date('d-M-Y',strtotime($data->created_at));
					return $created_at;
				})
				->editColumn('status', function(Deposit $data) {	
					$status = ['pending', 'completed'];
					return '<span class="deposit-status '.strtolower($status[$data->status]).'">'.$status[$data->status].'</span>';
				}) 
				->editColumn('updated_at', function(Deposit $data) {
					$updated_at = date('d-M-Y',strtotime($data->updated_at));
					if($data->status != 1) $updated_at = '';
					return $updated_at;
				})
				->addColumn('action', function(Deposit $data) {
					if($data->status==0 && strtolower($data->method)=='bank') {
						return '<div class="action-list">
							<a href="javascript:;" data-href="' . route('admin-deposit-get') . '" data-id="'.$data->id.'" data-toggle="modal" data-target="#edit-modal" class="update"><i class="fas fa-edit"></i>Edit</a>
							<a href="javascript:;" data-href="' . route('admin-deposit-complete', $data->id) . '" data-toggle="modal" data-target="#confirm-complete" class="delete"><i class="fas fa-check"></i>Complete</a>
							</div>';
					} else {
						return '';
					}
					
				}) 
				->rawColumns(['user_name','email','photo','status','action'])
				->toJson(); //--- Returning Json Data To Client Side
    }


    public function bank() {
      	return view('admin.deposit.bank');
	}

	public function surepay() {
			return view('admin.deposit.surepay');
	}

	public function surepay_datatables()
    {
		$datas = Deposit::where('method','=','surepay')->orderBy('id','desc')->get();
		//--- Integrating This Collection Into Datatables
		return Datatables::of($datas)
			   ->addColumn('user_name', function(Deposit $data) {
				   $user = User::findOrFail($data->user_id);
				   $name = '';
				   if($user) $name = $user->name;
				   return $name;
			   })
			   ->addColumn('email', function(Deposit $data) {
				   $user = User::findOrFail($data->user_id);
				   $email = '';
				   if($user) $email = $user->email;
				   return $email;
			   })
			   ->editColumn('amount', function(Deposit $data) {
				   return Common::formatPrice($data->amount);
			   })
			   ->editColumn('created_at', function(Deposit $data) {
				   $created_at = date('d-M-Y',strtotime($data->created_at));
				   return $created_at;
			   })
			   ->editColumn('status', function(Deposit $data) {	
				   $status = ['pending', 'completed'];
				   return '<span class="deposit-status '.strtolower($status[$data->status]).'">'.$status[$data->status].'</span>';
			   }) 
			   ->editColumn('updated_at', function(Deposit $data) {
				   $updated_at = date('d-M-Y',strtotime($data->updated_at));
				   if($data->status != 1) $updated_at = '';
				   return $updated_at;
			   })
			   ->addColumn('action', function(Deposit $data) {
				   if($data->status==0 && strtolower($data->method)=='surepay') {
					   return '<div class="action-list">
						   <a href="javascript:;" data-href="' . route('admin-deposit-get') . '" data-id="'.$data->id.'" data-toggle="modal" data-target="#edit-modal" class="update"><i class="fas fa-edit"></i>Edit</a>
						   <a href="javascript:;" data-href="' . route('admin-deposit-complete', $data->id) . '" data-toggle="modal" data-target="#confirm-complete" class="delete"><i class="fas fa-check"></i>Complete</a>
						   </div>';
				   } else {
					   return '';
				   }
				   
			   }) 
			   ->rawColumns(['user_name','email','status','action'])
			   ->toJson(); //--- Returning Json Data To Client Side

	}

	public function get_deposit(Request $request) {
		$id = $request->id;
		if($id) {
			$deposit = Deposit::findOrFail($id);
			if($deposit) {
				$user = User::findOrFail($deposit->user_id);
				$deposit->user_name = $user->name;
			}
			return response()->json($deposit); 
		}
		return null;
	}

	public function update(Request $request) {
		$id = $request->id;
		if($id) {
			$deposit = Deposit::findOrFail($id);
			$amount = $request->amount;
			if($deposit) {				
				$deposit->amount = $amount;
				$deposit->update();
			}
			$msg = 'Deposit Amount has been updated successfully.';
        	return response()->json($msg); 
		}
		return null;
	}
	
	public function complete($id) {
		$data = Deposit::findOrFail($id);
		$data->status = 1;
		$data->update();
		$user = User::findOrFail($data->user_id);
		$user->balance += (double)$data->amount;
		$user->update();

		//Notification
		$notif = new NewNotification();
		$notif->setDepositNotification($data);		
		
		//Transaction
		$transaction = new Transaction;
		$transaction->txn_number = str_random(3).substr(time(), 6,8).str_random(3);		
		$transaction->amount = $data->amount;
		$transaction->user_id = $data->user_id;
		$transaction->currency_sign = $data->currency;
		$transaction->currency_code = $data->currency_code;
		$transaction->currency_value= $data->currency_value;
		$transaction->method = $data->method;
		$transaction->txnid = $data->txnid;
		$transaction->details = 'Payment Deposit';
		$transaction->type = 'plus';
		$transaction->save();
		
		//Mailing
		$settings = Generalsetting::findOrFail(1);
		if($settings->is_smtp == 1){
			$data = [
				'to' => $user->email,
				'type' => "wallet_deposit",
				'cname' => $user->name,
				'damount' => $data->amount,
				'wbalance' => $user->balance,
				'oamount' => "",
				'aname' => "",
				'aemail' => "",
				'onumber' => "",
			];
			$mailer = new GeniusMailer();
			$mailer->sendAutoMail($data);
		}else{
			$headers = "From: ".$settings->from_name."<".$settings->from_email.">";
			@mail($user->email,'Balance has been added to your account. Your current balance is: RM' . $user->balance, $headers);
		}
        //--- Redirect Section     
        $msg = 'Deposit Request has been completed successfully.';
        return response()->json($msg); 
	}
}
