<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Classes\Affiliate;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'userLogout']]);
    }

    public function showLoginForm()
    {
      $this->code_image();
      return view('user.login');
    }

    public function login(Request $request)
    {
        //--- Validation Section
        $rules = [
                  'name'   => 'required',
                  'password' => 'required'
                ];

        $validator = Validator::make(Input::all(), $rules);

        $remember_me = $request->remember ? true : false; 
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

      // Attempt to log the user in
      if (Auth::attempt(['name' => $request->name, 'password' => $request->password], $remember_me)) {
        // if successful, then redirect to their intended location

        // Check If Email is verified or not
          if(Auth::guard('web')->user()->email_verified == 'No')
          {
            Auth::guard('web')->logout();
            return response()->json(array('errors' => [ 0 => 'Your Email is not Verified!' ]));   
          }

          if(Auth::guard('web')->user()->ban == 1)
          {
            Auth::guard('web')->logout();
            return response()->json(array('errors' => [ 0 => 'Your Account Has Been Banned.' ]));   
          }
			  
		  	$affiliate_id = 0;
          	// affiliate // Liyin
          	if(Session::has('affilate')) {
            	$affiliate_id = Session::get('affilate');            	
			}
      Affiliate::setAffiliateUser($request->email, $affiliate_id);
      $user = Auth::guard('web')->user();
      $geolocation = new \stdClass();
      $geolocation->address = $user->address;  
      $geolocation->latitude = $user->latitude;
      $geolocation->longitude = $user->longitude;
      Session::put('geolocation', $geolocation);

          // Login Via Modal
          if(!empty($request->modal))
          {
             // Login as Vendor
            if(!empty($request->vendor))
            {
              if(Auth::guard('web')->user()->is_vendor == 2)
              {
                return response()->json(route('vendor-dashboard'));
              }
              else {
                return response()->json(route('user-package'));
                }
            }
            if(Auth::user()->IsVendor()) {
              return response()->json(route('vendor-dashboard'));
            } else {
              // Login as User
              return response()->json(1);          
            }           
          }
          // Login as User
          return response()->json(route('user-dashboard'));
      }

      // if unsuccessful, then redirect back to the login with the form data
          return response()->json(array('errors' => [ 0 => 'Credentials Doesn\'t Match !' ]));     
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        Session::forget('geolocation');
        Session::forget('cart');
        Session::forget('final_results');
        Session::forget('every_shop_total_price');
        Session::forget('state');
        Session::forget('shipping_name');
        Session::forget('shipping_phone');
        Session::forget('shipping_address');
        Session::forget('shipping_city');
        Session::forget('shipping_state');
        Session::forget('shipping_zip');
        return redirect('/');
    }

    // Capcha Code Image
    private function  code_image()
    {
        $actual_path = str_replace('project','',base_path());
        $image = imagecreatetruecolor(200, 50);
        $background_color = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image,0,0,200,50,$background_color);

        $pixel = imagecolorallocate($image, 0,0,255);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixel);
        }

        $font = $actual_path.'assets/front/fonts/NotoSans-Bold.ttf';
        $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $length = strlen($allowed_letters);
        $letter = $allowed_letters[rand(0, $length-1)];
        $word='';
        //$text_color = imagecolorallocate($image, 8, 186, 239);
        $text_color = imagecolorallocate($image, 0, 0, 0);
        $cap_length=6;// No. of character in image
        for ($i = 0; $i< $cap_length;$i++)
        {
            $letter = $allowed_letters[rand(0, $length-1)];
            imagettftext($image, 25, 1, 35+($i*25), 35, $text_color, $font, $letter);
            $word.=$letter;
        }
        $pixels = imagecolorallocate($image, 8, 186, 239);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixels);
        }
        session(['captcha_string' => $word]);
        imagepng($image, $actual_path."assets/images/capcha_code.png");
    }
    
}
