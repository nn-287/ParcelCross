<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FlightDetail;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;


class FlightDetailController extends Controller
{
    public function index()
    {
        try 
        {
            $flightDetails = FlightDetail::paginate(10);
            return response()->json($flightDetails);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => 'Failed to fetch flight details.'], 500);
        }
    }



    public function store(Request $request)
    {
        try 
        {
        
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'departure_country' => 'required',
                'departure_city' => 'required',
                'destination_country' => 'required',
                'destination_city' => 'required',
                'departure_time' => 'required',
                'arrival_time' => 'nullable',
            ]);

            $flightDetail = FlightDetail::create([
                'user_id' => $request->input('user_id'),
                'departure_country' =>$request->input('departure_country'),
                'departure_city' => $request->input('departure_city'),
                'destination_country' =>$request->input('destination_country'),
                'destination_city' => $request->input('destination_city'),
                'departure_time' => $request->input('departure_time'),
                'arrival_time' => $request->input('arrival_time'),
            ]);

        
            return response()->json($flightDetail, 201);
        } 
        catch (ValidationException $validationException) 
        {
            return response()->json(['error' => $validationException->errors()], 422);
        } 
        catch (\Exception $e) 
        {
            Log::error('Failed to create flight detail: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create flight detail.', 'message' => $e->getMessage()], 500);
        }
    }


    

    public function show($id)
    {
        $flightDetail = FlightDetail::findOrFail($id);
        return response()->json($flightDetail);
    }



    public function updatedetails(Request $request, $id)
    {

        // Log::info('Request data: ' . json_encode($request->all()));
    
        $validator = Validator::make($request->all(), [
            'departure_country' => 'required',
            'departure_city' => 'required',
            'destination_country' => 'required',
            'destination_city' => 'required',
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'user_id' => 'required',
        ]);

    
        if ($validator->fails()) 
        {
            return response()->json(['errors' => $validator->errors()], 400);
        }

    
        $flightDetailData = [
            'departure_country' =>$request->input('departure_country'),
            'departure_city' => $request->input('departure_city'),
            'destination_country' =>$request->input('destination_country'),
            'destination_city' => $request->input('destination_city'),
            'departure_time' => $request->input('departure_time'),
            'arrival_time' => $request->input('arrival_time'),
            'user_id' => $request->input('user_id'),
        ];

        try 
        {
        
            $flightDetail = FlightDetail::findOrFail($id);
            $flightDetail->update($flightDetailData);

            return response()->json(['message' => 'Successfully updated!'], 200);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => 'Failed to update flight detail.', 'message' => $e->getMessage()], 500);
        }
    }





    public function remove($id)
    {
        try 
        {
            $flightDetail = FlightDetail::findOrFail($id);
            $flightDetail->delete();
    
            return response()->json(['message' => 'Flight detail deleted successfully.'], 200);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => 'Failed to remove flight detail.', 'message' => $e->getMessage()], 500);
        }
    }



}
