<?php

namespace App\Http\Controllers\Front;

use App\Classes\GeniusMailer;
use App\Classes\Affiliate;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderTrack;
use App\Models\Product;
use App\Models\User;
use App\Models\Pagesetting;
use App\Models\UserNotification;
use App\Models\VendorOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class AuthorizeController extends Controller
{

    public function store(Request $request){

        if($request->pass_check) {
            $users = User::where('email','=',$request->personal_email)->get();
            if(count($users) == 0) {
                if ($request->personal_pass == $request->personal_confirm){
                    $user = new User;
                    $user->name = $request->personal_name; 
                    $user->email = $request->personal_email;   
                    $user->password = bcrypt($request->personal_pass);
                    $token = md5(time().$request->personal_name.$request->personal_email);
                    $user->verification_link = $token;
                    $user->affilate_code = md5($request->name.$request->email);
                    $user->email_verified = 'Yes';
                    $user->save();
                    Auth::guard('web')->login($user);                     
                }else{
                    return redirect()->back()->with('unsuccess',"Confirm Password Doesn't Match.");     
                }
            }
            else {
                return redirect()->back()->with('unsuccess',"This Email Already Exist.");  
            }
        }
        
        if (!Session::has('cart')) {
            return redirect()->route('front.cart')->with('success',"You don't have any product to checkout.");
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
            if (Session::has('currency')) 
            {
              $curr = Currency::find(Session::get('currency'));
            }
            else
            {
                $curr = Currency::where('is_default','=',1)->first();
            }

        $settings = Generalsetting::findOrFail(1);
        $orderr = new Order;
        $success_url = action('Front\PaymentController@payreturn');
        $item_name = $settings->title." Order";
        $item_number = str_random(4).time();
        $item_amount = $request->total;

        $validator = Validator::make($request->all(),[
                        'cardNumber' => 'required',
                        'cardCode' => 'required',
                        'month' => 'required',
                        'year' => 'required',
                    ]);

        if ($validator->passes()) {
        /* Create a merchantAuthenticationType object with authentication details retrieved from the constants file */

            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName($settings->authorize_login_id);
            $merchantAuthentication->setTransactionKey($settings->authorize_txn_key);

            // Set the transaction's refId
            $refId = 'ref' . time();

            // Create the payment data for a credit card
            $creditCard = new AnetAPI\CreditCardType();
            $creditCard->setCardNumber($request->cardNumber);
            $year = $request->year;
            $month = $request->month;
            $creditCard->setExpirationDate($year.'-'.$month);
            $creditCard->setCardCode($request->cardCode);

            // Add the payment data to a paymentType object
            $paymentOne = new AnetAPI\PaymentType();
            $paymentOne->setCreditCard($creditCard);
        
            // Create order information
            $order = new AnetAPI\OrderType();
            $order->setInvoiceNumber($item_number);
            $order->setDescription($item_name);

            // Create a TransactionRequestType object and add the previous objects to it
            $transactionRequestType = new AnetAPI\TransactionRequestType();
            $transactionRequestType->setTransactionType("authCaptureTransaction"); 
            $transactionRequestType->setAmount($item_amount);
            $transactionRequestType->setOrder($order);
            $transactionRequestType->setPayment($paymentOne);
            // Assemble the complete transaction request
            $requestt = new AnetAPI\CreateTransactionRequest();
            $requestt->setMerchantAuthentication($merchantAuthentication);
            $requestt->setRefId($refId);
            $requestt->setTransactionRequest($transactionRequestType);
        
            // Create the controller and get the response
            $controller = new AnetController\CreateTransactionController($requestt);
            if($settings->authorize_mode == 'SANDBOX'){
                $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
            }
            else {
                $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);                
            }


            if ($response != null) {
                // Check to see if the API request was successfully received and acted upon
                if ($response->getMessages()->getResultCode() == "Ok") {
                    // Since the API request was successful, look for a transaction response
                    // and parse it to display the results of authorizing the card
                    $tresponse = $response->getTransactionResponse();
                
                    if ($tresponse != null && $tresponse->getMessages() != null) {

                        foreach($cart->items as $key => $prod)
                        {
                        if(!empty($prod['item']['license']) && !empty($prod['item']['license_qty']))
                        {
                                foreach($prod['item']['license_qty']as $ttl => $dtl)
                                {
                                    if($dtl != 0)
                                    {
                                        $dtl--;
                                        $produc = Product::findOrFail($prod['item']['id']);
                                        $temp = $produc->license_qty;
                                        $temp[$ttl] = $dtl;
                                        $final = implode(',', $temp);
                                        $produc->license_qty = $final;
                                        $produc->update();
                                        $temp =  $produc->license;
                                        $license = $temp[$ttl];
                                         $oldCart = Session::has('cart') ? Session::get('cart') : null;
                                         $cart = new Cart($oldCart);
                                         $cart->updateLicense($prod['item']['id'],$license);  
                                         Session::put('cart',$cart);
                                        break;
                                    }                    
                                }
                        }
                        }
                                    $orderr['customer_state'] = $request->state;
                                    $orderr['shipping_state'] = $request->shipping_state;


                                    $orderr['user_id'] = $request->user_id;
                                    $orderr['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
                                    $orderr['totalQty'] = $request->totalQty;
                                    $orderr['pay_amount'] = round($item_amount / $curr->value, 2);
                                    $orderr['method'] = $request->method;
                                    $orderr['customer_email'] = $request->email;
                                    $orderr['customer_name'] = $request->name;
                                    $orderr['customer_phone'] = $request->phone;
                                    $orderr['order_number'] = $item_number;
                                    $orderr['shipping'] = $request->shipping;
                                    $orderr['pickup_location'] = $request->pickup_location;
                                    $orderr['customer_address'] = $request->address;
                                    $orderr['customer_country'] = $request->customer_country;
                                    $orderr['customer_city'] = $request->city;
                                    $orderr['customer_zip'] = $request->zip;
                                    $orderr['shipping_email'] = $request->shipping_email;
                                    $orderr['shipping_name'] = $request->shipping_name;
                                    $orderr['shipping_phone'] = $request->shipping_phone;
                                    $orderr['shipping_address'] = $request->shipping_address;
                                    $orderr['shipping_country'] = $request->shipping_country;
                                    $orderr['shipping_city'] = $request->shipping_city;
                                    $orderr['shipping_zip'] = $request->shipping_zip;
                                    $orderr['order_note'] = $request->order_notes;
                                    $orderr['coupon_code'] = $request->coupon_code;
                                    $orderr['coupon_discount'] = $request->coupon_discount;
                                    $orderr['payment_status'] = "Completed";
                                    $orderr['txnid'] = $tresponse->getTransId();
                                    $orderr['currency_sign'] = $curr->sign;
                                    $orderr['currency_value'] = $curr->value;
                                    $orderr['shipping_cost'] = $request->shipping_cost;
                                    $orderr['packing_cost'] = $request->packing_cost;
                                    $orderr['tax'] = $request->tax;
                                    $orderr['dp'] = $request->dp;
                                    $orderr['vendor_shipping_id'] = $request->vendor_shipping_id;
                                    $orderr['vendor_packing_id'] = $request->vendor_packing_id;
                                    
                                    if($orderr['dp'] == 1)
                                    {
                                        $orderr['status'] = 'completed';
                                        $val = $request->total / $curr->value;                                        
                                    }

                            // if (Session::has('affilate')) 
                            // {
                            //     $val = $request->total / $curr->value;
                            //     $val = $val / 100;
                            //     $sub = $val * $settings->affilate_charge;
                            //     $user = User::findOrFail(Session::get('affilate'));
                            //     if($orderr['dp'] == 1)
                            //     {
                            //         $user->affilate_income += $sub;
                            //         $user->update();
                            //     }
                            //     $orderr['affilate_user'] = $user->id;
                            //     $orderr['affilate_charge'] = $sub;
                            // }
                                    
                                    $orderr->save();
                
                        if($orderr->dp == 1){
                            Affiliate::setCashback($orderr->user_id, $orderr);
                            $track = new OrderTrack;
                            $track->title = 'Completed';
                            $track->text = 'Your order has completed successfully.';
                            $track->order_id = $orderr->id;
                            $track->save();
                        }
                        else {
                            $track = new OrderTrack;
                            $track->title = 'Pending';
                            $track->text = 'You have successfully placed your order.';
                            $track->order_id = $orderr->id;
                            $track->save();
                        }
                
                                    
                                    $notification = new Notification;
                                    $notification->order_id = $orderr->id;
                                    $notification->save();
                                    if($request->coupon_id != "")
                                    {
                                       $coupon = Coupon::findOrFail($request->coupon_id);
                                       $coupon->used++;
                                       if($coupon->times != null)
                                       {
                                            $i = (int)$coupon->times;
                                            $i--;
                                            $coupon->times = (string)$i;
                                       }
                                        $coupon->update();
                
                                    }
                        foreach($cart->items as $prod)
                        {
                            $x = (string)$prod['size_qty'];
                            if(!empty($x))
                            {
                                $product = Product::findOrFail($prod['item']['id']);
                                $x = (int)$x;
                                $x = $x - $prod['qty'];
                                $temp = $product->size_qty;
                                $temp[$prod['size_key']] = $x;
                                $temp1 = implode(',', $temp);
                                $product->size_qty =  $temp1;
                                $product->update();               
                            }
                        }
                
                
                        foreach($cart->items as $prod)
                        {
                            $x = (string)$prod['stock'];
                            if($x != null)
                            {
                
                                $product = Product::findOrFail($prod['item']['id']);
                                $product->stock =  $prod['stock'];
                                $product->update();  
                                if($product->stock <= 5)
                                {
                                    $notification = new Notification;
                                    $notification->product_id = $product->id;
                                    $notification->save();                    
                                }              
                            }
                        }
                
                        $notf = null;
                
                        foreach($cart->items as $prod)
                        {
                            if($prod['item']['user_id'] != 0)
                            {
                                $vorder =  new VendorOrder;
                                $vorder->order_id = $orderr->id;
                                $vorder->user_id = $prod['item']['user_id'];
                                $notf[] = $prod['item']['user_id'];
                                $vorder->qty = $prod['qty'];
                                $vorder->price = $prod['price'];
                                $vorder->order_number = $orderr->order_number;             
                                $vorder->save();
                                if($orderr->dp == 1){
                                    $vorder->user->update(['current_balance' => $vorder->user->current_balance += $prod['price']]);
                                }
                            }
                
                        }
                
                        if(!empty($notf))
                        {
                            $users = array_unique($notf);
                            foreach ($users as $user) {
                                $notification = new UserNotification;
                                $notification->user_id = $user;
                                $notification->order_number = $orderr->order_number;
                                $notification->save();    
                            }
                        }
                
                        if ($orderr->user_id != 0 && $orderr->wallet_price != 0) {
                            $transaction = new \App\Models\Transaction;
                            $transaction->txn_number = str_random(3).substr(time(), 6,8).str_random(3);
                            $transaction->user_id = $orderr->user_id;
                            $transaction->txn_number = $orderr->user_id;
                            $transaction->amount = $orderr->wallet_price;
                            $transaction->currency_sign = $orderr->currency_sign;
                            $transaction->currency_code = \App\Models\Currency::where('sign',$orderr->currency_sign)->first()->name;
                            $transaction->currency_value= $orderr->currency_value;
                            $transaction->details = 'Payment Via Wallet';
                            $transaction->type = 'minus';
                            $transaction->save();
                        }


                        $gs = Generalsetting::find(1);
                
                        //Sending Email To Buyer
                
                        if($gs->is_smtp == 1)
                        {
                        $data = [
                            'to' => $request->email,
                            'type' => "new_order",
                            'cname' => $request->name,
                            'oamount' => "",
                            'aname' => "",
                            'aemail' => "",
                            'wtitle' => "",
                            'onumber' => $orderr->order_number,
                        ];
                
                        $mailer = new GeniusMailer();
                        $mailer->sendAutoOrderMail($data,$orderr->id);            
                        }
                        else
                        {
                           $to = $request->email;
                           $subject = "Your Order Placed!!";
                           $msg = "Hello ".$request->name."!\nYou have placed a new order.\nYour order number is ".$orderr->order_number.".Please wait for your delivery. \nThank you.";
                            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                           mail($to,$subject,$msg,$headers);            
                        }
                        //Sending Email To Admin
                        if($gs->is_smtp == 1)
                        {
                            $data = [
                                'to' => Pagesetting::find(1)->contact_email,
                                'subject' => "New Order Recieved!!",
                                'body' => "Hello Admin!<br>Your store has received a new order.<br>Order Number is ".$orderr->order_number.".Please login to your panel to check. <br>Thank you.",
                            ];
                
                            $mailer = new GeniusMailer();
                            $mailer->sendCustomMail($data);            
                        }
                        else
                        {
                           $to = Pagesetting::find(1)->contact_email;
                           $subject = "New Order Recieved!!";
                           $msg = "Hello Admin!\nYour store has recieved a new order.\nOrder Number is ".$orderr->order_number.".Please login to your panel to check. \nThank you.";
                            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                           mail($to,$subject,$msg,$headers);
                        }
                
                            Session::put('temporder',$orderr);
                            Session::put('tempcart',$cart);
                            Session::forget('cart');
                            //---------------------
                            Session::forget('final_results');
                            Session::forget('vendor_id');
                            Session::forget('every_shop_total_price');
                            //----------------------
                            Session::forget('already');
                            Session::forget('coupon');
                            Session::forget('coupon_total');
                            Session::forget('coupon_total1');
                            Session::forget('coupon_percentage');
                            return redirect($success_url);

                    } else {
                        return back()->with('unsuccess', 'Payment Failed.');
                    }
                    // Or, print errors if the API request wasn't successful
                } else {
                    return back()->with('unsuccess', 'Payment Failed.');
                }      
            } else {
                return back()->with('unsuccess', 'Payment Failed.');
            }

        }
        return back()->with('unsuccess', 'Invalid Payment Details.');
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