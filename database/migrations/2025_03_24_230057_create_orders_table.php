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
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('city');
            $table->string('phone');
            $table->string('text');
            $table->string('postal_code');
            $table->string('payment_method');
            $table->string('stripe_session_id');
            $table->boolean('paid')->default(false);
            $table->unsignedInteger('quantity');  
            $table->string('size'); 
            $table->string('shipping_method');
            $table->string('status')->default('pending');
            $table->decimal('total_amount', 10, 2);
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
