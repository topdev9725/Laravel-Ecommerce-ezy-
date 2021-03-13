<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Generalsetting;
use App\Models\Order;
use App\Models\AutodebitOrder;
use App\Models\AutodebitInsurranceOrder;
use App\Models\AutodebitSubscription;
use App\Models\NewNotification;

class ApplyCashback extends Command
{

    protected $signature = 'apply:cashback';

    protected $description = 'Apply cashback to balance monthly';

    public function __construct()
    {
        parent::__construct();
    }

    protected function checkLastMonthSpent($user_id) {
        $cm = date('n');
        $cy = date('Y');
        $cd = date('d');
        $s_date = date('Y-n-d H:i:s', mktime(0, 0, 0, $cm-1, 1, $cy));
        $e_date = date('Y-n-d H:i:s', mktime(0, 0, 0, $cm, $cd-1, $cy));
        $orders = Order::where('created_at','>=',$s_date)->where('created_at','<=',$e_date)
                        ->where('status','=','completed')->where('user_id', '=', $user_id)->get();
        $price = 0; $gs = Generalsetting::findOrFail(1);
        if($orders) {
            foreach($orders as $order) {
                $price += $order->pay_amount + $order->wallet_price;
            }
        }
        return ($price >= $gs->affiliate_min_amount);
    }
    
    protected function newNotification($user_id, $amount) {        
        $notif = new NewNotification;
        $notif->user_id = $user_id;
        $notif->message = Common::formatPrice($amount).' has been added to your wallet from affilate bonus';
        $notif->save();
    }
    
    protected function newNotification1($user_id, $amount) {        
        $notif = new NewNotification;
        $notif->user_id = $user_id;
        $notif->message = 'Your affilate bonus became 0 because of not spending RM 350 for a month';
        $notif->save();
    }

    public function handle()
    {
        $all_users = User::where('affilate_income','>', 0)->get();
        
        if(count($all_users) != 0) {
            foreach($all_users as $user) {
                $spending_amount = 0;
                $orders = $user->orders()->where('status','completed')->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->get();
                $autdebit_orders = AutodebitOrder::where('user_id', $user->id)->where('status', 1)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->get();
                $insurrance_orders = AutodebitInsurranceOrder::where('user_id', $user->id)->where('status', 1)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->get();
                
                foreach($orders as $order) {
                    $spending_amount += $order->wallet_price;
                }
                foreach($autdebit_orders as $order) {
                    $sub_cost = AutodebitSubscription::where('id', $order->subscription_id)->first()->cost;
                    $spending_amount += $order->sub_cost;
                }
                foreach($insurrance_orders as $order) {
                    $spending_amount += $order->amount;
                }

                if($this->checkLastMonthSpent($user->id) && $spending_amount >= 350) {
                    self::newNotification($user->id, $user->affilate_income);
                    $user->balance += $user->affilate_income;
                    $user->affilate_income = 0;
                    $user->save();
                } elseif($this->checkLastMonthSpent($user->id) && $spending_amount < 350) {
                    $user->affilate_income = 0;
                    $user->save();
                    self::newNotification1($user->id, $user->affilate_income);
                }
            }
        }        
        $this->info('Cashback of each user applied to balance');
    }
}
