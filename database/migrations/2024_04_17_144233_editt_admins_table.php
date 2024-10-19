<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       
       $admins = DB::table('admins')->get();
       foreach ($admins as $admin) 
       {
           $hashedPassword = Hash::make($admin->password);
           DB::table('admins')
               ->where('id', $admin->id)
               ->update(['password' => $hashedPassword]);
       }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin', function (Blueprint $table) {
            //
        });
    }
};
