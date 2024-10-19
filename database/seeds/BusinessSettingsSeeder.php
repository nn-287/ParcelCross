<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BusinessSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'store_open_time', 'value' => null],
            ['key' => 'store_close_time', 'value' => null],
            ['key' => 'logo', 'value' => '2024-03-28-66055791f1976.png'],
            ['key' => 'ssl_commerz_payment', 'value' => '{"status":"0","store_id":null,"store_password":null}'],
            ['key' => 'paypal', 'value' => '{"status":"1","paypal_client_id":"AWL4EQTS0ujjptm2...}'],
            ['key' => 'stripe', 'value' => '{"status":"0","api_key":null,"published_key":null}'],
            ['key' => 'cash_on_delivery', 'value' => '{"status":"1"}'],
            ['key' => 'digital_payment', 'value' => '{"status":"1"}'],
            ['key' => 'terms_and_conditions', 'value' => '<div class="ql-editor" data-gramm="false" contente...'],
            ['key' => 'fcm_topic', 'value' => null],
            ['key' => 'fcm_project_id', 'value' => '3f34f34'],
            ['key' => 'push_notification_key', 'value' => 'AAAA9ONWq3o:APA91bH7nMrGIgmo4I1GClkU4yJlKCOnibGYyx...'],
            ['key' => 'order_pending_message', 'value' => '{"status":1,"message":"Your order has been placed ...'],
            ['key' => 'order_processing_message', 'value' => '{"status":1,"message":"Your request is being prepa...'],
            ['key' => 'out_for_delivery_message', 'value' => '{"status":0,"message":"Order out for delivery."}'],
            ['key' => 'order_delivered_message', 'value' => '{"status":1,"message":"delivered"}'],
        ];

        DB::table('business_settings')->insert($settings);
    
    }
}
