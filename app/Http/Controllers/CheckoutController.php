<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Checkout;
use App\Models\PaymentMethod;


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

    // Fetch the cart data from the session (or database if applicable)
    $cartData = session('cart', []); // Default to an empty cart if nothing is found in the session

    // Fetch all payment methods
    $paymentMethods = PaymentMethod::all();

    // Pass user, cart data, and payment methods to the view
    return view('checkout', compact('user', 'cartData', 'paymentMethods'));
}

    public function store(Request $request, $subdomain)
    {
        // Fetch user by subdomain from the users table
        $user = User::where('subdomain', $subdomain)->first(); // Assuming the 'subdomain' column exists

        if (!$user) {
            abort(404, 'User not found for this subdomain.');
        }

        $userId = $user->id; // Get the user_id based on subdomain

        // Validate the incoming request
    $request->validate([
    'first_name' => 'required|string|max:255',
    'last_name' => 'required|string|max:255',
    'phone' => 'required|string|max:15',
    'city' => 'required|string|max:255',
    'state' => 'required|string|max:255',   // <-- change to 'state'
    'address' => 'required|string|max:255',
    'barangay' => 'required|string|max:255',
    'zip_code' => 'required|string|max:10',
    'payment_option' => 'required|string|max:255',
    'file_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
]);


        
        // Handle file upload (Proof of Payment)
        $filePath = null;
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $filePath = $file->store('proofpayment_image', 'public');
        }
    
        // Get cart data from the form (which is passed as JSON)
        $cartData = json_decode($request->input('cart_data'), true);
    
        // Compute grand total (items total + shipping fees)
        $grandTotal = array_reduce($cartData, function ($sum, $item) {
            return $sum + ($item['totalPrice'] ?? ($item['price'] * $item['quantity'])) + ($item['shippingFee'] ?? 0);
        }, 0);
    
        // Add grand total to cart data
        $cartData['grand_total'] = $grandTotal;
    
        // Save cart data and user input to the database
       $checkout = Checkout::create([
    'user_id' => $userId,
    'cart_data' => json_encode($cartData),
    'first_name' => $request->input('first_name'),
    'last_name' => $request->input('last_name'),
    'phone' => $request->input('phone'),
    'city' => $request->input('city'),           // NEW
     'state' => $request->input('state'),  // <-- not 'province'
    'address' => $request->input('address'),
    'barangay' => $request->input('barangay'),
    'zip_code' => $request->input('zip_code'),
    'payment_option' => $request->input('payment_option'),
    'proof_of_payment' => $filePath,
]);

    
        // Clear the cart from the session after the order is successfully stored
        session()->forget('cart'); // This clears the cart stored in the session
    
      return redirect()->route('thank-you', [
    'subdomain' => request()->route('subdomain'),
    'order' => $checkout->id,
]);
    }

    // Thank you page displaying the order summary
   public function thankYou($subdomain, $orderId)
{
    $checkout = Checkout::findOrFail($orderId);

    return view('thank-you', compact('checkout', 'subdomain'));
}


 
}