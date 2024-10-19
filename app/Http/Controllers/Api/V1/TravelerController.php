<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\FlightDetail;

class TravelerController extends Controller
{
    public function getTravelers(Request $request)
    {
        try 
        {
            $country = $request->query('country');
            $city = $request->query('city');


            if (!$country || !$city) 
            {
                return response()->json(['error' => 'Both country and city query parameters are required'], 400);
            }

            
            $flightDetails = FlightDetail::where([['departure_country', $country],['departure_city', $city],])->orWhere([['destination_country', $country],['destination_city', $city],])->get();
            if ($flightDetails->isEmpty()) 
            {
                return response()->json(['message' => 'No travelers found for the specified country and city'], 404);
            }


           
            $travelerIds = $flightDetails->pluck('user_id')->unique()->toArray();
            $travelers = User::whereIn('id', $travelerIds)->get();


            return response()->json(['travelers' => $travelers]);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => 'Failed to retrieve travelers', 'message' => $e->getMessage()], 500);
        }
    }




    public function show($id)
    {
        $traveler = User::findOrFail($id);
        return response()->json($traveler);
    }
}
