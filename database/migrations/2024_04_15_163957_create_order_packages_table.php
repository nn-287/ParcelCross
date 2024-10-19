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
        Schema::create('order_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('size')->nullable();
            $table->float('weight')->nullable();
            $table->integer('quantity')->default(1);
            $table->string('is_fragile')->nullable();
            $table->timestamps();


            //foreign keys 
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_packages');
    }
};
