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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->nullable()->references('id')->on('tasks')
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

            $table->string('preferred_gender')->nullable();
            $table->string('operation_time')->nullable();
            $table->foreignId('client_id')->nullable()->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('host_id')->nullable()->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('admin_id')->nullable()->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade')
            ->comment('managed by admin id');

            $table->string('skype_id')->nullable();
            $table->string('whatsapp_no')->nullable();
            $table->text('briefing')->nullable();

            $table->string('client_status')->default("pending")->comment('pending, done');
            $table->string('host_status')->default("pending")->comment('pending, done');
            $table->string('status')->default("new_order")->comment('new_order, pending, completed');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
