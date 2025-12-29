<?php

// database/migrations/2025_01_01_000001_create_teams_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();

            $table->foreignId('school_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('naam');
            $table->string('toernooi');
            $table->unsignedInteger('aantal');

            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
