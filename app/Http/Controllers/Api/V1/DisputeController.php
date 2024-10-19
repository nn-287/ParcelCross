<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\Dispute;

class DisputeController extends Controller
{
    public function submitComplaint(Request $request)
    {
        try 
        {
           
            $request->validate([
                'order_id' => 'required|exists:orders,id',
                'complainer_user_id' => 'required|exists:users,id',
                'complainer_reason' => 'required|string',
                'defendant_reason' => 'nullable|string',
            ]);

           
            $existingDispute = Dispute::where('order_id', $request->input('order_id'))->where('complainer_user_id', $request->input('complainer_user_id'))->first();

            if ($existingDispute) 
            {
                return response()->json(['error' => 'You have already submitted a complaint for this order'], 400);
            }

          
            $dispute = new Dispute();
            $dispute->order_id = $request->input('order_id');
            $dispute->complainer_user_id = $request->input('complainer_user_id');
            $dispute->defendant_user_id = Order::findOrFail($request->input('order_id'))->traveler_id;
            $dispute->complainer_reason = $request->input('complainer_reason');
            $dispute->defendant_reason = $request->input('defendant_reason');
            $dispute->complaint_status = 'pending'; 
            $dispute->save();


            return response()->json(['message' => 'Complaint submitted successfully'], 201);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => 'Failed to submit complaint', 'message' => $e->getMessage()], 500);
        }
    }




    public function submitResponse(Request $request,$userId)
    {
        try 
        {
            $request->validate([
                'dispute_id' => 'required|exists:disputes,id',
                'defendant_reason' => 'required|string',
            ]);

           
            $dispute = Dispute::findOrFail($request->input('dispute_id'));
            if ($userId != $dispute->defendant_user_id) 
            {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

         
            $dispute->defendant_reason = $request->input('defendant_reason');
            $dispute->save();

            return response()->json(['message' => 'Response submitted successfully'], 200);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => 'Failed to submit response', 'message' => $e->getMessage()], 500);
        }
    }
    
}