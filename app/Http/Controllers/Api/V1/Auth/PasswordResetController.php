<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\CentralLogics\Helpers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Model\PasswordReset;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PasswordResetController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    // use ResetsPasswords;

    // /**
    //  * Where to redirect users after resetting their password.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = RouteServiceProvider::HOME;



    public function reset_password_request(Request $request)
    {
        try 
        {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);

            if ($validator->fails()) 
            {
                return response()->json(['errors' => Helpers::error_processor($validator)], 403);
            }

            $customer = User::where('email', $request->email)->first();//email is returned back!

            if (!$customer) 
            {
                return response()->json(['errors' => [
                    ['code' => 'not-found', 'message' => 'Email not found!']
                ]], 404);
            }


            $count = DB::table('password_resets')//checks within the last hour
                        ->where('email', $customer->email)
                        ->where('created_at', '>=', \Carbon\Carbon::now()->subHour())
                        ->count();

            if ($count > 20) //reset attempts within the last hour exceeds 20
            {
                return response()->json(['errors' => [
                    ['code' => 'invalid', 'message' => 'You made a lot of requests! Try again later.']
                ]], 400);
            }

            $count = DB::table('password_resets')//checks within the current day 
                        ->where('email', $customer->email)
                        ->where('created_at', '>=', Carbon::today())
                        ->count();

            if ($count > 5) //reset attempts within the current day exceeds 5 
            {
                return response()->json(['errors' => [
                    ['code' => 'invalid', 'message' => 'You made a lot of requests! Try again later.']
                ]], 400);
            }

            $token = rand(1000, 9999);//reset attempt limits are not exceeded then a new token is generated
            DB::table('password_resets')->insert([
                'email' => $customer->email,
                'token' => $token,
                'created_at' => now(),
            ]);

            Mail::to($customer->email)->send(new \App\Mail\PasswordResetMail($token));

            return response()->json(['message' => 'Email sent successfully.'], 200);
            // return response()->json([
            //     'customer' => $customer,
            //     'message' => 'Email sent successfully.'
            // ], 200);
        } 
        catch (\Exception $e) 
        {
            return response()->json([
                'errors' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }



    public function verify_token(Request $request)
    {
        try 
        {
            $data = DB::table('password_resets')->where(['token' => $request['reset_token'],'email'=>$request['email']])->first();
            // return response()->json(['data' => $data], 200);

            if (isset($data)) {
                return response()->json(['message'=>"Token found, you can proceed"], 200);
            } else {
                return response()->json(['errors' => [
                    ['code' => 'invalid', 'message' => 'Invalid token.']
                ]], 400);
            }
        } 
        catch (\Exception $e) 
        {
            return response()->json([
                'errors' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }



    public function reset_password_submit(Request $request)
    {
        try 
        {
            
            $data = DB::table('password_resets')->where(['token' => $request['reset_token']])->first();
            // return response()->json(['data' => $data], 200);


            if ($data !== null) 
            {
                if ($request['password'] == $request['confirm_password']) {
                    DB::table('users')->where('email', $data->email)->update([
                        'password' => bcrypt($request['confirm_password'])
                    ]);
                    DB::table('password_resets')->where('token', $request['reset_token'])->delete();
                    return response()->json(['message' => 'Password changed successfully.'], 200);
                } else {
                    return response()->json(['errors' => [
                        ['code' => 'mismatch', 'message' => 'Password did not match!']
                    ]], 401);
                }
            } 
            else 
            {
                return response()->json(['errors' => [
                    ['code' => 'invalid', 'message' => 'Invalid token.']
                ]], 400);
            }
        }
    
        catch (\Exception $e) 
        {
            return response()->json([
                'errors' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }



}
