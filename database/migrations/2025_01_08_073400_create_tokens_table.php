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
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Title of the token
            $table->foreignId('user_id')->nullable()->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade'); // Foreign key for user_id
            $table->tinyInteger('status')->default(0)->comment('0 = Open, 1 = Close'); // Token status
            $table->tinyInteger('awaiting_reply')->default(1)->comment('1 = User Reply, 2 = Admin Reply'); // Awaiting reply status
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tokens');
    }
};
