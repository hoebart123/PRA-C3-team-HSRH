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
            $table->string('referee_name')->nullable();
            $table->string('referee_email')->nullable();
            $table->json('teams')->nullable();
            $table->integer('status')->default(0); // 0 = pending, 1 = approved, 2 = rejected
            $table->boolean('is_archived')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
