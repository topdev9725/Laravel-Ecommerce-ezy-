<?php

namespace App\Http\Controllers\Vendor;

use App\Models\User;
use App\Models\AutodebitSubscription;
use App\Models\Generalsetting;
use App\Models\AutodebitInsurrance;
use Auth;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use App\Classes\Common;

class AutodebitSubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //*** JSON Request
    public function datatables()
    {
        $datas = AutodebitSubscription::where('vendor_id','=', Auth::guard('web')->user()->id)->get();        
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                ->editColumn('method', function(AutodebitSubscription $data) {
                    $method = ['monthly'=>'Monthly', 'quarter'=>'Quarter', 'half_year'=>'Half Year', 'yearly'=>'Year'];
                    return $method[$data->method];
                })
                ->editColumn('cost', function(AutodebitSubscription $data) {
                    return Common::formatPrice($data->cost);
                })
				->addColumn('action', function(AutodebitSubscription $data) {
					return '<div class="action-list"><a href="' . route('vendor-ats-edit',$data->id) . '"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('vendor-ats-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
					
				}) 
				->rawColumns(['action'])
				->toJson(); //--- Returning Json Data To Client Side
    }

    //*** JSON Request
    public function datatables1()
    {
        $datas = AutodebitInsurrance::where('vendor_id','=', Auth::guard('web')->user()->id)->get();        
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                ->editColumn('min', function(AutodebitInsurrance $data) {
                    return Common::formatPrice($data->min);
                })
                ->editColumn('max', function(AutodebitInsurrance $data) {
                    return Common::formatPrice($data->max);
                })
				->addColumn('action', function(AutodebitInsurrance $data) {
					return '<div class="action-list"><a href="' . route('vendor-ats-edit1',$data->id) . '"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('vendor-ats-delete1',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
					
				}) 
				->rawColumns(['action'])
				->toJson(); //--- Returning Json Data To Client Side
    }

  	public function index(Request $request)
    {   
        $autodebit_type = $request->autodebit_type;
        if($autodebit_type == 0)   {                //when autodebit is normal
            $autodebit_store = User::findOrFail(Auth::user()->id);
            $autodebit_store->autodebit_type = $autodebit_type;
            $autodebit_store->update();
            return view('vendor.autodebit_subscriptions.index');
        } else {                                    //when autodebit is insurrance
            $autodebit_store = User::findOrFail(Auth::user()->id);
            $autodebit_store->autodebit_type = $autodebit_type;
            $autodebit_store->update();
            return view('vendor.autodebit_insurrance_subscriptions.index');
        }                                 
        
    }


    public function create()
    {
        $sign = Currency::where('is_default','=',1)->first();
        return view('vendor.autodebit_subscriptions.create' ,compact('sign'));
    }

    public function create1()
    {
        $sign = Currency::where('is_default','=',1)->first();
        return view('vendor.autodebit_insurrance_subscriptions.create' ,compact('sign'));
    }

    public function edit($id)
    {
        $data = AutodebitSubscription::findOrFail($id);
        $sign = Currency::where('is_default','=',1)->first();
        return view('vendor.autodebit_subscriptions.edit' ,compact('sign', 'data'));
    }

    public function edit1($id)
    {
        $data = AutodebitInsurrance::findOrFail($id);
        $sign = Currency::where('is_default','=',1)->first();
        return view('vendor.autodebit_insurrance_subscriptions.edit' ,compact('sign', 'data'));
    }

    public function delete($id)
    {
        $data = AutodebitSubscription::findOrFail($id);
        $data->delete();
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg); 
    }

    public function delete1($id)
    {
        $data = AutodebitInsurrance::findOrFail($id);
        $data->delete();
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg); 
    }


    public function store(Request $request)
    {   
        $curr = Currency::where('is_default','=',1)->first(); 
        $id = $request->id;
        if($id > 0){
            $data = AutodebitSubscription::findOrFail($id);
        } else {
            $data = new AutodebitSubscription();
            $data->vendor_id = Auth::guard('web')->user()->id;
        }        
        $data->title = $request->title;
        $data->method = $request->method;
        $data->cost = $request->cost;        
        $data->description = $request->description;        
        if($id > 0){
            $data->update();
        } else {
            $data->save();            
        }
            
        return response()->json('Subscription Saved Successfully.'); 
    }

    public function store1(Request $request)
    {   
        $curr = Currency::where('is_default','=',1)->first(); 
        $id = $request->id;
        if($id > 0){
            $data = AutodebitInsurrance::findOrFail($id);
        } else {
            $data = new AutodebitInsurrance();
            $data->vendor_id = Auth::guard('web')->user()->id;
        }        
        $data->title = $request->title;
        $data->min = $request->min;
        $data->max = $request->max;    
        $data->description = $request->description;        
        if($id > 0){
            $data->update();
        } else {
            $data->save();            
        }
            
        return response()->json('Subscription Saved Successfully.'); 
    }
}
