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
        Schema::create('token_messages', function (Blueprint $table) {
            $table->id();
            $table->string('msg_text');
            $table->foreignId('user_id')->nullable()->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade'); // Foreign key for user_id
            $table->foreignId('token_id')->nullable()->references('id')->on('tokens')
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
        Schema::dropIfExists('token_messages');
    }
};
