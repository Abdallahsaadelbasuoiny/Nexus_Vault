<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resale_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('device_passport_id')->constrained('device_passports')->onDelete('cascade');
            
            $table->decimal('asking_price', 10, 2);
            $table->text('seller_notes')->nullable();
            $table->enum('status', ['available', 'sold', 'cancelled'])->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resale_listings');
    }
};