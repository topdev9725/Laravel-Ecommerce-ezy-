<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Generalsetting extends Model
{
    protected $fillable = ['logo', 'favicon', 'title','header_email','header_phone', 'footer','copyright','colors','loader','admin_loader','talkto','map_key','disqus','stripe_key','stripe_secret','currency_format','withdraw_fee','withdraw_charge','tax','shipping_cost','smtp_host','smtp_port','smtp_user','smtp_pass','from_email','from_name','add_cart','out_stock','already_cart','add_wish','already_wish','wish_remove','add_compare','already_compare','compare_remove','color_change','coupon_found','no_coupon','already_coupon','order_title','order_text','is_affilate','affilate_charge','affilate_banner','fixed_commission','percentage_commission','multiple_shipping','vendor_ship_info','cod_text','paypal_text','stripe_text','header_color','footer_color','copyright_color','menu_color','menu_hover_color','is_verification_email','instamojo_key','instamojo_token','instamojo_text','instamojo_sandbox','paystack_key','paystack_email','paystack_text','wholesell','is_capcha','error_banner','popup_title','popup_text','popup_background','invoice_logo','user_image','vendor_color','is_secure','footer_logo','email_encryption','paytm_merchant','paytm_secret','paytm_website','paytm_industry','is_paytm','paytm_text','paytm_mode','molly_key','molly_text','razorpay_key','razorpay_secret','razorpay_text','maintain_text','authorize_login_id','authorize_txn_key','authorize_text','authorize_mode','mercado_token','mercado_text','twocheckout_private_key','twocheckout_seller_id','twocheckout_public_key','twocheckout_sandbox_check','twocheckout_text','ssl_sandbox_check','ssl_store_id','ssl_store_password','ssl_text','vougepay_merchant_id','vougepay_developer_code','voguepay_text','mail_engine','paypal_client_id','paypal_client_secret','paypal_sandbox_check','mercadopago_sandbox_check', 'affiliate_max_layers', 'affiliate_min_amount',  'affiliate_members', 'map_api_key', 'stripe_tax', 'bank_check', 'bank_text', 'bank_tax', 'surepay_check', 'merchant_id', 'surepay_api_key', 'surepay_bank_code', 'surepay_tax', 'surepay_text'];

    public $timestamps = false;

    public function upload($name,$file,$oldname)
    {
                $file->move('assets/images',$name);
                if($oldname != null)
                {
                    if (file_exists(public_path().'/assets/images/'.$oldname)) {
                        unlink(public_path().'/assets/images/'.$oldname);
                    }
                }
    }
}
