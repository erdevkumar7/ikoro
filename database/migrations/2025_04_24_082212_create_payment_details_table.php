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
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('gig_id');
            $table->string('payment_intent_id')->nullable(); // from Stripe
            $table->string('payment_method')->nullable();     // card, etc.
            $table->decimal('amount', 10, 2);
            $table->integer('duration');                      // in minutes
            $table->string('status')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('gig_id')->references('id')->on('gigs')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_details');
    }
};
