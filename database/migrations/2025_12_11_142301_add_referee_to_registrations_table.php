<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            if (!Schema::hasColumn('registrations', 'referee_name')) {
                $table->string('referee_name')->after('opmerking');
            }

            if (!Schema::hasColumn('registrations', 'referee_email')) {
                $table->string('referee_email')->after('referee_name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            if (Schema::hasColumn('registrations', 'referee_name')) {
                $table->dropColumn('referee_name');
            }
            if (Schema::hasColumn('registrations', 'referee_email')) {
                $table->dropColumn('referee_email');
            }
        });
    }
};
