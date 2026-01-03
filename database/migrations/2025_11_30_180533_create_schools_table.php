<?php

// database/migrations/2025_01_01_000000_create_scholen_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();

            $table->string('naam');
            $table->string('contactpersoon');
            $table->string('email');

            // Scheidsrechter
            $table->string('referee_name');
            $table->string('referee_email');

            $table->enum('status', ['pending', 'approved'])->default('pending');

            $table->boolean('is_archived')->default(false);

            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
