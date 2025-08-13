<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('donations');
    }

    public function down(): void
    {
        // Note: We won't recreate the old table structure in the down method
        // as we're intentionally replacing it
    }
};