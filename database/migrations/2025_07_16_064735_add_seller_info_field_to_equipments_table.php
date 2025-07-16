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
        Schema::table('equipments', function (Blueprint $table) {
            $table->string('company_name',200)->nullable()->after('thumbnail');
            $table->string('contact_name',100)->nullable()->after('company_name');
            $table->string('contact_email',100)->nullable()->after('contact_name');
            $table->string('contact_no',20)->nullable()->after('contact_email');

            $table->string('meta_title')->nullable()->after('contact_no');
            $table->text('meta_keyword')->nullable()->after('meta_title');
            $table->text('meta_desc')->nullable()->after('meta_keyword');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipments', function (Blueprint $table) {
            //
        });
    }
};
