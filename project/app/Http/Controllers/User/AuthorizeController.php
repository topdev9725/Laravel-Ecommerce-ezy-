<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\GeniusMailer;
use App\Models\Generalsetting;
use App\Models\Subscription;
use App\Models\UserSubscription;
use Auth;
use Carbon\Carbon;
use Validator;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class AuthorizeController extends Controller
{

    public function store(Request $request){

        $this->validate($request, [
            'shop_name'   => 'unique:users',
           ],[ 
               'shop_name.unique' => 'This shop name has already been taken.'
            ]);
            $user = Auth::user();
            $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
            $subs = Subscription::findOrFail($request->subs_id);
            $settings = Generalsetting::findOrFail(1);
            $today = Carbon::now()->format('Y-m-d');



        $item_name = $subs->title." Plan";
        $item_number = str_random(4).time();
        $item_amount = $subs->price;
        $input = $request->all();  
        $user->is_vendor = 2;


        $validator = Validator::make($request->all(),[
                        'cardNumber' => 'required',
                        'cardCode' => 'required',
                        'amonth' => 'required',
                        'ayear' => 'required',
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
            $year = $request->ayear;
            $month = $request->amonth;
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

                        $user->is_vendor = 2;
                        if(!empty($package))
                        {
                            if($package->subscription_id == $request->subs_id)
                            {
                                $newday = strtotime($today);
                                $lastday = strtotime($user->date);
                                $secs = $lastday-$newday;
                                $days = $secs / 86400;
                                $total = $days+$subs->days;
                                $user->date = date('Y-m-d', strtotime($today.' + '.$total.' days'));
                            }
                            else
                            {
                                $user->date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
                            }
                        }
                        else
                        {
                            $user->date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
                        }
                        $user->mail_sent = 1;     
                        $user->update($input);
                        
                        $sub = new UserSubscription;
                        $sub->user_id = $user->id;
                        $sub->subscription_id = $subs->id;
                        $sub->title = $subs->title;
                        $sub->currency = $subs->currency;
                        $sub->currency_code = $subs->currency_code;
                        $sub->price = $subs->price;
                        $sub->days = $subs->days;
                        $sub->allowed_products = $subs->allowed_products;
                        $sub->details = $subs->details;
                        $sub->method = 'Authorize.net';
                        $sub->txnid = $tresponse->getTransId();
                        $sub->status = 1;
                        $sub->save();

                        if($settings->is_smtp == 1)
                        {
                        $data = [
                            'to' => $user->email,
                            'type' => "vendor_accept",
                            'cname' => $user->name,
                            'oamount' => "",
                            'aname' => "",
                            'aemail' => "",
                            'onumber' => "",
                        ];
                        $mailer = new GeniusMailer();
                        $mailer->sendAutoMail($data);        
                        }
                        else
                        {
                        $headers = "From: ".$settings->from_name."<".$settings->from_email.">";
                        mail($user->email,'Your Vendor Account Activated','Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.',$headers);
                        }
    
                        return redirect()->route('user-dashboard')->with('success','Vendor Account Activated Successfully');

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

}