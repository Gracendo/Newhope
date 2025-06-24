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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->longText('donation_content')->nullable();
            $table->string('amount');
            $table->string('raised')->nullable();
            $table->string('status')->nullable();
            $table->string('image')->nullable();
            $table->string('image_gallery')->nullable();
            $table->text('slug')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_tags')->nullable();
            $table->text('meta_description')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('categories_id')->nullable();
            $table->string('created_by')->nullable();
            $table->longText('faq')->nullable();
            $table->string('deadline')->nullable();
            $table->string('featured')->nullable();
            $table->string('og_meta_title')->nullable();
            $table->string('og_meta_description')->nullable();
            $table->string('og_meta_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
