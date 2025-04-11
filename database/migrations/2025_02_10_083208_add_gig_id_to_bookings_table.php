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
            $table->unsignedBigInteger('gig_id')->after('task_id')->nullable(); // Add gig_id column
            $table->foreign('gig_id')->references('id')->on('gigs')->onDelete('cascade'); // Set foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['gig_id']); // Drop foreign key first
            $table->dropColumn('gig_id'); // Remove the column
        });
    }
};
