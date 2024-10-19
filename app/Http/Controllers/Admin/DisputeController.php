<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Model\Dispute;
use App\Model\Order;
use App\User;


class DisputeController extends Controller
{
    public function list()
    {
        
        $disputes = Dispute::with(['complainer', 'defendant'])
        ->with(['order' => function ($query) {
            $query->with(['sender', 'traveler'])
                ->select(
                    'id',
                    'sender_id',
                    'recipient_info',
                    'traveler_id'
                );
        }])
        ->get();
        return view('admin-views.disputes.list', compact('disputes'));
    }


    function Addnew()
    {
        $orders = Order::all(); 
        return view('admin-views.disputes.add-new', compact('orders'));
    }



    public function Add(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'defendant_email' => 'required|email',
            'order_id' => 'required|exists:orders,id',
            'complainer_reason' => 'required',
            'defendant_reason' => 'required',
            'complaint_status' => 'required',
        ]);

        
        $user = User::where('email', $validatedData['email'])->where('user_type', 'sender')->firstOrFail();
        $defendant = User::where('email', $validatedData['defendant_email'])->where('user_type', 'traveler')->firstOrFail();

        $dispute = new Dispute();
        $dispute->order_id = $validatedData['order_id'];
        $dispute->complainer_user_id = $user->id;
        $dispute->defendant_user_id = $defendant->id;
        $dispute->complainer_reason = $validatedData['complainer_reason'];
        $dispute->defendant_reason = $validatedData['defendant_reason'];
        $dispute->complaint_status = $validatedData['complaint_status'];
        $dispute->save();

        Toastr::success('New dispute created successfully!');
        return redirect(route('admin.dispute.list'));
    }



    public function edit($id)
    {
        $dispute = Dispute::findOrFail($id);
        $orders = Order::all(); 
        return view('admin-views.disputes.edit', compact('dispute','orders'));
        
    }

    

    public function Modify(Request $request, $id)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'defendant_email' => 'required|email',
            'order_id' => 'required|exists:orders,id',
            'complainer_reason' => 'required',
            'defendant_reason' => 'required',
            'complaint_status' => 'required',
        ]);
    
        
        $dispute = Dispute::findOrFail($id);
        $user = User::where('email', $validatedData['email'])->where('user_type', 'sender')->firstOrFail();
        $defendant = User::where('email', $validatedData['defendant_email'])->where('user_type', 'traveler')->firstOrFail();
    
        $dispute->order_id = $validatedData['order_id'];
        $dispute->complainer_user_id = $user->id;
        $dispute->defendant_user_id = $defendant->id;
        $dispute->complainer_reason = $validatedData['complainer_reason'];
        $dispute->defendant_reason = $validatedData['defendant_reason'];
        $dispute->complaint_status = $validatedData['complaint_status'];
        $dispute->save();
    
        Toastr::success('Dispute updated successfully!');
        return redirect(route('admin.dispute.list'));
    }



    public function delete(Request $request)
    {
        $dispute = Dispute::find($request->id);
        $dispute->delete();
        Toastr::success('Dispute deleted successfully!');
        return back();
    }
}
