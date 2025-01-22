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
        Schema::create('hosts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp_no')->nullable();
            $table->string('available_hours')->nullable();
            $table->string('skype_id')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 = pending, 1 = approved, 2 = block');
            $table->timestamp('enrolement_datetime')->useCurrent();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('country_id')->nullable()->references('id')->on('countries')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('state_id')->nullable()->references('id')->on('states')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('city_id')->nullable()->references('id')->on('cities')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('zip_id')->nullable()->references('id')->on('zipcodes')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hosts');
    }
};
