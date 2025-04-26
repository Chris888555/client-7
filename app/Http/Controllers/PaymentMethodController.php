<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    // Show the payment method upload form
    public function create()
    {
    $paymentMethods = PaymentMethod::all();
    return view('upload-payment-method', compact('paymentMethods'));
}



    // Store the uploaded payment method details
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'method_name' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
        ]);

        // Store payment method in the database
        PaymentMethod::create([
            'method_name' => $request->method_name,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
        ]);

        // Redirect with success message
        return redirect()->route('payment-method.create')->with('success', 'Payment method added successfully.');
    }

// function to delete
    public function destroy($id)
{
    $method = PaymentMethod::findOrFail($id);
    $method->delete();

    return redirect()->route('payment-method.create')->with('success', 'Payment method deleted successfully.');
}


// function to update
public function edit($id)
{
    $method = PaymentMethod::findOrFail($id);
    return view('edit-payment-method', compact('method'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'method_name' => 'required|string|max:255',
        'account_name' => 'required|string|max:255',
        'account_number' => 'required|string|max:255',
    ]);

    $method = PaymentMethod::findOrFail($id);
    $method->update([
        'method_name' => $request->method_name,
        'account_name' => $request->account_name,
        'account_number' => $request->account_number,
    ]);

    return redirect()->route('payment-method.create')->with('success', 'Payment method updated successfully.');
}
    
}
