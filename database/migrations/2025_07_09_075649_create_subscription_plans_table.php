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
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('monthly_price', 8, 2)->nullable();
            $table->decimal('annual_price', 8, 2)->nullable();
            $table->text('description')->nullable();
            $table->string('offer',100)->nullable();
            $table->integer('duration')->default(0)->comment('in days');
            $table->integer('no_of_listing')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->SoftDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};
