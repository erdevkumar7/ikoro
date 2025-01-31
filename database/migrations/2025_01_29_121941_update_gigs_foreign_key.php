<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('gigs', function (Blueprint $table) {
            // Drop the old foreign key first
            $table->dropForeign(['equipment_price_id']);

            // Add the new foreign key referencing `equipment_prices`
            $table->foreign('equipment_price_id')
                ->references('equipment_price_id') // Primary key in `equipment_prices`
                ->on('equipment_prices')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('gigs', function (Blueprint $table) {
            // Rollback to the old setup if needed
            $table->dropForeign(['equipment_price_id']);
            $table->foreign('equipment_price_id')
                ->references('id')
                ->on('equipment_price')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }
};
