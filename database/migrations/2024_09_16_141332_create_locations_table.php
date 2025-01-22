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
        if (!Schema::hasTable('countries')) {
            Schema::create('countries', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->string('code')->nullable();
                $table->string('status')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('states')) {
            Schema::create('states', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('country_id');
                $table->string('name');
                $table->string('code')->nullable();
                $table->string('status')->nullable();
                $table->timestamps();

                $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade');
            });
        }
        
        if (!Schema::hasTable('cities')) {
            Schema::create('cities', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('country_id');
                $table->unsignedBigInteger('state_id');
                $table->string('name');
                $table->string('code')->nullable();
                $table->string('status')->nullable();
                $table->timestamps();

                $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade');

                $table->foreign('state_id')
                ->references('id')
                ->on('states')
                ->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('zipcodes')) {
            Schema::create('zipcodes', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('country_id');
                $table->unsignedBigInteger('state_id');
                $table->unsignedBigInteger('city_id');
                $table->string('code');
                $table->string('status')->nullable();
                $table->timestamps();

                $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade');

                $table->foreign('state_id')
                ->references('id')
                ->on('states')
                ->onDelete('cascade');

                $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
        Schema::dropIfExists('states');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('zipcodes');
    }
};
