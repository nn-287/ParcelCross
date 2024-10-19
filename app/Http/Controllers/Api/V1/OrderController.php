<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Model\Order;
use App\Model\OrderPackage;
use App\Model\OrderPackageImage;
use App\Model\FlightDetail;

class OrderController extends Controller
{
    public function store(Request $request)
    {

        $senderexists = User::where('id', $request->input('sender_id'))->exists();
        if (!$senderexists) 
        {
            return response()->json(['error' => 'Sender is not a registered user. Please create an account first!.'], 400);
        }

        try 
        {
            $validator = Validator::make($request->all(), [
                // Order details
                'sender_id' => 'required|exists:users,id',
                'traveler_id' => 'required',
                'recipient_info' => 'required|string',
                'pickup_latitude' => 'nullable',
                'pickup_longitude' => 'nullable',
                'traveler_latitude' => 'nullable',
                'traveler_longitude' => 'nullable',
                'fees' => 'nullable',
                'commission_fees' => 'nullable',
                'customer_tips' => 'required',
                'order_scope' => 'required|in:local,global',
                'delivery_date' => 'nullable|date',
                'origin_country' => 'required|string',
                'origin_city' => 'required|string',
                'destination_country' => 'required|string',
                'destination_city' => 'required|string',
                'order_status' => 'required|in:pending,accepted,canceled,arrived', 
                'sender_verified' => 'required|boolean',
                'receiver_verified' => 'required|boolean',
                'payment_method' => 'required|string',
                'payment_status' => 'required|in:paid,unpaid',
            
                // Package-details info
                'package_title' => 'required|string',
                'package_description' => 'nullable|string',
                'package_size' => 'required|string',
                'package_weight' => 'required|numeric',
                'package_quantity' => 'required|integer',
                'is_fragile' => 'required|string',
            
                // Image of order-package-images
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) 
            {
                throw new ValidationException($validator);
            }

            $order = Order::create($validator->validated());


            $orderPackage = OrderPackage::create([
                'order_id' => $order->id,
                'title' => $request->input('package_title'),
                'description' => $request->input('package_description'),
                'size' => $request->input('package_size'),
                'weight' => $request->input('package_weight'),
                'quantity' => $request->input('package_quantity'),
                'is_fragile' => $request->input('is_fragile'),
            ]);


            if ($request->hasFile('image')) 
            {
                foreach ($request->file('image') as $image) 
                {
                    $directoryPath = 'public/order_images';
                    if (!Storage::exists($directoryPath)) 
                    {
                        Storage::makeDirectory($directoryPath);
                    }
                    $imagePath = $image->store($directoryPath);
            
                    OrderPackageImage::create([
                        'order_id' => $order->id,
                        'package_id' => $orderPackage->id,
                        'user_id' => auth()->user()->id, 
                        'image' => $imagePath,
                    ]);
                }
            }
            
            return response()->json(['message' => 'Order created successfully'], 201);
        } 
        catch (ValidationException $e) 
        {
            return response()->json(['errors' => $e->errors()], 422);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => 'Failed to create order', 'message' => $e->getMessage()], 500);
        }
    }





    public function show($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order);
    }



    public function getUserOrders($id, Request $request)
    {
        try 
        {
            $query = Order::where('sender_id', $id);

            if ($request->has('order_status')) 
            {
                $status = $request->input('order_status');
                $query->where('order_status', $status);
            }

            $orders = $query->paginate(10);
            return response()->json(['orders' => $orders]);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => 'Failed to retrieve user orders', 'message' => $e->getMessage()], 500);
        }
    }



    

    public function AssignandAcceptOrder($orderId, $travelerId) 
    {
        try 
        {
            $order = Order::findOrFail($orderId);
            $traveler = User::findOrFail($travelerId);
            $traveler = User::where('id', $travelerId)->where('user_type', 'traveler')->first();

           

            if (!$order) 
            {
                return response()->json(['error' => 'Order not found'], 404);
            }


            if (!$traveler) 
            {
                return response()->json(['error' => 'The specified user is not a traveler'], 404);
            }


            if ($order->order_status !== 'pending') 
            {
                return response()->json(['error' => 'Order cannot be assigned at this time'], 400);
            }
           

            $flightDetails = $traveler->flightDetail()->latest()->first();
            if (!$flightDetails) 
            {
                $flightDetails = $traveler->flightDetail()->create([
                    'departure_country' => $order->origin_country,
                    'departure_city' => $order->origin_city,
                    'destination_country' => $order->destination_country,
                    'destination_city' => $order->destination_city,
                ]);
            }
            else if($flightDetails->departure_country !== $order->origin_country ||  $flightDetails->destination_country !== $order->destination_country) 
            {
                return response()->json(['error' => 'Traveler is not available in the specified area'], 400);
            }
           

           
            $order->update([
                'traveler_id' => $travelerId,
                'order_status' => 'accepted'
            ]);
    
            return response()->json(['message' => 'Order assigned to traveler successfully'], 200);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => 'Failed to assign and accept order', 'message' => $e->getMessage()], 500);
        }
    }




    public function acceptOrRejectOrder($orderId, $status) 
    {
        try 
        {
            $order = Order::findOrFail($orderId);
           

            if (!$order) 
            {
                return response()->json(['error' => 'Order not found'], 404);
            }

        
            if ($order->order_status !== 'pending') 
            {
                return response()->json(['error' => 'Order cannot be accepted or rejected at this time'], 400);
            }

           
            if ($status === 'accept') 
            {
                $order->update(['order_status' => 'accepted']);
                return response()->json(['message' => 'Order accepted successfully'], 200);
            } 
            elseif ($status === 'reject') 
            {
                $order->update(['order_status' => 'canceled']);
                return response()->json(['message' => 'Order rejected successfully'], 200);
            } 
            else 
            {
                return response()->json(['error' => 'Invalid status parameter'], 400);
            }
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => 'Failed to update order status', 'message' => $e->getMessage()], 500);
        }
    }





    public function getTripInfo($orderId) 
    {
        try 
        {
            
            $order = Order::findOrFail($orderId);
           
            if (!$order->traveler_id) 
            {
                return response()->json(['error' => 'No traveler assigned to this order'], 404);
            }

            $flightDetails = $order->traveler->flightDetail;

            if (!$flightDetails) 
            {
                return response()->json(['error' => 'Flight details not found for the assigned traveler'], 404);
            }

            return response()->json(['trip_info' => $flightDetails]);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => 'Failed to retrieve trip information', 'message' => $e->getMessage()], 500);
        }
    }



    public function OrderHistory()
    {
        try 
        {
            $orders = Order::whereIn('order_status', ['finished', 'canceled'])->get();
            return response()->json(['order history' => $orders]);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => 'Failed to retrieve order history', 'message' => $e->getMessage()], 500);
        }
    }



    public function getOngoingTrips($userId)
    {
        try 
        {
           
            $flightDetails = FlightDetail::where('user_id', $userId)->where('flight_status', 'ongoing')->get();
            $order = Order::where('traveler_id', $userId)->first();
            
            return response()->json([
                'ongoing_trips' => $flightDetails,
                'orders' => $order
            ]);
        } 
        catch (\Exception $e) 
        {
            return response()->json([
                'error' => 'Failed to retrieve ongoing trips',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    




}
