<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Review;
use App\User;
use App\Model\Order;
class ReviewController extends Controller
{
    public function submitReview(Request $request)
    {
        try 
        {
            $request->validate([
                'order_id' => 'required|exists:orders,id',
                'reviewed_user_id' => 'required|exists:users,id',
                'rating' => 'required|integer|between:1,5',
                'comment' => 'nullable|string',
                'user_id' => 'required|exists:users,id',
            ]);



            $order = Order::findOrFail($request->input('order_id'));
            if (!$order) 
            {
                return response()->json(['error' => 'Order not found'], 400);
            }

             
            $reviewedUser = User::findOrFail($request->input('reviewed_user_id'));
            if ($reviewedUser->user_type !== 'traveler') 
            {
                return response()->json(['error' => 'You can review travelers users only!'], 400);
            }
    
            
            $review = new Review();
            // $review->reviewer_user_id = $request->user()->id; 
            $review->order_id = $request->input('order_id');
            $review->reviewer_user_id = $request->input('user_id');
            $review->reviewed_user_id = $request->input('reviewed_user_id');
            $review->rating = $request->input('rating');
            $review->comment = $request->input('comment');
            $review->save();
    
           
            return response()->json(['message' => 'Review submitted successfully'], 201);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => 'Failed to submit review', 'message' => $e->getMessage()], 500);
        }
    }
}
