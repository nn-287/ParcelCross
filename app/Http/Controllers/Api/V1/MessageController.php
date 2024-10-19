<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Message;

class MessageController extends Controller
{
    public function getUserMessages($userId)
    {
        try 
        {
           
            $userMessages = Message::where('user_id', $userId)->whereNotNull('support_id') ->orderBy('created_at', 'desc')->get();
            return response()->json($userMessages);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => 'Failed to retrieve user messages', 'message' => $e->getMessage()], 500);
        }
    }




    public function sendMessageToSupport(Request $request)
    {
        
        $rules = [
            'message' => 'required|string',
            'type' => 'nullable|string',
            'order_id'=>'required',
            'user_id'=>'required',
            'image' => 'nullable|image|max:2048',
        ];

  
        $validatedData = $request->validate($rules);

        try 
        {
           
            $message = new Message($validatedData);
            $message->save();

            return response()->json(['message' => 'Message sent to customer support', 'data' => $message], 201);
        } 
        catch (\Exception $e) 
        {
            
            return response()->json(['error' => 'Failed to send message to customer support', 'message' => $e->getMessage()], 500);
        }
    }
}
