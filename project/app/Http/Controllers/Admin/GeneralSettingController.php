<?php

namespace App\Http\Controllers\Admin;
use App\Models\Generalsetting;
use Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Models\Category;
use App\Models\AutodebitCategory;
use Validator;
use Config;

class GeneralSettingController extends Controller
{

    protected $rules =
    [
        'logo'              => 'mimes:jpeg,jpg,png,svg',
        'favicon'           => 'mimes:jpeg,jpg,png,svg',
        'loader'            => 'mimes:gif',
        'admin_loader'      => 'mimes:gif',
        'affilate_banner'   => 'mimes:jpeg,jpg,png,svg',
        'error_banner'      => 'mimes:jpeg,jpg,png,svg',
        'popup_background'  => 'mimes:jpeg,jpg,png,svg',
        'invoice_logo'      => 'mimes:jpeg,jpg,png,svg',
        'user_image'        => 'mimes:jpeg,jpg,png,svg',
        'footer_logo'        => 'mimes:jpeg,jpg,png,svg',
    ];

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    private function setEnv($key, $value,$prev)
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key . '=' . $prev,
            $key . '=' . $value,
            file_get_contents(app()->environmentFilePath())
        ));
    }

    // Genereal Settings All post requests will be done in this method
    public function generalupdate(Request $request)
    {
        //--- Validation Section
        $validator = Validator::make(Input::all(), $this->rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        else {
        $input = $request->all();
        $data = Generalsetting::findOrFail(1);
            if ($file = $request->file('logo'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->logo);
                $input['logo'] = $name;
            }
            if ($file = $request->file('favicon'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->favicon);
                $input['favicon'] = $name;
            }
            if ($file = $request->file('loader'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->loader);
                $input['loader'] = $name;
            }
            if ($file = $request->file('admin_loader'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->admin_loader);
                $input['admin_loader'] = $name;
            }
            if ($file = $request->file('affilate_banner'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->affilate_banner);
                $input['affilate_banner'] = $name;
            }
             if ($file = $request->file('error_banner'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->error_banner);
                $input['error_banner'] = $name;
            }
            if ($file = $request->file('popup_background'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->popup_background);
                $input['popup_background'] = $name;
            }
            if ($file = $request->file('invoice_logo'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->invoice_logo);
                $input['invoice_logo'] = $name;
            }
            if ($file = $request->file('user_image'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->user_image);
                $input['user_image'] = $name;
            }

            if ($file = $request->file('footer_logo'))
            {
                $name = time().$file->getClientOriginalName();
                $data->upload($name,$file,$data->footer_logo);
                $input['footer_logo'] = $name;
            }

            if(isset($input['affiliate_plan'])) {
                $categories = Category::where('status', '=', 1)->get();
                foreach($categories as $category) {
                    $category->charging_fee = $input[$category->slug];
                    $category->update();
                    unset($input[$category->slug]);
                }
                $autodebit_categories = AutodebitCategory::where('status', '=', 1)->get();
                foreach($autodebit_categories as $category) {
                    $category->charging_fee = $input[$category->slug];
                    $category->update();
                    unset($input[$category->slug]);
                }
                unset($input['affiliate_plan']);
            }

        $data->update($input);
        //--- Logic Section Ends


        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        //--- Redirect Section
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
        }
    }

    public function generalupdatepayment(Request $request)
    {
        //--- Validation Section
        $validator = Validator::make(Input::all(), $this->rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        else {
        $input = $request->all();
        $data = Generalsetting::findOrFail(1);
        $prev = $data->molly_key;  
        
        if ($request->vendor_ship_info == ""){
            $input['vendor_ship_info'] = 0;
        }

        if ($request->instamojo_sandbox == ""){
            $input['instamojo_sandbox'] = 0;
        }

        if ($request->paypal_mode == ""){
            $input['paypal_mode'] = 'live';
        }
        else {
            $input['paypal_mode'] = 'sandbox';
        }

        if ($request->paytm_mode == ""){
            $input['paytm_mode'] = 'live';
        }
        else {
            $input['paytm_mode'] = 'sandbox';
        }
        if ($request->authorize_mode == ""){
            $input['authorize_mode'] = 'PRODUCTION';
        }
        else {
            $input['authorize_mode'] = 'SANDBOX';
        }
        if ($request->twocheckout_sandbox_check == ""){
            $input['twocheckout_sandbox_check'] = 0;
        }
        else {
            $input['twocheckout_sandbox_check'] = 1;
        }
        if ($request->ssl_sandbox_check == ""){
            $input['ssl_sandbox_check'] = 0;
        }
        else {
            $input['ssl_sandbox_check'] = 1;
        }
        if ($request->paypal_sandbox_check == ""){
            $input['paypal_sandbox_check'] = 0;
        }
        else {
            $input['paypal_sandbox_check'] = 1;
        }
        if ($request->mercadopago_sandbox_check == ""){
            $input['mercadopago_sandbox_check'] = 0;
        }
        else {
            $input['mercadopago_sandbox_check'] = 1;
        }
        $data->merchant_id = $input['merchant_id'];
        $data->surepay_api_key = $input['surepay_api_key'];
        $data->surepay_bank_code = $input['surepay_bank_code'];
        $data->surepay_tax = $input['surepay_tax'];
        $data->surepay_text = $input['surepay_text'];
        $data->update($input);


        $this->setEnv('MOLLIE_KEY',$data->molly_key,$prev);
        // Set Molly ENV

        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
        }
    }


    public function generalMailUpdate(Request $request)
    {
        $input = $request->all();
        $maildata = Generalsetting::findOrFail(1);
        Config::set('mail.driver', $request->mail_engine);
        Config::set('mail.host', $request->smtp_host);
        Config::set('mail.port', $request->smtp_port);
        Config::set('mail.encryption', $request->email_encryption);
        Config::set('mail.username', $request->smtp_user);
        Config::set('mail.password', $request->smtp_pass);

            $datas = [
                    'to' => 'junajunnun@gmail.com',
                    'subject' => 'Test Sms',
                    'body' => 'Test Body',
            ];

            $data = [
                'email_body' => $datas['body']
            ];
    
            $objDemo = new \stdClass();
            $objDemo->to = $datas['to'];
            $objDemo->from = $request->from_email;
            $objDemo->title = $request->from_name;
            $objDemo->subject = $datas['subject'];
            try{
                Mail::send('admin.email.mailbody',$data, function ($message) use ($objDemo) {
                    $message->from($objDemo->from,$objDemo->title);
                    $message->to($objDemo->to);
                    $message->subject($objDemo->subject);
                });
            }
            catch (\Exception $e){
                return response()->json($e->getMessage());
            }

        $maildata->update($input);

        //--- Redirect Section
        $msg = 'Mail Data Updated Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    public function logo()
    {
        return view('admin.generalsetting.logo');
    }

    public function userimage()
    {
        return view('admin.generalsetting.user_image');
    }

    public function fav()
    {
        return view('admin.generalsetting.favicon');
    }

     public function load()
    {
        return view('admin.generalsetting.loader');
    }

     public function contents()
    {
        return view('admin.generalsetting.websitecontent');
    }

     public function header()
    {
        return view('admin.generalsetting.header');
    }

     public function footer()
    {
        return view('admin.generalsetting.footer');
    }

    public function paymentsinfo()
    {
        return view('admin.generalsetting.paymentsinfo');
    }

    public function affilate()
    {
        $categories = Category::where('status','=',1)->get();
        $autodebit_categories = AutodebitCategory::where('status','=',1)->get();
        return view('admin.generalsetting.affilate', compact('categories', 'autodebit_categories'));
    }

    public function errorbanner()
    {
        return view('admin.generalsetting.error_banner');
    }

    public function popup()
    {
        return view('admin.generalsetting.popup');
    }

    public function maintain()
    {
        return view('admin.generalsetting.maintain');
    }

    public function api_keys()
    {
        return view('admin.generalsetting.api_keys');
    }
    
    public function ispopup($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->is_popup = $status;
        $data->update();
    }


    public function mship($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->multiple_shipping = $status;
        $data->update();
    }


    public function mpackage($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->multiple_packaging = $status;
        $data->update();
    }


    public function productAffilate($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->affilate_product = $status;
        $data->update();
    }

    public function paypal($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->paypal_check = $status;
        $data->update();
    }


    public function instamojo($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->is_instamojo = $status;
        $data->update();
    }


    public function paystack($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->is_paystack = $status;
        $data->update();
    }


    public function paytm($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_paytm = $status;
        $data->update();
    }



    public function molly($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_molly = $status;
        $data->update();
    }

    public function razor($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_razorpay = $status;
        $data->update();
    }


    public function voguepay($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_voguepay = $status;
        $data->update();
    }

    public function authorizes($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_authorize = $status;
        $data->update();
    }

    public function mercadopago($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_mercado= $status;
        $data->update();
    }

    public function ssl($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_ssl = $status;
        $data->update();
    }


    public function buyNow($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_buy_now = $status;
        $data->update();
    }


    public function stripe($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->stripe_check = $status;
        $data->update();
    }

    public function surepay($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->surepay_check = $status;
        $data->update();
    }

    public function bank($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->bank_check = $status;
        $data->update();
    }

    public function guest($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->guest_checkout = $status;
        $data->update();
    }

    public function isemailverify($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_verification_email = $status;
        $data->update();
    }


    public function cod($status)
    {

        $data = Generalsetting::findOrFail(1);
        $data->cod_check = $status;
        $data->update();
    }

    public function comment($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_comment = $status;
        $data->update();
    }
    public function isaffilate($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_affilate = $status;
        $data->update();
    }

    public function issmtp($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_smtp = $status;
        $data->update();
    }

    public function talkto($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_talkto = $status;
        $data->update();
    }

    public function issubscribe($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_subscribe = $status;
        $data->update();
    }

    public function isloader($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_loader = $status;
        $data->update();
    }

    public function stock($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->show_stock = $status;
        $data->update();
    }

    public function ishome($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_home = $status;
        $data->update();
    }

    public function isadminloader($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_admin_loader = $status;
        $data->update();
    }

    public function isdisqus($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_disqus = $status;
        $data->update();
    }

    public function flutter($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_flutter = $status;
        $data->update();
    }

    public function twocheckout($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_twocheckout = $status;
        $data->update();
    }

    public function iscontact($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_contact = $status;
        $data->update();
    }
    public function isfaq($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_faq = $status;
        $data->update();
    }
    public function language($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_language = $status;
        $data->update();
    }
    public function currency($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_currency = $status;
        $data->update();
    }
    public function regvendor($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->reg_vendor = $status;
        $data->update();
    }

    public function iscapcha($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_capcha = $status;
        $data->update();
    }

    public function isreport($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_report = $status;
        $data->update();
    }

    public function issecure($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_secure = $status;
        $data->update();
    }

    public function ismaintain($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_maintain = $status;
        $data->update();
    }

}
