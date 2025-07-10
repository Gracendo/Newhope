<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orphanages', function (Blueprint $table) {
            $table->id();
            $table->string('orphanage_id')->unique(); // identifiant interne (autre que id)
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            // Required fields
            $table->string('name');
            $table->decimal('longitude', 11, 8);
            $table->decimal('latitude', 10, 8);
            $table->string('country');
            $table->string('city');
            $table->string('num_enregistrement');
            $table->string('phone');
            // Optional fields
            $table->string('region')->nullable();
            $table->string('address')->nullable();
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->string('email')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orphanages');
    }
};
