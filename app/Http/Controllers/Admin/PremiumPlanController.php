<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\PremiumPlan;
use Brian2694\Toastr\Facades\Toastr;

class PremiumPlanController extends Controller
{
    public function list()
    {
        $plans = PremiumPlan::paginate(10);
        return view('admin-views.premium-plans.list', compact('plans'));
    }

    

    public function add_new()
    {
        return view('admin-views.premium-plans.add-new');
    }



    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|string|max:255',
        ]);

        PremiumPlan::create($validatedData);
        Toastr::success('New plan is added successfully!');
        return redirect()->route('admin.premium-plans.list');    
    }


    public function edit($id)
    {
        $plan = PremiumPlan::findOrFail($id);
        return view('admin-views.premium-plans.edit', compact('plan'));
        
    }



    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|string|max:255',
        ]);

        $plan = PremiumPlan::find($id);
        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->amount = $request->amount;
        $plan->save();
        return redirect()->route('admin.premium-plans.list'); 

        
    }
}
