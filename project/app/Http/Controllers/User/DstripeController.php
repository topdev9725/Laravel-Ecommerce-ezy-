<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Models\Generalsetting;
use App\Classes\GeniusMailer;
use App\Models\Deposit;
use App\Models\Currency;
use App\Models\Transaction;
use Config;
use Auth;
use Session;
use Validator;


class DstripeController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
      //Set Spripe Keys
      $stripe = Generalsetting::findOrFail(1);
      Config::set('services.stripe.key', $stripe->stripe_key);
      Config::set('services.stripe.secret', $stripe->stripe_secret);
  }


  public function store(Request $request) {

      $user = Auth::user();
      $settings = Generalsetting::findOrFail(1);
      $item_name = "Deposit Via  Stripe";
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
                      'card' => 'required',
                      'cvv' => 'required',
                      'month' => 'required',
                      'year' => 'required',
                  ]);
      if ($validator->passes()) {

          $stripe = Stripe::make(Config::get('services.stripe.secret'));
          try{
              $token = $stripe->tokens()->create([
                  'card' =>[
                          'number' => $request->card,
                          'exp_month' => $request->month,
                          'exp_year' => $request->year,
                          'cvc' => $request->cvv,
                      ],
                  ]);
              if (!isset($token['id'])) {
                  return back()->with('error','Token Problem With Your Token.');
              }

              $charge = $stripe->charges()->create([
                  'card' => $token['id'],
                  'currency' => $curr->name,
                  'amount' => $item_amount,
                  'description' => $item_name,
              ]);

              if ($charge['status'] == 'succeeded') {

                  $user->balance = $user->balance + ($request->amount / $curr->value);
                  $user->mail_sent = 1;
                  $user->save();

                  $deposit = new Deposit;
                  $deposit->user_id = $user->id;
                  $deposit->currency = $curr->sign;
                  $deposit->currency_code = $curr->name;
                  $deposit->currency_value = $curr->value;
                  $deposit->amount = $request->amount / $curr->value;
                  $deposit->method = 'Stripe';
                  $deposit->txnid = $charge['balance_transaction'];
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

              }

          }catch (Exception $e){
              return back()->with('unsuccess', $e->getMessage());
          }catch (\Cartalyst\Stripe\Exception\CardErrorException $e){
              return back()->with('unsuccess', $e->getMessage());
          }catch (\Cartalyst\Stripe\Exception\MissingParameterException $e){
              return back()->with('unsuccess', $e->getMessage());
          }
      }
      return back()->with('unsuccess', 'Please Enter Valid Credit Card Informations.');
  }
}
