<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Generalsetting;
use App\Models\AutodebitOrder;
use App\Models\AutodebitInsurranceOrder;
use App\Models\AutodebitSubscription;
use App\Models\NewNotification;
use App\Models\Transaction;
use App\Models\Currency;
use App\Classes\Affiliate;

class AutodebitSubscriptionCommand extends Command
{

    protected $signature = 'autodebit:subscription';

    protected $description = 'Autodebit Subscriptiion';

    public function __construct()
    {
        parent::__construct();
    }

    protected function checkExpired($date, $terms) {
        $cur_date = date_create(date("Y-m-d"));
        $date2 = date_create($date);
        $diff = date_diff($cur_date, $date2);
        return $diff->format("%a")>=$terms;
    }

    protected function subscript($user_id, $vendor_id, $cost, $method, $category_id) {
        $user = User::findOrFail($user_id);
        $vendor = User::findOrFail($vendor_id);
        $cashback = Affiliate::setAutodebitCashback($user_id, $amount, $category_id);
        $user->balance -= $cost;
        $user->save();
        $notify = new NewNotification;
        $notify->setAutodebitNotification($user->id, $vendor_id, $cost, 2); 
        
        $vendor_amount = $cost - $cashback;
        $vendor->balance += $vendor_amount;
        $vendor->save();
        $notify = new NewNotification;
        $notify->setAutodebitNotification($user->id, $vendor_id, $vendor_amount, 3);
        
        $this->newTransactionUser($user_id, $cost, $method, $vendor->shop_name);
        $this->newTransactionVendor($vendor_id, $vendor_amount, $method);
    }

    protected function newTransactionUser($user_id, $amount, $method, $shop_name) {        
        $sign = Currency::where('is_default','=',1)->first();
        $transaction = new Transaction;
        $transaction->txn_number = str_random(3).substr(time(), 6,8).str_random(3);
        $transaction->amount = $amount;
        $transaction->user_id = $user_id;
        $transaction->currency_sign = $sign->sign;
        $transaction->currency_code = $sign->name;
        $transaction->currency_value = $sign->value;
        $transaction->method = 'autodebit subscription';
        $transaction->txnid = null;
        $transaction->details = 'Debit by '.$method.' Autodebit Subscription on <b>'.$shop_name.'</b>';
        $transaction->type = 'minus';
        $transaction->save();
    }

    protected function newTransactionVendor($user_id, $amount, $method) {        
        $sign = Currency::where('is_default','=',1)->first();
        $transaction = new Transaction;
        $transaction->txn_number = str_random(3).substr(time(), 6,8).str_random(3);
        $transaction->amount = $amount;
        $transaction->user_id = $user_id;
        $transaction->currency_sign = $sign->sign;
        $transaction->currency_code = $sign->name;
        $transaction->currency_value = $sign->value;
        $transaction->method = 'autodebit subscription';
        $transaction->txnid = null;
        $transaction->details = 'Credit by '.$method.' Autodebit Subscription';
        $transaction->type = 'plus';
        $transaction->save();
    }

    public function handle()
    {
        $all_orders = AutodebitOrder::where('status','=',1)->get();
        foreach($all_orders as $order) {
            $subscription = AutodebitSubscription::findOrFail($order->subscription_id);
            $user = User::findOrFail($order->user_id);
            if($this->checkExpired($order->updated_at, $order->terms)) {
                $order->status = 4;
                $order->save();

                $notify = new NewNotification;
                $notify->setAutodebitNotification($order->user_id, $subscription->cost, 0); //0=>expired
            } else if($user->balance<$subscription->cost) {
                $order->status = 3;
                $order->save();

                $notify = new NewNotification;
                $notify->setAutodebitNotification($order->user_id, $subscription->cost, 1); //1=>canceled
            } else {
                $y = date('Y', strtotime($order->updated_at));
                $m = date('m', strtotime($order->updated_at));
                $d = date('d', strtotime($order->updated_at));
                $cur_y = date('Y');
                $cur_m = date('m');
                $cur_d = date('d');
                $f = false;
                if($subscription->method == 'monthly') {
                    $title = $subscription->title.' / Monthly';
                    if($d == $cur_d){
                        $f = true;
                    }
                } elseif($subscription->method == 'quarter') {
                    $title = $subscription->title.' / Quarter';
                    if($d == $cur_d && ($cur_m - $m)%3==0 && ($y==$cur_y && $cur_m>$m || $cur_y>$y)) {
                        $f = true;
                    }
                } elseif($subscription->method == 'half_year') {
                    $title = $subscription->title.' / Half Year';
                    if($d == $cur_d && ($cur_m - $m)%6==0 && ($y==$cur_y && $cur_m>$m || $cur_y>$y)) {
                        $f = true;
                    }
                } elseif($subscription->method == 'yearly') {
                    $title = $subscription->title.' / Yearly';
                    if($d == $cur_d && $cur_m = $m && $cur_y>$y) {
                        $f = true;
                    }
                }
                if($f) {
                    $this->subscript($user->id, $order->vendor_id, $subscription->cost, $title, $order->category_id);
                }
            }
        }     
        
        $all_orders = AutodebitInsurranceOrder::where('status','=',1)->get();
        foreach($all_orders as $order) {
            $user = User::findOrFail($order->user_id);
            if($this->checkExpired($order->updated_at, $order->terms)) {
                $order->status = 4;
                $order->save();

                $notify = new NewNotification;
                $notify->setAutodebitNotification($order->user_id, $order->amount, 0); //0=>expired
            } else if($user->balance<$$order->amount) {
                $order->status = 3;
                $order->save();

                $notify = new NewNotification;
                $notify->setAutodebitNotification($order->user_id, $$order->amount, 1); //1=>canceled
            } else {
                $y = date('Y', strtotime($order->updated_at));
                $m = date('m', strtotime($order->updated_at));
                $d = date('d', strtotime($order->updated_at));
                $cur_y = date('Y');
                $cur_m = date('m');
                $cur_d = date('d');
                $f = false;
                if($order->method == 'monthly') {
                    $title = ' Insurrance / Monthly';
                    if($d == $cur_d){
                        $f = true;
                    }
                } elseif($order->method == 'quarter') {
                    $title = ' Insurrance / Quarter';
                    if($d == $cur_d && ($cur_m - $m)%3==0 && ($y==$cur_y && $cur_m>$m || $cur_y>$y)) {
                        $f = true;
                    }
                } elseif($order->method == 'half_year') {
                    $title = ' Insurrance / Half Year';
                    if($d == $cur_d && ($cur_m - $m)%6==0 && ($y==$cur_y && $cur_m>$m || $cur_y>$y)) {
                        $f = true;
                    }
                } elseif($order->method == 'yearly') {
                    $title = ' Insurrance / Yearly';
                    if($d == $cur_d && $cur_m = $m && $cur_y>$y) {
                        $f = true;
                    }
                }
                if($f) {
                    $this->subscript($user->id, $order->vendor_id, $order->cost, $title, $order->category_id);
                }
            }
        }     
        $this->info('Autodebit Subscription has been done successfully');
    }
}
