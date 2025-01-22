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
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('fixed_price_amount');
            $table->dropColumn('hourly_price_amount');
            $table->dropColumn('currency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->decimal('fixed_price_amount', 8, 2)->after('title');
            $table->decimal('hourly_price_amount', 8, 2)->after('fixed_price_amount');
            $table->string('currency')->after('hourly_price_amount');
        });
    }
};
