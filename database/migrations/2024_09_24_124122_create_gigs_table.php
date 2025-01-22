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
        if (!Schema::hasTable('equipment_price')) {
            Schema::create('equipment_price', function (Blueprint $table) {
                $table->id();
                $table->integer('equipment_id')->nullable();
                $table->string('equipment_name')->nullable();
                $table->string('price')->nullable();
                $table->string('minutes')->nullable();
                $table->timestamps();
            });
        }
        
        Schema::create('gigs', function (Blueprint $table) {
            $table->id();
            
            $table->string('title');
            $table->text('description');

            $table->foreignId('host_id')->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->string('type');

            $table->foreignId('country_id')->nullable()->references('id')->on('countries')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('state_id')->nullable()->references('id')->on('states')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('city_id')->nullable()->references('id')->on('cities')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('zip_id')->nullable()->references('id')->on('zipcodes')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('equipment_price_id')->nullable()->references('id')->on('equipment_price')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->string('equipment_name')->nullable()->comment('equipment name');
            $table->float('price')->nullable()->comment('price');
            $table->integer('minutes')->nullable()->comment('number of minutes');

            $table->string('status')->default("enabled")->comment('enabled, disabled');

            $table->timestamps();
        });

        Schema::create('gig_features', function (Blueprint $table) {
            $table->id();
            $table->integer('gig_id')->nullable();
            $table->string('label')->nullable();
            $table->string('value')->nullable();
            $table->timestamps();
        });

        Schema::create('gig_media', function (Blueprint $table) {
            $table->id();
            $table->integer('gig_id')->nullable();
            $table->integer('host_id')->nullable();
            $table->string('name')->nullable();
            $table->string('path')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_price');
        Schema::dropIfExists('gigs');
        Schema::dropIfExists('gig_features');
        Schema::dropIfExists('gig_media');
    }
};
