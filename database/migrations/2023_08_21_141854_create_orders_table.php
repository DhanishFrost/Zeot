<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('address_id')->nullable()->constrained('user_addresses')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'processing', 'completed', 'declined'])->nullable();
            $table->enum('payment_method', ['cash_on_delivery', 'card'])->nullable();
            $table->enum('payment_status', ['pending', 'completed', 'declined'])->nullable();
            $table->timestamps();
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
