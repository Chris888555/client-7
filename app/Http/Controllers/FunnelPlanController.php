<?php

namespace App\Http\Controllers;

use App\Models\FunnelPlan;
use Illuminate\Http\Request;

class FunnelPlanController extends Controller
{
    // Show the manage funnel plan page
    public function index()
    {
        // Fetch the current feature setting
        $featureSetting = FunnelPlan::first(); // Assuming only one setting exists

        // Fetch the funnel plans to display (You can modify this part to fit your needs)
        $funnelPlans = FunnelPlan::all();

        return view('manage-funnel-plan', compact('funnelPlans', 'featureSetting'));
    }

    // Toggle the funnel plan feature (Enable/Disable)
    // Toggle the funnel plan feature (Enable/Disable)
public function toggleFeature(Request $request)
{
    // Validate the setting value (ON/OFF)
    $validatedData = $request->validate([
        'setting_value' => 'required|in:ON,OFF',
    ]);

    // Update ALL records with the new setting value
    FunnelPlan::query()->update($validatedData);

    return redirect()->route('manage-funnel-plan')->with('success', 'Feature toggled successfully!');
}


    // Store the funnel plan data (months and price)
public function store(Request $request)
{
    // Validate input for the funnel plan
    $validatedData = $request->validate([
        'months' => 'required|integer|min:1|max:12',
        'price' => 'required|numeric',
    ]);

    // Create a new funnel plan (this ensures a new record is always created)
    FunnelPlan::create($validatedData);

    // Redirect back with success message
    return redirect()->route('manage-funnel-plan')->with('success', 'Funnel plan created successfully!');
}


// Update an existing funnel plan
public function update(Request $request, $id)
{
    // Validate the request input
    $request->validate([
        'months' => 'required|integer|min:1|max:12',
        'price' => 'required|numeric|min:0',
    ]);

    // Find the funnel plan by ID or fail
    $plan = FunnelPlan::findOrFail($id);

    // Update the plan details
    $plan->update([
        'months' => $request->months,
        'price' => $request->price,
    ]);

    // Redirect back with success message
    return redirect()->back()->with('success', 'Funnel plan updated successfully.');
}

    // Delete a funnel plan
    public function destroy($id)
    {
        $plan = FunnelPlan::findOrFail($id);
        $plan->delete();

        return redirect()->back()->with('success', 'Funnel plan deleted successfully.');
    }
}



