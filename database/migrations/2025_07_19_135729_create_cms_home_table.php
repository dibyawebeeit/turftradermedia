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
        Schema::create('cms_home', function (Blueprint $table) {
            $table->id();
            $table->string('title1')->nullable();
            $table->string('title2')->nullable();
            $table->string('banner',100)->nullable();   
            $table->string('section1_title')->nullable();
            $table->string('section1_title2')->nullable();
            $table->string('section1_button_text')->nullable();
            $table->string('section1_button_url')->nullable();
            $table->string('section1_image',100)->nullable();
            $table->string('section2_title')->nullable();
            $table->string('section2_title2')->nullable();
            $table->text('section2_title3')->nullable();
            $table->string('section2_image',100)->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_desc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_home');
    }
};
