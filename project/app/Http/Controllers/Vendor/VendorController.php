<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\AutodebitCategory;
use App\Models\Generalsetting;
use App\Models\Subcategory;
use App\Models\VendorOrder;
use App\Models\Order;
use App\Models\AutodebitOrder;
use App\Models\Verification;
use Auth;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Validator;
use Illuminate\Support\Facades\Hash;
use Response;

class VendorController extends Controller
{

    public $lang;
    public function __construct()
    {

        $this->middleware('auth');

            if (Session::has('language')) 
            {
                $data = DB::table('languages')->find(Session::get('language'));
                $data_results = file_get_contents(public_path().'/assets/languages/'.$data->file);
                $this->lang = json_decode($data_results);
            }
            else
            {
                $data = DB::table('languages')->where('is_default','=',1)->first();
                $data_results = file_get_contents(public_path().'/assets/languages/'.$data->file);
                $this->lang = json_decode($data_results);
                
            } 
    }

    //*** GET Request
    public function index()
    {
        $user = Auth::user();  
        if(!$user->autodebit) {
            $pending = VendorOrder::where('user_id','=',$user->id)->where('status','=','pending')->get(); 
            $processing = VendorOrder::where('user_id','=',$user->id)->where('status','=','processing')->get(); 
            $completed = VendorOrder::where('user_id','=',$user->id)->where('status','=','completed')->get(); 
        } else {
            $pending = AutodebitOrder::where('vendor_id','=',$user->id)->where('status','=',0)->get(); 
            $processing = null; 
            $completed = AutodebitOrder::where('vendor_id','=',$user->id)->where('status','=',1)->get(); 
        }

        $days = "";
        $sales = "";
        for($i = 0; $i < 30; $i++) {
            $days .= "'".date("d M", strtotime('-'. $i .' days'))."',";
            if(!$user->autodebit)
                $sales .=  "'".Order::where('vendor_id','=',$user->id)->where('status','=','completed')->whereDate('created_at', '=', date("Y-m-d", strtotime('-'. $i .' days')))->count()."',";
            else
                $sales .=  "'".AutodebitOrder::where('vendor_id','=',$user->id)->where('status','=',1)->whereDate('created_at', '=', date("Y-m-d", strtotime('-'. $i .' days')))->count()."',";
        }
        
        return view('vendor.index',compact('user','pending','processing','completed', 'days', 'sales'));
    }
    
    public function changepass(Request $request) {        
        $user = Auth::user();  
        if ($request->cpass){
            if (Hash::check($request->cpass, $user->password)){
                if ($request->newpass == $request->renewpass){
                    $input['password'] = Hash::make($request->newpass);
                }else{
                    return response()->json(array('errors' => [ 0 => 'Confirm password does not match.' ]));
                }
            }else{
                return response()->json(array('errors' => [ 0 => 'Current password Does not match.' ]));
            }
        }
        $user->update($input);
        $msg = 'Successfully change your passwprd';
        return response()->json($msg);
    }

    public function profileupdate(Request $request)
    {
        //--- Validation Section
        $rules = [
               'shop_image'  => 'mimes:jpeg,jpg,png,svg',
                ];

        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        $input = $request->all();  
        $data = Auth::user();    

        
        if ($file = $request->file('shop_image')) 
         {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/vendorbanner',$name);           
            $input['shop_image'] = $name;
        }
        
        if ($file = $request->file('shop_logo')) 
         {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/vendorlogo',$name);           
            $input['shop_logo'] = $name;
        }
        if(isset($input['category_id'])) {
            // $input['category_id'] = json_encode(explode(',', $input['category_id']));
            $input['category_id'] = "[".$input['category_id']."]";
        }
        
        if(isset($input['nearby']) && $input['nearby'] == 'on') 
            $input['nearby'] = 1;
        else
            $input['nearby'] = 0;
        
        if(isset($input['online']) && $input['online'] == 'on') 
            $input['online'] = 1;
        else
            $input['online'] = 0;
        
        if(isset($input['autodebit']) && $input['autodebit'] == 'on') {
            $input['autodebit'] = 1;
            $input['online'] = 0;
            $input['nearby'] = 0;
        }else{
            $input['autodebit'] = 0;
        }
        
        $data->update($input);
        $msg = 'Successfully updated your profile';
        return response()->json($msg); 
    }

