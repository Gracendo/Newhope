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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orphanage_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('image')->nullable();
            $table->json('gallery')->nullable(); // Pour une galerie d'images en JSON
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('project_duration')->nullable();
            $table->text('objectif')->nullable();
            $table->string('status')->default('pending');
            $table->string('business_plan')->nullable();
            $table->decimal('goal_amount', 15, 2)->default(0);
            $table->json('prefered_amounts')->nullable(); // Tableau JSON des montants préférés
            $table->decimal('raised_amount', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
