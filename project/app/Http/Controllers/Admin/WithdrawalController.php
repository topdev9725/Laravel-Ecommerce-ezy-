<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Common;
use App\Models\User;
use App\Models\Withdraw;
use App\Models\Province;
use Auth;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use DB;

class WithdrawalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

  	public function online()
    {        
        return view('admin.withdrawal.online');
    }

    //*** JSON Request
    public function datatables_online()
    {
         $datas = Withdraw::select('withdraws.*', DB::raw('users.shop_name, users.owner_name'))->leftJoin('users', function($join) {
            $join->on('withdraws.user_id', '=', 'users.id');
          })->where('users.online','=',1)->where('type', '=', 'vendor')->orderBy('created_at', 'desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)                
                ->editColumn('amount', function(Withdraw $data) {
                    return Common::formatPrice($data->amount);
                })
                ->editColumn('created_at', function(Withdraw $data) {
					$created_at = date('d-M-Y',strtotime($data->created_at));
					return $created_at;
                })
                ->editColumn('status', function(Withdraw $data) {
                    $status = ['pending'=>'Pending', 'completed'=>'Completed', 'rejected'=>'Rejected'];
					return '<span class="withdraw-status '.$data->status.'">'.$status[$data->status].'</span>';
				}) 
				->addColumn('action', function(Withdraw $data) {
                    if($data->status == 'pending') {
                        return '<div class="action-list"><a href="javascript:;" data-href="' . route('admin-withdrawal-complete',$data->id) . '"  class="complete" data-toggle="modal" data-target="#confirm-complete"><i class="fa fa-check"></i> Complete</a><a href="javascript:;" data-href="' . route('admin-withdrawal-reject',$data->id) . '" class="reject" data-toggle="modal" data-target="#confirm-reject"><i class="fa fa-times"></i> Reject</a></div>';
                    } else {
                        return '';
                    }
				}) 
				->rawColumns(['status', 'action'])
				->toJson(); //--- Returning Json Data To Client Side
    }

    public function nearby()
    {        
        return view('admin.withdrawal.nearby');
    }

    //*** JSON Request
    public function datatables_nearby()
    {
         $datas = Withdraw::select('withdraws.*', DB::raw('users.shop_name, users.owner_name'))->leftJoin('users', function($join) {
            $join->on('withdraws.user_id', '=', 'users.id');
          })->where('users.nearby','=',1)->where('type', '=', 'vendor')->orderBy('created_at', 'desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)                
                ->editColumn('amount', function(Withdraw $data) {
                    return Common::formatPrice($data->amount);
                })
                ->editColumn('created_at', function(Withdraw $data) {
					$created_at = date('d-M-Y',strtotime($data->created_at));
					return $created_at;
                })
                ->editColumn('status', function(Withdraw $data) {
                    $status = ['pending'=>'Pending', 'completed'=>'Completed', 'rejected'=>'Rejected'];
					return '<span class="withdraw-status '.$data->status.'">'.$status[$data->status].'</span>';
				}) 
				->addColumn('action', function(Withdraw $data) {
					if($data->status == 'pending') {
                        return '<div class="action-list"><a href="javascript:;" data-href="' . route('admin-withdrawal-complete',$data->id) . '"  class="complete" data-toggle="modal" data-target="#confirm-complete"><i class="fa fa-check"></i> Complete</a><a href="javascript:;" data-href="' . route('admin-withdrawal-reject',$data->id) . '" class="reject" data-toggle="modal" data-target="#confirm-reject"><i class="fa fa-times"></i> Reject</a></div>';
                    } else {
                        return '';
                    }
				}) 
				->rawColumns(['status', 'action'])
				->toJson(); //--- Returning Json Data To Client Side
    }

    public function autodebit()
    {        
        return view('admin.withdrawal.autodebit');
    }

    //*** JSON Request
    public function datatables_autodebit()
    {
         $datas = Withdraw::select('withdraws.*', DB::raw('users.shop_name, users.owner_name'))->leftJoin('users', function($join) {
            $join->on('withdraws.user_id', '=', 'users.id');
          })->where('users.autodebit','=',1)->where('type', '=', 'vendor')->orderBy('created_at', 'desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)                
                ->editColumn('amount', function(Withdraw $data) {
                    return Common::formatPrice($data->amount);
                })
                ->editColumn('created_at', function(Withdraw $data) {
					$created_at = date('d-M-Y',strtotime($data->created_at));
					return $created_at;
                })
                ->editColumn('status', function(Withdraw $data) {
                    $status = ['pending'=>'Pending', 'completed'=>'Completed', 'rejected'=>'Rejected'];
					return '<span class="withdraw-status '.$data->status.'">'.$status[$data->status].'</span>';
				}) 
				->addColumn('action', function(Withdraw $data) {
                    if($data->status == 'pending') {
                        return '<div class="action-list"><a href="javascript:;" data-href="' . route('admin-withdrawal-complete',$data->id) . '"  class="complete" data-toggle="modal" data-target="#confirm-complete"><i class="fa fa-check"></i> Complete</a><a href="javascript:;" data-href="' . route('admin-withdrawal-reject',$data->id) . '" class="reject" data-toggle="modal" data-target="#confirm-reject"><i class="fa fa-times"></i> Reject</a></div>';
                    } else {
                        return '';
                    }
				}) 
				->rawColumns(['status', 'action'])
				->toJson(); //--- Returning Json Data To Client Side
    }

    public function complete($id) {
        $data = Withdraw::findOrFail($id);
        $data->status = 'completed';
        $data->update();
        $msg = 'Withdrawal Request has been Completed Successfully.';
        return response()->json($msg); 
    }

    public function reject($id) {
        $data = Withdraw::findOrFail($id);
        $data->status = 'rejected';
        $data->update();
        $msg = 'Withdrawal Request has been Rejected.';
        return response()->json($msg); 
    }
}
