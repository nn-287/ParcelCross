<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{

    public function show($id)
    {
        $userinfo = User::findOrFail($id);
        return response()->json($userinfo);
    }




    public function updatedetails(Request $request, $id)
    {
        try 
        {
            $request->validate([
                'f_name' => 'required',
                'l_name' => 'required',
                'phone' => 'required',
                'email' => 'required|email|unique:users,email',
                'provider_name' => 'nullable',
                'provider_id' => 'nullable',
                'is_phone_verified' => 'nullable',
                'password' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'luggage_space' => 'nullable',
                'user_type' => 'nullable',
                'longitude' => 'nullable',
                'latitude' => 'nullable',
                'identity_number' => 'nullable',
                'identity_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
                'premium_membership_id' => 'nullable',
            ]);

            $userdata = [
                'f_name' => $request->input('f_name'),
                'l_name' => $request->input('l_name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'provider_name' => $request->input('provider_name'),
                'provider_id' => $request->input('provider_id'),
                'is_phone_verified' => $request->input('is_phone_verified'),
                'password' => Hash::make($request->input('password')), 
                'luggage_space' => $request->input('luggage_space'),
                'user_type' => $request->input('user_type'),
                'longitude' => $request->input('longitude'),
                'latitude' => $request->input('latitude'),
                'identity_number' => $request->input('identity_number'),
                'premium_membership_id' => $request->input('premium_membership_id'),
            ];


        
            if ($request->hasFile('image')) 
            {
                $directoryPath = 'public/user_images';
                if (!Storage::exists($directoryPath)) 
                {
                    Storage::makeDirectory($directoryPath);
                }
                $imagePath = $request->file('image')->store($directoryPath);
                $userdata['image'] = $imagePath;
            }
            
        
            if ($request->hasFile('identity_image')) 
            {
                $directoryPath = 'public/identity_images';
                if (!Storage::exists($directoryPath)) 
                {
                    Storage::makeDirectory($directoryPath);
                }
                $identityImagePath = $request->file('identity_image')->store($directoryPath);
                $userdata['identity_image'] = $identityImagePath;
            }

        
            $user = User::findOrFail($id);
            $user->update($request->all());

            return response()->json(['message' => 'User details updated successfully!'], 200);
        } 
        catch (ValidationException $validationException) 
        {
            return response()->json(['error' => $validationException->errors()], 422);
        } 
        catch (\Exception $e) 
        {
            Log::error('Failed to update user details: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update user details.', 'message' => $e->getMessage()], 500);
        }
    }


}
