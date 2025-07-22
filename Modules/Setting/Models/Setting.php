<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Setting\Database\Factories\SettingFactory;

class Setting extends Model
{
    use HasFactory;

    protected $table="settings";
    protected $fillable = [
        'logo',
        'favicon',
        'contact_email',
        'contact_no',
        'address',
        'opening_time',
        'footer_text',
        'newsletter_title',
        'newsletter_desc',
        'login_title',
        'login_desc',
        'register_title',
        'register_desc',
        'register_info',
        'register_doc',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'youtube',
        'telegram',
        'smtp_host',
        'smtp_port',
        'smtp_username',
        'smtp_password',
        'smtp_encryption',
        'protocol',
        'smtp_status',
        'recapcha_sitekey',
        'recapcha_secretkey',
        'recapcha_status',
        'google_client_id',
        'google_client_secret',
        'google_redirect_uri',
        'google_signin_status',
        'paypal_client_id_sandbox',
        'paypal_secret_sandbox',
        'paypal_client_id_live',
        'paypal_secret_live',
        'paypal_mode',
        'paypal_status',
        'stripe_key',
        'stripe_secret',
        'stripe_status',
        'razorpay_key_id',
        'razorpay_key_secret',
        'razorpay_status',
        'payu_merchant_key',
        'payu_merchant_salt',
        'payu_sandbox',
        'payu_status'
    ];

    // protected static function newFactory(): SettingFactory
    // {
    //     // return SettingFactory::new();
    // }
}
