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
            $table->float('price')->nullable()->after('admin_id');
            $table->float('commission')->nullable()->after('price');
            $table->float('client_debit')->nullable()->after('commission');
            $table->float('admin_credit')->nullable()->after('client_debit');
            $table->float('host_credit')->nullable()->after('admin_credit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('commission');
            $table->dropColumn('client_debit');
            $table->dropColumn('admin_credit');
            $table->dropColumn('host_credit');
        });
    }
};
