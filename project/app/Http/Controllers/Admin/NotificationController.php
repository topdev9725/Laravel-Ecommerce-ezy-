<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function user_notf_count()
    {
        $data = Notification::where('user_id','!=',null)->where('is_read','=',0)->get()->count();
        return response()->json($data);            
    } 

    public function user_notf_clear()
    {
        $data = Notification::where('user_id','!=',null);
        $data->delete();        
    } 

    public function user_notf_show()
    {
        $datas = Notification::where('user_id','!=',null)->latest()->get();
        if($datas->count() > 0){
          foreach($datas as $data){
            $data->is_read = 1;
            $data->update();
          }
        }       
        return view('admin.notification.register',compact('datas'));           
    } 


    public function order_notf_count()
    {
        $data = Notification::where('order_id','!=',null)->where('is_read','=',0)->get()->count();
        return response()->json($data);            
    } 

    public function order_notf_clear()
    {
        $data = Notification::where('order_id','!=',null);
        $data->delete();        
    } 

    public function order_notf_show()
    {
        $datas = Notification::where('order_id','!=',null)->latest()->get();
        if($datas->count() > 0){
          foreach($datas as $data){
            $data->is_read = 1;
            $data->update();
          }
        }       
        return view('admin.notification.order',compact('datas'));           
    } 


    public function product_notf_count()
    {
        $data = Notification::where('product_id','!=',null)->where('is_read','=',0)->get()->count();
        return response()->json($data);            
    } 

    public function product_notf_clear()
    {
        $data = Notification::where('product_id','!=',null);
        $data->delete();        
    } 

    public function product_notf_show()
    {
        $datas = Notification::where('product_id','!=',null)->latest()->get();
        if($datas->count() > 0){
          foreach($datas as $data){
            $data->is_read = 1;
            $data->update();
          }
        }       
        return view('admin.notification.product',compact('datas'));           
    } 


    public function conv_notf_count()
    {
        $data = Notification::where('conversation_id','!=',null)->where('is_read','=',0)->get()->count();
        return response()->json($data);            
    } 

    public function conv_notf_clear()
    {
        $data = Notification::where('conversation_id','!=',null);
        $data->delete();        
    } 

    public function conv_notf_show()
    {
        $datas = Notification::where('conversation_id','!=',null)->latest()->get();
        if($datas->count() > 0){
          foreach($datas as $data){
            $data->is_read = 1;
            $data->update();
          }
        }       
        return view('admin.notification.message',compact('datas'));           
    } 

}
