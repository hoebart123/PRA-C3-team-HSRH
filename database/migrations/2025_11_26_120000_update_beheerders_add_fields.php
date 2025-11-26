<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('beheerders', function (Blueprint $table) {
            if (!Schema::hasColumn('beheerders', 'password')) {
                $table->string('password')->nullable()->after('email');
            }
            if (!Schema::hasColumn('beheerders', 'is_active')) {
                $table->boolean('is_active')->default(false)->after('password');
            }
            if (!Schema::hasColumn('beheerders', 'is_super')) {
                $table->boolean('is_super')->default(false)->after('is_active');
            }
        });
    }

    public function down(): void
    {
        Schema::table('beheerders', function (Blueprint $table) {
            $table->dropColumn(['password', 'is_active', 'is_super']);
        });
    }
};