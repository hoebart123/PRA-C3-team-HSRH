<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('schoolnaam');
            $table->string('contactpersoon');
            $table->string('email');
            $table->text('opmerking')->nullable();
            $table->json('teams')->nullable();

            // Nieuwe velden voor scheidsrechter
            $table->string('referee_name');
            $table->string('referee_email');

            $table->boolean('approved')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
