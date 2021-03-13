<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\DeliveryCoupon;
use App\Models\Province;
use Auth;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use App\Classes\Common;

class DeliveryCouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

  	public function index()
    {        
        return view('admin.delivery_coupon.index');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = DeliveryCoupon::orderBy('vendor_id')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)				
                ->addColumn('shop_name', function(DeliveryCoupon $data) {
                    $user = User::findOrFail($data->vendor_id);
                    return $user->shop_name;
                })
                ->addColumn('vendor_name', function(DeliveryCoupon $data) {
                    $user = User::findOrFail($data->vendor_id);
                    return $user->owner_name;
                })
                ->editColumn('min_amount', function(DeliveryCoupon $data) {
                    return Common::formatPrice($data->min_amount);
                })
                ->editColumn('max_amount', function(DeliveryCoupon $data) {
                    return Common::formatPrice($data->max_amount);
                })
                ->editColumn('delivery_rate', function(DeliveryCoupon $data) {                    
                    return $data->delivery_rate.'%';
                })
				->addColumn('action', function(DeliveryCoupon $data) {
					return '<div class="action-list"><a href="' . route('admin-vr-delivery_coupon-edit',$data->id) . '"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-vr-delivery_coupon-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
					
				}) 
				->rawColumns(['action'])
				->toJson(); //--- Returning Json Data To Client Side
    }

    public function edit($id) {
        $delivery_coupon = DeliveryCoupon::findOrFail($id);        
        $vendors = User::where('is_vendor','=',2)->orWhere('is_vendor','=',1)->orderBy('id','desc')->get();
        $sign = Currency::where('is_default','=',1)->first();
        return view('admin.delivery_coupon.edit', compact('sign', 'delivery_coupon', 'vendors'));
    }

    public function delete($id) {
        $data = DeliveryCoupon::findOrFail($id);
        $data->delete();
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg); 
    }


    public function create()
    {
        $vendors = User::where('is_vendor','=',2)->orWhere('is_vendor','=',1)->orderBy('id','desc')->get();
        $sign = Currency::where('is_default','=',1)->first();        
        return view('admin.delivery_coupon.create', compact('sign', 'vendors'));
    }


    public function update(Request $request){
        $id = $request->id;        

        if($id == 0){
            $delivery_coupon = new DeliveryCoupon();            
        } else {
            $delivery_coupon = DeliveryCoupon::findOrFail($id);
        }
        $delivery_coupon->vendor_id = $request->vendor_id;
        $delivery_coupon->class_name = $request->class_name;
        $delivery_coupon->min_amount = $request->min_amount;
        $delivery_coupon->max_amount = $request->max_amount;
        $delivery_coupon->delivery_rate = $request->delivery_rate;        
        if($request->description)
            $delivery_coupon->description = $request->description;
        if($id == 0){
            $delivery_coupon->save();
        } else {
            $delivery_coupon->update();
        }
        return response()->json('Delivery Coupon saved Successfully.');           
    }
}
