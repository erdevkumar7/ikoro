<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('gigs', function (Blueprint $table) {
            // Drop existing foreign key
            $table->dropForeign(['equipment_price_id']);

            // Add new foreign key referencing equipment_prices table
            $table->foreign('equipment_price_id')
                ->references('id')->on('equipment_prices')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('gigs', function (Blueprint $table) {
            // Rollback: Drop new foreign key and restore old reference
            $table->dropForeign(['equipment_price_id']);

            // Restore foreign key referencing equipment_price table
            $table->foreign('equipment_price_id')
                ->references('id')->on('equipment_price')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }
};
