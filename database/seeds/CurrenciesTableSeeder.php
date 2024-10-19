<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['country' => 'US Dollar', 'currency_code' => 'USD', 'currency_symbol' => '$', 'exchange_rate' => 1.00],
            ['country' => 'Canadian Dollar', 'currency_code' => 'CAD', 'currency_symbol' => 'CA$', 'exchange_rate' => 1.00],
            ['country' => 'Euro', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'exchange_rate' => 1.00],
            ['country' => 'United Arab Emirates Dirham', 'currency_code' => 'AED', 'currency_symbol' => 'د.إ.‏', 'exchange_rate' => 1.00],
            ['country' => 'Afghan Afghani', 'currency_code' => 'AFN', 'currency_symbol' => '؋', 'exchange_rate' => 1.00],
            ['country' => 'Albanian Lek', 'currency_code' => 'ALL', 'currency_symbol' => 'L', 'exchange_rate' => 1.00],
            ['country' => 'Armenian Dram', 'currency_code' => 'AMD', 'currency_symbol' => '֏', 'exchange_rate' => 1.00],
            ['country' => 'Argentine Peso', 'currency_code' => 'ARS', 'currency_symbol' => '$', 'exchange_rate' => 1.00],
            ['country' => 'Australian Dollar', 'currency_code' => 'AUD', 'currency_symbol' => '$', 'exchange_rate' => 1.00],
            ['country' => 'Azerbaijani Manat', 'currency_code' => 'AZN', 'currency_symbol' => '₼', 'exchange_rate' => 1.00],
            ['country' => 'Bosnia-Herzegovina Convertible Mark', 'currency_code' => 'BAM', 'currency_symbol' => 'KM', 'exchange_rate' => 1.00],
            ['country' => 'Bangladeshi Taka', 'currency_code' => 'BDT', 'currency_symbol' => '৳', 'exchange_rate' => 1.00],
            ['country' => 'Bulgarian Lev', 'currency_code' => 'BGN', 'currency_symbol' => 'лв.', 'exchange_rate' => 1.00],
            ['country' => 'Bahraini Dinar', 'currency_code' => 'BHD', 'currency_symbol' => 'د.ب.‏', 'exchange_rate' => 1.00],
            ['country' => 'Burundian Franc', 'currency_code' => 'BIF', 'currency_symbol' => 'FBu', 'exchange_rate' => 1.00],
            ['country' => 'Brunei Dollar', 'currency_code' => 'BND', 'currency_symbol' => 'B$', 'exchange_rate' => 1.00],
            ['country' => 'Bolivian Boliviano', 'currency_code' => 'BOB', 'currency_symbol' => 'Bs', 'exchange_rate' => 1.00],
            ['country' => 'Brazilian Real', 'currency_code' => 'BRL', 'currency_symbol' => 'R$', 'exchange_rate' => 1.00],
            ['country' => 'Botswanan Pula', 'currency_code' => 'BWP', 'currency_symbol' => 'P', 'exchange_rate' => 1.00],
            ['country' => 'Belarusian Ruble', 'currency_code' => 'BYN', 'currency_symbol' => 'Br', 'exchange_rate' => 1.00],
            ['country' => 'Belize Dollar', 'currency_code' => 'BZD', 'currency_symbol' => '$', 'exchange_rate' => 1.00],
            ['country' => 'Congolese Franc', 'currency_code' => 'CDF', 'currency_symbol' => 'FC', 'exchange_rate' => 1.00],
            ['country' => 'Swiss Franc', 'currency_code' => 'CHF', 'currency_symbol' => 'CHf', 'exchange_rate' => 1.00],
            ['country' => 'Chilean Peso', 'currency_code' => 'CLP', 'currency_symbol' => '$', 'exchange_rate' => 1.00],
            ['country' => 'Chinese Yuan', 'currency_code' => 'CNY', 'currency_symbol' => '¥', 'exchange_rate' => 1.00],
        ];

        DB::table('currencies')->insert($currencies);
    
    }
}
