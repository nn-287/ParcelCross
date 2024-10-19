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
            
            $table->string('departure_country')->after('departure_location');
            $table->string('departure_city')->after('departure_country');
            $table->string('destination_country')->after('destination_location');
            $table->string('destination_city')->after('destination_country');
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
