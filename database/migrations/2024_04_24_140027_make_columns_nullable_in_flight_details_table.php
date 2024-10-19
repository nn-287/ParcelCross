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
        Schema::table('flight_details', function (Blueprint $table) {
            $table->string('departure_country')->nullable()->change();
            $table->string('departure_city')->nullable()->change();
            $table->string('destination_country')->nullable()->change();
            $table->string('destination_city')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flight_details', function (Blueprint $table) {
            //
        });
    }
};
