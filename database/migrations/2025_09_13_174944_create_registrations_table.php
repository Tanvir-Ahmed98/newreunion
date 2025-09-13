<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('email')->index();
            $table->string('phone', 30)->nullable();
            $table->unsignedSmallInteger('ssc_batch')->nullable();
            $table->unsignedSmallInteger('hsc_batch')->nullable();
            $table->unsignedTinyInteger('guest_above_12')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('registrations');
    }
};
