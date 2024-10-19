<?php

use Illuminate\Database\Seeder;
use Database\Seeders\CurrenciesTableSeeder;
use Database\Seeders\BusinessSettingsSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  $this->call([
        //      AdminTableSeeder::class
        //  ]);
        //  $this->call([
        //     CurrenciesTableSeeder::class,
        // ]);
        $this->call([
            BusinessSettingsSeeder::class,
        ]);
    }
}
