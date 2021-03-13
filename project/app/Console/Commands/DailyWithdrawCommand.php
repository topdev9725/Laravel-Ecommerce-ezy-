<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\Common;
use App\Models\User;
use App\Models\Generalsetting;
use App\Models\Withdraw;
use App\Models\NewNotification;
use App\Models\Transaction;
use App\Models\Currency;

class DailyWithdrawCommand extends Command
{

    protected $signature = 'withdraw:daily';

    protected $description = 'Withdrawal for Stores Daily';

    public function __construct()
    {
        parent::__construct();
    }

    protected function newTransaction($user_id, $amount) {
        $sign = Currency::where('is_default','=',1)->first();
        $transaction = new Transaction;
        $transaction->txn_number = str_random(3).substr(time(), 6,8).str_random(3);
        $transaction->amount = $amount;
        $transaction->user_id = $user_id;
        $transaction->currency_sign = $sign->sign;
        $transaction->currency_code = $sign->name;
        $transaction->currency_value = $sign->value;
        $transaction->method = 'auto withdraw request';
        $transaction->txnid = null;
        $transaction->details = 'Debit by Daily Auto-Withdrawal Request';
        $transaction->type = 'minus';
        $transaction->save();
    }

    protected function newNotification($user_id, $amount) {        
        $notif = new NewNotification;
        $notif->user_id = $user_id;
        $notif->message = Common::formatPrice($amount).' has been debitted by Daily Auto-Withdrawal Request from your balance';
        $notif->save();
    }

    public function handle()
    {
        $vendors = User::where('nearby', '=', 1)->where('withdraw_setting','=',1)->get();
        foreach($vendors as $vendor) {
            if($vendor->balance>0) {
                $withdraw = new Withdraw;
                $withdraw->user_id = $vendor->id;
                $withdraw->method = 'bank';
                $withdraw->amount = $vendor->balance;
                $withdraw->type = 'vendor';
                $withdraw->save();
                $this->newTransaction($vendor->id, $vendor->balance);
                $this->newNotification($vendor->id, $vendor->balance);
                $vendor->balance = 0;
                $vendor->save();
            }
        }           
        $this->info('Daily Withdrawal Request has been done successfully');
    }
}
