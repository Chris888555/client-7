<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mop\PaymentMethod;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{
    // Show form to create
    public function create()
    {
        return view('user.payment_methods.create');
    }

    // Store payment method
    public function store(Request $request)
    {
        $request->validate([
            'method_name' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
        ]);

        PaymentMethod::create([
            'user_id' => Auth::id(), // associate method to logged-in user
            'method_name' => $request->method_name,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
        ]);

        return response()->json(['message' => 'Payment method added successfully.']);
    }

    // Show all methods of current user
    public function showtable()
    {
        $methods = PaymentMethod::where('user_id', Auth::id())->get();
        return view('user.payment_methods.update', compact('methods'));
    }

    // Update method
    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:payment_methods,id',
            'method_name' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
        ]);

        $payment = PaymentMethod::where('user_id', Auth::id())->findOrFail($request->id);
        $payment->update($validated);

        return response()->json(['success' => 'Payment method updated successfully.']);
    }

    // Delete methods
    public function delete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:payment_methods,id',
        ]);

        PaymentMethod::where('user_id', Auth::id())->whereIn('id', $request->ids)->delete();

        return response()->json(['success' => 'Selected methods deleted successfully.']);
    }
}
