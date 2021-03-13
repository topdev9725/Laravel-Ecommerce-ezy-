<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderTrack;
use Illuminate\Support\Facades\Input;
use Validator;

class OrderTrackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


   //*** GET Request
    public function index($id)
    {
    	$order = Order::findOrFail($id);
        return view('admin.order.track',compact('order'));
    }

   //*** GET Request
    public function load($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.track-load',compact('order'));
    }


    public function add()
    {


        //--- Logic Section

        $title = $_GET['title'];

        $ck = OrderTrack::where('order_id','=',$_GET['id'])->where('title','=',$title)->first();
        if($ck){
            $ck->order_id = $_GET['id'];
            $ck->title = $_GET['title'];
            $ck->text = $_GET['text'];
            $ck->update();  
        }
        else {
            $data = new OrderTrack;
            $data->order_id = $_GET['id'];
            $data->title = $_GET['title'];
            $data->text = $_GET['text'];
            $data->save();            
        }


        //--- Logic Section Ends


    }


    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        // $rules = [
        //        'title' => 'unique:order_tracks',
        //         ];
        // $customs = [
        //        'title.unique' => 'This title has already been taken.',
        //            ];
        // $validator = Validator::make(Input::all(), $rules, $customs);
        // if ($validator->fails()) {
        //   return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        // }
        //--- Validation Section Ends

        //--- Logic Section

        $title = $request->title;
        $ck = OrderTrack::where('order_id','=',$request->order_id)->where('title','=',$title)->first();
        if($ck) {
            $ck->order_id = $request->order_id;
            $ck->title = $request->title;
            $ck->text = $request->text;
            $ck->update();  

        //--- Redirect Section  
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends  
            
        }
        else {
            $data = new OrderTrack;
            $input = $request->all();
            $data->fill($input)->save();            
        }

        //--- Logic Section Ends

        //--- Redirect Section  
        $msg = 'New Data Added Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends  
    }


    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
               'title' => 'unique:order_tracks,title,'.$id
                ];
        $customs = [
               'title.unique' => 'This title has already been taken.',
                   ];
        $validator = Validator::make(Input::all(), $rules, $customs);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = OrderTrack::findOrFail($id);
        $input = $request->all();
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section          
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);    
        //--- Redirect Section Ends  

    }

    //*** GET Request
    public function delete($id)
    {
        $data = OrderTrack::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends   
    }

}
