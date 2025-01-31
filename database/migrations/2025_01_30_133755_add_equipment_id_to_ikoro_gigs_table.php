<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('gigs', function (Blueprint $table) {
            $table->unsignedBigInteger('equipment_id')->nullable()->after('equipment_price_id'); // Add column
            $table->foreign('equipment_id')->references('id')->on('equipments')->onUpdate('cascade')->onDelete('cascade'); // Create foreign key
        });
    }

    public function down()
    {
        Schema::table('gigs', function (Blueprint $table) {
            $table->dropForeign(['equipment_id']); // Drop foreign key first
            $table->dropColumn('equipment_id'); // Drop column
        });
    }
};
