<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Checkout;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    // Display the checkout page
    public function view($subdomain)
    {
        // Fetch user by subdomain from the users table
        $user = User::where('subdomain', $subdomain)->first();

        if (!$user) {
            abort(404, 'User not found for this subdomain.');
        }

          // Fetch regions from the PSGC API
    $regions = Http::get('https://psgc.gitlab.io/api/regions.json')->json();


        // Fetch the cart data from the session (or database if applicable)
        $cartData = session('cart', []); // Default to an empty cart if nothing is found in the session

        // Fetch all payment methods
        $paymentMethods = PaymentMethod::all();

        // Pass user, cart data, payment methods, and regions to the view
        return view('checkout', compact('user', 'cartData', 'paymentMethods', 'regions')); // Add 'regions' here
    }

    public function store(Request $request, $subdomain)
{
    // Fetch user by subdomain from the users table
    $user = User::where('subdomain', $subdomain)->first();

    if (!$user) {
        abort(404, 'User not found for this subdomain.');
    }

    // Fetch regions
    $regions = Http::get('https://psgc.gitlab.io/api/regions.json')->json();

    // Fetch provinces based on the selected region (if available)
    $provinces = [];
if ($request->input('region')) {
    $regionCode = $request->input('region');
    if ($regionCode === '13') {
        // NCR has districts instead of provinces
        $provinces = Http::get("https://psgc.gitlab.io/api/regions/{$regionCode}/districts.json")->json();
    } else {
        $provinces = Http::get("https://psgc.gitlab.io/api/regions/{$regionCode}/provinces.json")->json();
    }
}


    // Fetch cities (same logic for cities can be used later)
   $cities = [];
if ($request->input('state')) {
    $stateCode = $request->input('state');
    
    if ($request->input('region') === '13') {
        // NCR - get cities from district
        $cities = Http::get("https://psgc.gitlab.io/api/districts/{$stateCode}/cities-municipalities.json")->json();
    } else {
        $cities = Http::get("https://psgc.gitlab.io/api/provinces/{$stateCode}/cities-municipalities.json")->json();
    }
}


    // Fetch barangays based on the selected city (if available)
$barangays = [];
if ($request->input('city')) {
    $cityCode = $request->input('city');
    $barangays = Http::get("https://psgc.gitlab.io/api/cities-municipalities/{$cityCode}/barangays.json")->json();
}

    // Validate the incoming request
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'region' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'barangay' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'zip_code' => 'required|string|max:10',
        'payment_option' => 'required|string|max:255',
        'file_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'cart_data' => 'required|json',
    ]);

    // Handle file upload (Proof of Payment)
    $filePath = null;
    if ($request->hasFile('file_upload')) {
        $file = $request->file('file_upload');
        $filePath = $file->store('proofpayment_image', 'public');
    }

    // Get cart data from the form (which is passed as JSON)
    $cartData = json_decode($request->input('cart_data'), true);

// Get selected region, state (district if NCR), and city names
$selectedRegion = collect($regions)->firstWhere('code', $request->input('region'));

// For NCR, treat state as district and city accordingly
if ($request->input('region') === '13') {
    // For NCR, state is a district, not a province
    $selectedState = collect($provinces)->firstWhere('code', $request->input('state')); // District for NCR
    $selectedCity = collect($cities)->firstWhere('code', $request->input('city'));
} else {
    // For other regions, treat state as province
    $selectedState = collect($provinces)->firstWhere('code', $request->input('state'));
    $selectedCity = collect($cities)->firstWhere('code', $request->input('city'));
}

$selectedBarangay = collect($barangays)->firstWhere('code', $request->input('barangay'));

// Save cart data and user input to the database
$checkout = Checkout::create([
    'user_id' => $user->id,
    'cart_data' => json_encode($cartData),
    'first_name' => $request->input('first_name'),
    'last_name' => $request->input('last_name'),
    'phone' => $request->input('phone'),
    'region' => $selectedRegion['name'] ?? null,  
    'state' => $selectedState['name'] ?? null,  // This will now be a district if NCR is selected
    'city' => $selectedCity['name'] ?? null,
    'barangay' => $selectedBarangay['name'] ?? null, 
    'address' => $request->input('address'),
    'zip_code' => $request->input('zip_code'),
    'payment_option' => $request->input('payment_option'),
    'proof_of_payment' => $filePath,
]);



    // Clear the cart from the session after the order is successfully stored
    session()->forget('cart');

    return redirect()->route('thank-you', [
        'subdomain' => request()->route('subdomain'),
        'order' => $checkout->id,
    ]);
}


    public function thankYou($subdomain, $orderId)
{
    // Fetch the checkout data
    $checkout = Checkout::findOrFail($orderId);

    // Fetch the user by subdomain
    $user = User::where('subdomain', $subdomain)->first();

    if (!$user) {
        abort(404, 'User not found for this subdomain.');
    }

    // Return the 'thank-you' view, passing the checkout, subdomain, and user variables
    return view('thank-you', compact('checkout', 'subdomain', 'user'));
}

}
