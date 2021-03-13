<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\NewNotification;
use App\Models\User;
use Datatables;

class NewNotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // remark as read
    public function remark_read() {
        $data = 1;
        $user = Auth::guard('web')->user();
        if(!$user) {
            $data = 0;
            return response()->json($data);
        }
        $notifs = NewNotification::getNewNotifs($user->id, 0);
        foreach($notifs as $item) {
            $notif = NewNotification::where('id','=',$item->id)->first();    
            if($notif->user_id == $user->id) {
                $notif->is_read = 1;
            } else if($notif->user_id == 0) {
                $read_user_ids = json_decode($notif->read_user_ids, true);
                if(!in_array($user->id, $read_user_ids)) {
                    array_push($read_user_ids, $user->id);
                }
                $notif->read_user_ids = json_encode($read_user_ids);    
            }
            $notif->update();
        }
        return response()->json($data);
    }

    //remove notification
    public function delete_notification($id)
    {
        $data = 1;
        $user = Auth::guard('web')->user();
        if(!$user) {
            $data = 0;
            return response()->json($data);
        }
        $notif = NewNotification::where('id','=',$id)->first();
        
        if(empty($notif) || ($notif->user_id!=0 && $notif->user_id!=$user->id)) {            
            return response()->json($data);
        }
        if($notif->user_id!=0) {
            $notif->delete();            
        } else {
            $deleted_user_ids = $notif->deleted_user_ids;
            if($deleted_user_ids)
                $deleted_user_ids = json_decode($notif->deleted_user_ids, true);
            else
                $deleted_user_ids = [];
            if(!in_array($user->id, $deleted_user_ids)) {
                array_push($deleted_user_ids, $user->id);
            }
            $notif->deleted_user_ids = json_encode($deleted_user_ids);
            $all_users = User::where('ban','=',0)->get()->count();
            if(count($deleted_user_ids)>=$all_users) {
                $notif->delete();
            } else {
                $notif->update();
            }
        }
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg); 
    }

    public function notifications()
    {
        $this->remark_read();
        return view('vendor.notification');
    }

    public function datatables() {
        $datas = NewNotification::getNewNotifs(Auth::guard('web')->user()->id, -1);
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)				
                ->editColumn('created_at', function(NewNotification $data) {                    
                    return $data->created_at->diffForHumans();
                })
				->addColumn('action', function(NewNotification $data) {
					return '<div class="action-list"><a href="javascript:;" data-toggle="modal" data-target="#confirm-delete" data-href="'.route('vendor.notif.remove',$data->id).'" class="link remove"><i class="fa fa-trash"></i></a></div>';
					
				}) 
				->rawColumns(['message','action'])
				->toJson(); //--- Returning Json Data To Client Side
    }    
}
