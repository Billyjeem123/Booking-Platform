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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('reference');
            $table->string('email');
            $table->string('location');
            $table->decimal('amount',10,2);
            $table->string('currency');
            $table->string('status');
            $table->string('car_type')->default('Bus Type');
            $table->string('seat_number')->nullable();
            $table->string('ticket_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
