<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            
            // Payment information
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('XAF');
            $table->string('payment_method'); // MTN, ORANGE, etc.
            $table->string('phone_number');
            $table->string('reference')->unique();
            $table->string('status')->default('pending');
            
            // Donor information
            $table->boolean('anonymous')->default(false);
            $table->string('donor_name')->nullable();
            $table->string('donor_email')->nullable();
            $table->text('message')->nullable();
            
            // Relationships
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            
            // Additional metadata
            $table->string('external_reference')->nullable();
            $table->json('campay_response')->nullable();
            $table->string('network_transaction_id')->nullable();
            
            // Timestamps
            $table->timestamps();
            $table->timestamp('completed_at')->nullable();
            
            // Indexes
            $table->index('reference');
            $table->index('status');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};