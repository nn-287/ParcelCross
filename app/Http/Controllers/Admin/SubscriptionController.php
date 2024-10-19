<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Model\PremiumSubscription;
use App\Model\PremiumPlan;
use App\User;
class SubscriptionController extends Controller
{
    public function list()
    {
        $subscriptions = PremiumSubscription::with('plan', 'user')->get();
        return view('admin-views.subscriptions.list', compact('subscriptions'));
    }


    function Addnew()
    {
        $users = User::all(); 
        $plans = PremiumPlan::all(); 
        return view('admin-views.subscriptions.add-new', compact('users', 'plans'));
    }


    public function Add(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'plan_id' => 'required|exists:premium_plans,id',
        ]);

        $user = User::firstOrCreate(['email' => $validatedData['email']]);
        $plan = PremiumSubscription::findOrFail($validatedData['plan_id']);

        $subscription = new PremiumSubscription();
        $subscription->user_id = $user->id;
        $subscription->plan_id = $plan->id;
        $subscription->amount = $plan->amount;
        $subscription->save();

        Toastr::success('New subscription created successfully!');
        return redirect(route('admin.subscription.list'));
    }



    public function edit($id)
    {
        $subscription = PremiumSubscription::findOrFail($id);
        $plans = PremiumPlan::all(); 
        return view('admin-views.subscriptions.edit', compact('subscription','plans'));
        
    }

    

    public function Modify(Request $request, $id)
    {
        $subscription = PremiumSubscription::findOrFail($id);

        $validatedData = $request->validate([
            'email' => 'required|email',
            'plan_id' => 'required|exists:premium_plans,id',
        ]);

        $user = User::firstOrCreate(['email' => $validatedData['email']]);
       
        $subscription->user_id = $user->id;
        $subscription->plan_id = $validatedData['plan_id'];
        $subscription->save();

        Toastr::success('Subscription updated successfully!');
        return redirect(route('admin.subscription.list'));
    }



    public function delete(Request $request)
    {
        $subscription = PremiumSubscription::find($request->id);
        $subscription->delete();
        Toastr::success('Subscription removed successfully!');
        return back();
    }




}
