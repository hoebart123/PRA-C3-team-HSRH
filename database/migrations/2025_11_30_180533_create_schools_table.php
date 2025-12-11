<?php

// database/migrations/2025_01_01_000000_create_scholen_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('scholen', function (Blueprint $table) {
            $table->id();
            $table->string('naam');
            $table->string('contactpersoon')->nullable();
            $table->string('email')->nullable();
            $table->enum('status', ['pending', 'approved'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scholen');
    }
};
