<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('appointments', 'cancellation_reason')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->string('cancellation_reason')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('appointments', 'cancellation_reason')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->dropColumn('cancellation_reason');
            });
        }
    }
};