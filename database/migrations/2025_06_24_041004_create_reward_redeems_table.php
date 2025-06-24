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
        Schema::create('reward_redeems', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('donation_id');
            $table->bigInteger('user_id');
            $table->bigInteger('donation_log_id');
            $table->string('payment_gateway');
            $table->string('withdraw_request_amount');
            $table->text('payment_account_details');
            $table->text('payment_information')->nullable();
            $table->longText('additional_comment_by_user')->nullable();
            $table->string('transaction_id')->nullable();
            $table->longText('additional_comment_by_admin')->nullable();
            $table->string('payment_receipt')->nullable();
            $table->string('payment_status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_redeems');
    }
};
