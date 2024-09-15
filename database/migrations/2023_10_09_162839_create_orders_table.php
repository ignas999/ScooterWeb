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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->foreignId('status_id')->constrained('statuses', 'status_id');
            $table->foreignId('transport_id')->constrained('transports', 'transport_id');
            $table->decimal('amount' , $total = 10 , $places = 2);
            $table->dateTime('start_date', $precision = 0 );
            $table->dateTime('end_date', $precision = 0 );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
