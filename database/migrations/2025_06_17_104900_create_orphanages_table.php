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
        Schema::create('orphanages', function (Blueprint $table) {
            $table->id();
            $table->string('Orphanage_id')->unique(); // identifiant interne (autre que id)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('name');
            $table->decimal('longitude', 10, 7)->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->string('country');
            $table->string('city');
            $table->string('region')->nullable();
            $table->string('address')->nullable();
            $table->string('logo')->nullable();
            $table->string('num_enregistrement')->nullable();
            $table->text('description')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
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
