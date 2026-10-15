<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            // Make user_id nullable for guest bookings
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained();
            $table->dateTime('appointment_date');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
