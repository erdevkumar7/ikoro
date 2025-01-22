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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('booking_id')->nullable()->references('id')->on('bookings')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->float('amount')->nullable();
            $table->string('payment_intent_id')->nullable();
            $table->string('status')->nullable()->comment('pending, done');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
