<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('naam');       // Voetbal 3/4, Lijnbal VO, etc.
            $table->string('sport');      // Voetbal / Lijnbal
            $table->string('doelgroep');  // groep 3/4, groep 5/6, etc.
            $table->integer('speeltijd'); // minuten per wedstrijd
            $table->integer('pauzetijd');  // rusttijd
            $table->integer('max_spelers'); // max spelers per team
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
