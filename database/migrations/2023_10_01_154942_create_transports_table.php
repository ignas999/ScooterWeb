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
        Schema::create('transports', function (Blueprint $table) {
            $table->id('transport_id');
            $table->foreign('status_id')->references('status_id')->on('statuses');
            $table->foreign('location_id')->references('location_id')->on('locations');
            $table->foreign('category_id')->references('category_id')->on('categories');
            $table->string('name');
            $table->text('description');
            $table->string('rated_power');
            $table->string('max_speed');
            $table->string('battery');
            $table->integer('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transports');
    }
};
