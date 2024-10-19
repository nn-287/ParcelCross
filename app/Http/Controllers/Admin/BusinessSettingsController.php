<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\BusinessSetting;
use App\Model\Currency;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BusinessSettingsController extends Controller
{
    public function store_index()
    {
        if (BusinessSetting::where(['key' => 'minimum_order_value'])->first() == false) {
            DB::table('business_settings')->updateOrInsert(['key' => 'minimum_order_value'], [
                'value' => 1,
            ]);
        }

        return view('admin-views.business-settings.store-index');
    }
    
    public function app_version()
    {
        return view('admin-views.business-settings.app-version');
    }


    public function store_setup(Request $request)
    {

        if($request->input('store_opening_hours') != null){
            DB::table('business_settings')->updateOrInsert(
                    ['key' => 'store_opening_hours'],
                    ['value' => json_encode($request->input('store_opening_hours'))]
                );
        }else{
            $store_opening_hours = [];
            DB::table('business_settings')->updateOrInsert(
                    ['key' => 'store_opening_hours'],
                    ['value' => json_encode($store_opening_hours)]
                );
        }
        

        DB::table('business_settings')->updateOrInsert(['key' => 'store_open_time'], [
            'value' => $request['store_open_time'],
        ]);

        DB::table('business_settings')->updateOrInsert(['key' => 'store_close_time'], [
            'value' => $request['store_close_time'],
        ]);

        DB::table('business_settings')->updateOrInsert(['key' => 'store_closed'], [
            'value' => $request['store_closed'],
        ]);

        DB::table('business_settings')->updateOrInsert(['key' => 'store_name'], [
            'value' => $request['store_name'],
        ]);

        DB::table('business_settings')->updateOrInsert(['key' => 'currency'], [
            'value' => $request['currency'],
        ]);
        
        $curr_logo = BusinessSetting::where(['key' => 'logo'])->first();
        if (!empty($request->file('logo'))) {
            $image_name = Carbon::now()->toDateString() . "-" . uniqid() . "." . 'png';
            if (!Storage::disk('public')->exists('store')) {
                Storage::disk('public')->makeDirectory('store');
            }
            if (isset($curr_logo) && Storage::disk('public')->exists('store/' . $curr_logo['value'])) {
                Storage::disk('public')->delete('store/' . $curr_logo['value']);
            }
            $note_img = Image::make($request->file('logo'))->stream();
            Storage::disk('public')->put('store/' . $image_name, $note_img);
        } else {
            $image_name = $curr_logo['value'];
        }

        DB::table('business_settings')->updateOrInsert(['key' => 'logo'], [
            'value' => $image_name,
        ]);

        DB::table('business_settings')->updateOrInsert(['key' => 'delivery_charge'], [
            'value' => $request->delivery_charge,
        ]);

        DB::table('business_settings')->updateOrInsert(['key' => 'phone'], [
            'value' => $request['phone'],
        ]);

        DB::table('business_settings')->updateOrInsert(['key' => 'email_address'], [
            'value' => $request['email'],
        ]);

        DB::table('business_settings')->updateOrInsert(['key' => 'address'], [
            'value' => $request['address'],
        ]);

        DB::table('business_settings')->updateOrInsert(['key' => 'email_verification'], [
            'value' => $request['email_verification'],
        ]);
        
        DB::table('business_settings')->updateOrInsert(['key' => 'phone_otp'], [
            'value' => $request['phone_otp'],
        ]);

        DB::table('business_settings')->updateOrInsert(['key' => 'footer_text'], [
            'value' => $request['footer_text'],
        ]);

        DB::table('business_settings')->updateOrInsert(['key' => 'minimum_order_value'], [
            'value' => $request['minimum_order_value'],
        ]);

        DB::table('business_settings')->updateOrInsert(['key' => 'point_per_currency'], [
            'value' => $request['point_per_currency'],
        ]);

        DB::table('business_settings')->updateOrInsert(['key' => 'app_version'], [
            'value' => $request['app_version'],
        ]);  
       
       
        Toastr::success('Settings updated!');
        return back();
    }
}
    
