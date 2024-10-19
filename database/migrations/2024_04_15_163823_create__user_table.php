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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('f_name');
            $table->string('l_name');
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('cm_firebase_token')->nullable();
            $table->rememberToken();
            $table->text('image')->nullable();
            $table->integer('luggage_space')->nullable();
            $table->enum('user_type', ['sender', 'traveler']);
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('identity_number')->nullable();
            $table->string('identity_image')->nullable();
            $table->string('premium_membership_id')->nullable();
            $table->timestamps();

        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('User');
    }
};
