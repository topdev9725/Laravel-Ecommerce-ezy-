<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Classes\GeniusMailer;
use App\Models\Deposit;
use App\Models\Currency;
use App\Models\Transaction;
use Auth;
use Session;
use Validator;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class DauthorizeController extends Controller
{
    public function store(Request $request){

        $user = Auth::user();
        $settings = Generalsetting::findOrFail(1);
        $item_name = "Deposit Via  Authorize.net";
        $item_number = str_random(4).time();
        $item_amount = $request->amount;
        if (Session::has('currency'))
        {
            $curr = Currency::find(Session::get('currency'));
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
        }


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

                        $user->balance = $user->balance + ($request->amount / $curr->value);
                        $user->mail_sent = 1;
                        $user->save();
      
                        $deposit = new Deposit;
                        $deposit->user_id = $user->id;
                        $deposit->currency = $curr->sign;
                        $deposit->currency_code = $curr->name;
                        $deposit->currency_value = $curr->value;
                        $deposit->amount = $request->amount / $curr->value;
                        $deposit->method = 'Authorize.net';
                        $deposit->txnid = $tresponse->getTransId();
                        $deposit->status = 1;
                        $deposit->save();
      
                        // store in transaction table
                        if ($deposit->status == 1) {
                          $transaction = new Transaction;
                          $transaction->txn_number = str_random(3).substr(time(), 6,8).str_random(3);
                          $transaction->user_id = $deposit->user_id;
                          $transaction->amount = $deposit->amount;
                          $transaction->user_id = $deposit->user_id;
                          $transaction->currency_sign = $deposit->currency;
                          $transaction->currency_code = $deposit->currency_code;
                          $transaction->currency_value= $deposit->currency_value;
                          $transaction->method = $deposit->method;
                          $transaction->txnid = $deposit->txnid;
                          $transaction->details = 'Payment Deposit';
                          $transaction->type = 'plus';
                          $transaction->save();
                        }
      
                        if($settings->is_smtp == 1)
                        {
                          $data = [
                              'to' => $user->email,
                              'type' => "wallet_deposit",
                              'cname' => $user->name,
                              'damount' => $deposit->amount,
                              'wbalance' => $user->balance,
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
                          @mail($user->email,'Balance has been added to your account. Your current balance is: $' . $user->balance, $headers);
                        }

                        return redirect()->route('user-dashboard')->with('success','Balance has been added to your account.');

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