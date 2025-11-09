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

            // 🔑 Core identifiers
            $table->string('client_reg_id', 120)->nullable();
            $table->string('name', 120);
            $table->string('email');
            $table->string('phone', 30)->nullable();

            // 🎓 Reunion-specific info
            $table->string('batch')->nullable(); // e.g. "SSC – 1985, HSC – 1990"
            $table->string('location')->nullable();
            $table->string('profession')->nullable();
            $table->string('blood_group', 5)->nullable();
            $table->unsignedTinyInteger('guests_total')->default(0);
            $table->unsignedTinyInteger('guest_above_12')->nullable();

            $table->enum('eusCAA_contribution', ['yes', 'no'])->nullable()
                  ->comment('Whether the alumnus chose to make a contribution to EUSCAA');

            $table->enum('tshirt_size', ['S', 'M', 'L', 'XL', 'XXL', 'XXXL', '4XL'])->nullable();
            $table->unsignedInteger('donation_bdt')->nullable();

            // 💰 Payment-related fields
            $table->decimal('payable_amount', 10, 2)->default(0);
            $table->enum('payment_status', ['unpaid', 'paid'])->default('unpaid');
            $table->string('transaction_id', 100)->nullable();
            $table->string('payment_token', 64)->nullable()->unique();
            $table->timestamp('payment_expires_at')->nullable();

            // 📷 File upload
            $table->string('photo_path')->nullable();

            // 🕓 Timestamps
            $table->timestamps();

            // 🗑️ Soft Deletes
            $table->softDeletes(); // <-- এই লাইন যোগ করা হলো ✅
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
