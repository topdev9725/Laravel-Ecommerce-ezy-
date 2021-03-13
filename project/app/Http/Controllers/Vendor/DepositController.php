<?php

namespace App\Http\Controllers\Vendor;

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

    public function transactions() {
      	return view('vendor.transactions');
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

    public function transhow($id) {
      	$data = Transaction::find($id);
      	return view('load.transaction-details',compact('data'));
    }

}
