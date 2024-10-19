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
        Schema::create('disputes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('complainer_user_id')->nullable();
            $table->string('defendant_user_id')->nullable();
            $table->text('complainer_reason')->nullable();
            $table->text('defendant_reason')->nullable();
            $table->string('complaint_status')->default('pending');
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
        Schema::dropIfExists('disputes');
    }
};
