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
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['equipment_id']);
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->foreign('equipment_id')
                  ->references('id')
                  ->on('equipments')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['equipment_id']);
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->foreign('equipment_id')
                  ->references('id')
                  ->on('equipment_price')
                  ->onDelete('cascade');
        });
    }
};
