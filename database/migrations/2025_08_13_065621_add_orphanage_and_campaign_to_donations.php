<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            // Add orphanage_id (nullable)
            $table->unsignedBigInteger('orphanage_id')->nullable()->after('user_id');
            $table->foreign('orphanage_id')
                  ->references('id')
                  ->on('orphanages')
                  ->onDelete('set null');
            
            // Add campaign_id (nullable)
            $table->unsignedBigInteger('campaign_id')->nullable()->after('orphanage_id');
            $table->foreign('campaign_id')
                  ->references('id')
                  ->on('campaigns')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['orphanage_id']);
            $table->dropForeign(['campaign_id']);
            
            // Then drop columns
            $table->dropColumn('orphanage_id');
            $table->dropColumn('campaign_id');
        });
    }
};