    public function shopimageupdate(Request $request)
    {
        //--- Validation Section
        $rules = [
               'shop_image'  => 'mimes:jpeg,jpg,png,svg',
                ];

        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        $input = $request->all();  
        $data = Auth::user();    

        
        if ($file = $request->file('shop_image')) 
         {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/vendorbanner',$name);           
            $input['shop_image'] = $name;
        }
        
        if ($file = $request->file('shop_logo')) 
         {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/vendorlogo',$name);           
            $input['shop_logo'] = $name;
        }
        
        $data->update($input);
        $msg = 'Successfully updated your profile';
        return response()->json($msg); 
    }

    // Spcial Settings All post requests will be done in this method
    public function socialupdate(Request $request)
    {
        //--- Logic Section
        $input = $request->all(); 
        $data = Auth::user();   
        if ($request->f_check == ""){
            $input['f_check'] = 0;
        }
        if ($request->t_check == ""){
            $input['t_check'] = 0;
        }

        if ($request->g_check == ""){
            $input['g_check'] = 0;
        }

        if ($request->l_check == ""){
            $input['l_check'] = 0;
        }
        $data->update($input);
        //--- Logic Section Ends
        //--- Redirect Section        
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends                

    }

    //*** GET Request
    public function profile()
    {
        $data = Auth::user();  
        $categories = Category::all();
        $autodebit_categories = AutodebitCategory::all();
        return view('vendor.profile',compact('data', 'categories', 'autodebit_categories'));
    }

    //*** GET Request
    public function ship()
    {
        $gs = Generalsetting::find(1);
        if($gs->vendor_ship_info == 0) {
            return redirect()->back();
        }
        $data = Auth::user();  
        return view('vendor.ship',compact('data'));
    }

    //*** GET Request
    public function banner()
    {
        $data = Auth::user();  
        return view('vendor.banner',compact('data'));
    }

    public function logo()
    {
        $data = Auth::user();  
        return view('vendor.logo',compact('data'));
    }

    //*** GET Request
    public function social()
    {
        $data = Auth::user();  
        return view('vendor.social',compact('data'));
    }

    //*** GET Request
    public function subcatload($id)
    {
        $cat = Category::findOrFail($id);
        return view('load.subcategory',compact('cat'));
    }

    //*** GET Request
    public function childcatload($id)
    {
        $subcat = Subcategory::findOrFail($id);
        return view('load.childcategory',compact('subcat'));
    }

    //*** GET Request
    public function verify()
    {
        $data = Auth::user();  
        if($data->checkStatus())
        {
            return redirect()->back();
        }
        return view('vendor.verify',compact('data'));
    }

    //*** GET Request
    public function warningVerify($id)
    {
        $verify = Verification::findOrFail($id);
        $data = Auth::user();  
        return view('vendor.verify',compact('data','verify'));
    }

    //*** POST Request
    public function verifysubmit(Request $request)
    {
        //--- Validation Section
        $rules = [
          'attachments.*'  => 'mimes:jpeg,jpg,png,svg|max:10000'
           ];
        $customs = [
            'attachments.*.mimes' => 'Only jpeg, jpg, png and svg images are allowed',
            'attachments.*.max' => 'Sorry! Maximum allowed size for an image is 10MB',
                   ];

        $validator = Validator::make(Input::all(), $rules,$customs);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        $data = new Verification();
        $input = $request->all();

        $input['attachments'] = '';
        $i = 0;
                if ($files = $request->file('attachments')){
                    foreach ($files as  $key => $file){
                        $name = time().$file->getClientOriginalName();
                        if($i == count($files) - 1){
                            $input['attachments'] .= $name;
                        }
                        else {
                            $input['attachments'] .= $name.',';
                        }
                        $file->move('assets/images/attachments',$name);

                    $i++;
                    }
                }
        $input['status'] = 'Pending';        
        $input['user_id'] = Auth::user()->id;
        if($request->verify_id != '0')
        {
            $verify = Verification::findOrFail($request->verify_id);
            $input['admin_warning'] = 0;
            $verify->update($input);
        }
        else{

            $data->fill($input)->save();
        }

        //--- Redirect Section        
        $msg = '<div class="text-center"><i class="fas fa-check-circle fa-4x"></i><br><h3>'.$this->lang->lang804.'</h3></div>';
        return response()->json($msg);      
        //--- Redirect Section Ends     
    }
    
    public function qrcode(Request $request) {
        $vendor = Auth::user(); 
        $time = time();
        if(!$request->ajax()){            
            return view('vendor.qrcode',compact('vendor','time'));
        }
    }

    public function qrcodeDownload() 
    {
        $filepath = public_path('/assets/images/categories/11.jpg');
        return Response::download($filepath);
    }

}
