<?php

namespace App\Http\Controllers\Vendor;

use App\Models\User;
use App\Models\DeliveryCoupon;
use App\Models\DeliveryFee;
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
        $this->middleware('auth');
    }

  	public function index()
    {        
        return view('vendor.delivery_coupon.index');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = DeliveryCoupon::where('vendor_id','=', Auth::guard('web')->user()->id)->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)	
                ->editColumn('deliveryfee_id', function(DeliveryCoupon $data) {
                    $deliveryfee_class = DeliveryFee::where('id', $data->deliveryfee_id)->first()->class_name;
                    return $deliveryfee_class;
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
					return '<div class="action-list"><a href="' . route('vendor-delivery_coupon-edit',$data->id) . '"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('vendor-delivery_coupon-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
					
				}) 
				->rawColumns(['action'])
				->toJson(); //--- Returning Json Data To Client Side
    }

    public function edit($id) {
        $delivery_coupon = DeliveryCoupon::findOrFail($id);        
        $delivery_fees = DeliveryFee::where('vendor_id', Auth::user()->id)->get();    
        $sign = Currency::where('is_default','=',1)->first();
        return view('vendor.delivery_coupon.edit', compact('sign', 'delivery_coupon', 'delivery_fees'));
    }

    public function delete($id) {
        $data = DeliveryCoupon::findOrFail($id);
        $data->delete();
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg); 
    }


    public function create()
    {
        $sign = Currency::where('is_default','=',1)->first();
        $delivery_fees = DeliveryFee::where('vendor_id', Auth::user()->id)->get();        
        return view('vendor.delivery_coupon.create', compact('sign', 'delivery_fees'));
    }


    public function update(Request $request){
        $id = $request->id;        
        $from = User::findOrFail(Auth::guard('web')->user()->id);
        $curr = Currency::where('is_default','=',1)->first();                 

        if($id == 0){
            $delivery_coupon = new DeliveryCoupon();
            $delivery_coupon->vendor_id = Auth::guard('web')->user()->id;
        } else {
            $delivery_coupon = DeliveryCoupon::findOrFail($id);
        }
        $delivery_coupon->deliveryfee_id = $request->deliveryfee_id;
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
