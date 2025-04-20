<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;
use App\Models\PaymentMethod;
class PaymentController extends Controller
{
   // app/Http/Controllers/PaymentController.php

public function create($subdomain)
{
    // Find the user based on the subdomain
    $user = \App\Models\User::where('subdomain', $subdomain)->firstOrFail();

    $paymentMethods = \App\Models\PaymentMethod::all(['method_name', 'account_name', 'account_number']);

    return view('payment-form', compact('paymentMethods', 'user')); // Passing user info if needed
}

public function store(Request $request, $subdomain)
{
    // Validate the input
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'number' => 'required|string|max:20',
        'shipping_address' => 'required|string|max:255',
        'zip_code' => 'required|string|max:10',
        'barangay' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Find the user based on the subdomain
    $user = \App\Models\User::where('subdomain', $subdomain)->firstOrFail();

    // Create and save the payment details
    $payment = new \App\Models\Payment();
    $payment->user_id = $user->id; // Save the user_id based on the subdomain
    $payment->first_name = $request->first_name;
    $payment->last_name = $request->last_name;
    $payment->email = $request->email;
    $payment->number = $request->number;
    $payment->shipping_address = $request->shipping_address;
    $payment->zip_code = $request->zip_code;
    $payment->barangay = $request->barangay;

    // Handle image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('payment_image', 'public');
        $payment->image = str_replace('public/', '', $imagePath);
    }

    $payment->save();

    return redirect()->route('payment-thank-you-page')->with('success', 'Payment details saved successfully!');

}

// fetch function
public function myPayments()
{
    // Ensure user is authenticated
    $user = auth()->user();

    // Fetch all payments belonging to the logged-in user with pagination (e.g., 10 per page)
    $payments = Payment::where('user_id', $user->id)->paginate(5);

    return view('my-payments', compact('payments'));
}

// function to delete

 public function destroy($id)
    {
        $method = Payment::findOrFail($id);

        // Delete image from storage
        Storage::disk('public')->delete($method->image);

        // Delete from database
        $method->delete();

         // Redirect with success message
    return redirect()->route('my-payments')->with('success', 'Payment deleted successfully.');
}

}
