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
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('traveler_id');
            $table->string('pickup_latitude')->nullable();
            $table->string('pickup_longitude')->nullable();
            $table->string('traveler_latitude')->nullable();
            $table->string('traveler_longitude')->nullable();
            $table->double('fees')->nullable();
            $table->double('commission_fees')->nullable();
            $table->double('customer_tips')->nullable();
            $table->enum('order_scope', ['local', 'global']);
            $table->timestamp('delivery_date')->nullable();
            $table->enum('order_status', ['pending', 'accepted', 'canceled', 'arrived', 'finished']);
            $table->tinyInteger('sender_verified')->default(0);
            $table->tinyInteger('receiver_verified')->default(0);
            $table->string('payment_method')->nullable();
            $table->enum('payment_status', ['paid', 'unpaid']);
            $table->timestamps();

            //foreign keys 
         
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('traveler_id')->references('id')->on('users')->onDelete('cascade');
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
