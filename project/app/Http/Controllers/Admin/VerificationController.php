<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use App\Models\Verification;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables($status)
    {
        if($status == 'Pending'){
            $datas = Verification::where('status','=','Pending')->get();
        }
        else{
           $datas = Verification::where('status','!=','Pending')->get();
        }
         
         return Datatables::of($datas)
                            ->addColumn('name', function(Verification $data) {
                                $name = isset($data->user->owner_name) ? '<a href="'. route('admin-vendor-show',$data->user->id) .'" target="_blank">'.$data->user->owner_name.'</a>' : 'Removed';
                                return  $name;
                            })
                            ->addColumn('email', function(Verification $data) {
                                $name = isset($data->user->email) ? $data->user->email : 'Removed';
                                return  $name;
                            })
                            ->editColumn('text', function(Verification $data) {
                                $details = mb_strlen($data->text,'utf-8') > 250 ? mb_substr($data->text,0,250,'utf-8').'...' : $data->text;
                                return  $details;
                            })
                            ->addColumn('status', function(Verification $data) {
                                $class = $data->status == 'Pending' ? '' : ($data->status == 'Verified' ? 'drop-success' : 'drop-danger');
                                $s = $data->status == 'Verified' ? 'selected' : '';
                                $ns = $data->status == 'Declined' ? 'selected' : '';
                                return '<div class="action-list"><select class="process select vendor-droplinks '.$class.'">'.
                                 '<option value="'. route('admin-vr-st',['id1' => $data->id, 'id2' => 'Pending']).'" '.$s.'>Pending</option>'.
                                '<option value="'. route('admin-vr-st',['id1' => $data->id, 'id2' => 'Verified']).'" '.$s.'>Verified</option>'.
                                '<option value="'. route('admin-vr-st',['id1' => $data->id, 'id2' => 'Declined']).'" '.$ns.'>Declined</option></select></div>';
                            }) 
                            ->addColumn('action', function(Verification $data) {
                                return '<div class="action-list"><a href="javascript:;" class="set-gallery" data-toggle="modal" data-target="#setgallery"><input type="hidden" value="'.$data->id.'"><i class="fas fa-paperclip"></i> View Attachments</a><a href="javascript:;" data-href="' . route('admin-vr-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['name','status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function index()
    {
        return view('admin.verify.index');
    }

    public function pending()
    {
        return view('admin.verify.pending');
    }

    public function show()
    {
        $data[0] = 0;
        $id = $_GET['id'];
        $prod1 = Verification::findOrFail($id);
        $prod = explode(',', $prod1->attachments);
        if(count($prod))
        {
            $data[0] = 1;
            $data[1] = $prod;
            $data[2] = $prod1->text;
            $data[3] = ''.route('admin-vr-st',['id1' => $prod1->id, 'id2' => 'Verified']).'';
            $data[4] = ''.route('admin-vr-st',['id1' => $prod1->id, 'id2' => 'Declined']).'';
        }
        return response()->json($data);              
    }  


    public function edit($id)
    {
        $data = Order::find($id);
        return view('admin.order.delivery',compact('data'));
    }


    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Logic Section
        $data = Order::findOrFail($id);

        $input = $request->all();


        // Then Save Without Changing it.
            $input['status'] = "completed";
            $data->update($input);
            //--- Logic Section Ends
    

        //--- Redirect Section          
        $msg = 'Status Updated Successfully.';
        return response()->json($msg);    
        //--- Redirect Section Ends     

    }


    //*** GET Request
    public function status($id1,$id2)
    {
        $user = Verification::findOrFail($id1);
        $user->status = $id2;
        $user->update();
        //--- Redirect Section        
        $msg[0] = 'Status Updated Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends    

    }


    //*** GET Request
    public function destroy($id)
    {
        $data = Verification::findOrFail($id);
        $photos =  explode(',',$data->attachments);
        foreach($photos as $photo){
            unlink(public_path().'/assets/images/attachments/'.$photo);
        }
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends    

    }






}
