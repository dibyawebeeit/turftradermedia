<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo',100)->nullable();
            $table->string('favicon',100)->nullable();
            $table->string('contact_email',100)->nullable();
            $table->string('contact_no',20)->nullable();
            $table->string('address')->nullable();
            $table->string('opening_time')->nullable();
            $table->string('footer_text')->nullable();
            $table->string('newsletter_title')->nullable();
            $table->text('newsletter_desc')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('telegram')->nullable();

            $table->string('smtp_host',100)->nullable();
            $table->string('smtp_port',100)->nullable();
            $table->string('smtp_username',100)->nullable();
            $table->string('smtp_password',100)->nullable();
            $table->string('smtp_encryption',20)->nullable();
            $table->string('protocol',20)->nullable();
            $table->tinyInteger('smtp_status')->default(0);

            $table->string('recapcha_sitekey')->nullable();
            $table->string('recapcha_secretkey')->nullable();
            $table->tinyInteger('recapcha_status')->default(0);

            $table->string('google_client_id')->nullable();
            $table->string('google_client_secret')->nullable();
            $table->string('google_redirect_uri')->nullable();
            $table->tinyInteger('google_signin_status')->default(0);

            $table->string('paypal_client_id_sandbox')->nullable();
            $table->string('paypal_secret_sandbox')->nullable();
            $table->string('paypal_client_id_live')->nullable();
            $table->string('paypal_secret_live')->nullable();
            $table->string('paypal_mode',20)->nullable();
            $table->tinyInteger('paypal_status')->default(0);

            $table->string('stripe_key')->nullable();
            $table->string('stripe_secret')->nullable();
            $table->tinyInteger('stripe_status')->default(0);

            $table->string('razorpay_key_id')->nullable();
            $table->string('razorpay_key_secret')->nullable();
            $table->tinyInteger('razorpay_status')->default(0);

            $table->string('payu_merchant_key')->nullable();
            $table->string('payu_merchant_salt')->nullable();
            $table->string('payu_sandbox',20)->nullable();
            $table->tinyInteger('payu_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
