<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('device_passports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->unsignedBigInteger('order_id')->nullable(); // بدون constraint لتجنب خطأ جدول الطلبات إذا لم يأنشأ بعد
            
            $table->string('serial_number')->unique();
            $table->date('purchase_date');
            $table->date('warranty_expires_at');
            $table->enum('status', ['active', 'in_repair', 'resold', 'expired'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('device_passports');
    }
};