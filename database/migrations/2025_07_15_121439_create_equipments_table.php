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
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('manufacturer_id')->constrained();
            $table->foreignId('equipment_model_id')->constrained();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('vin',50)->nullable();
            $table->string('year',4)->nullable();
            $table->integer('hours')->default(0);
            $table->enum('condition', ['New','Salvaged','Used'])->default('Used');
            $table->double('price')->default(0.00);
            $table->foreignId('currency_id')->constrained();
            $table->string('machine_location')->nullable();
            $table->text('description')->nullable();
            $table->text('details')->nullable();
            $table->string('thumbnail',100)->nullable();
            $table->foreignId('customer_id')->constrained();
            $table->tinyInteger('publish_status')->default(1);
            $table->tinyInteger('admin_approval')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipments');
    }
};
