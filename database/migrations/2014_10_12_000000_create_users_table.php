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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique();
            $table->string('email',119)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable();
            $table->text('email_verify_token')->nullable();
            $table->text('address')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('password');
            $table->string('status');
            $table->integer('country_id')->nullable();
            $table->integer('monthly_income')->nullable();
            $table->integer('annual_income')->nullable();
            $table->string('income_source')->nullable();
            $table->string('nid_image')->nullable();
            $table->string('driving_license_image')->nullable();
            $table->string('passport_image')->nullable();
            $table->string('tax_verify_status')->nullable();
            $table->string('user_verify_nid')->nullable();
            $table->string('user_verify_address')->nullable();
            $table->bigInteger('user_verify_status')->default(0);
            $table->string('apple_id')->nullable();
            $table->bigInteger('deactivate')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
