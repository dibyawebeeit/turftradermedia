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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('subscription_plan_id')->constrained();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('cancel_date')->nullable();
            $table->double('used_amount')->default(0);
            $table->enum('type', ['monthly', 'annual']);
            $table->double('amount')->nullable();
            $table->string('txn_id',100)->nullable();
            $table->string('payment_type',50)->nullable();
            $table->enum('status', ['active', 'cancelled', 'expired', 'pending']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
