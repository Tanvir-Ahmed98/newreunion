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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('email')->unique();
            $table->string('phone', 30)->nullable();

            // Reunion-specific fields
            $table->string('batch')->nullable(); // e.g. "SSC – 1985, HSC – 1990"
            $table->string('location')->nullable();
            $table->string('profession')->nullable();

            // Guest counts
            $table->unsignedTinyInteger('guests_total')->default(0); // 0..5 (5 means 5+)
            $table->unsignedTinyInteger('guest_above_12')->default(0);

            // Other info
            $table->enum('tshirt_size', ['S','M','L','XL','XXL'])->nullable();
            $table->unsignedInteger('donation_bdt')->nullable();

            // File upload
            $table->string('photo_path')->nullable();

            // Legacy (optional, keep if you want backward compatibility)
            $table->unsignedSmallInteger('ssc_batch')->nullable();
            $table->unsignedSmallInteger('hsc_batch')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
