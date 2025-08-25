<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Order;
use App\Models\Admin\Package;
use App\Models\Mop\PaymentMethod;
use App\Models\User\Users; 
use App\Models\Funnel\UserFunnel;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

  // Display all orders (personal details only)
public function index()
{
    $orders = Order::where('user_id', Auth::id())
                   ->latest()
                   ->paginate(10); // paginate instead of get

    return view('user.orders.index', compact('orders'));
}




public function store(Request $request, $username)
{
    $request->validate([
        'package_id' => 'required|exists:packages,id',
        'payment_method_id' => 'required|exists:payment_methods,id',
        'full_name' => 'required|string|max:255',
        'mobile' => 'required|string|max:20',
        'address' => 'required|string',
        'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = Users::where('username', $username)->firstOrFail();
    $package = Package::findOrFail($request->package_id);
    $mop = PaymentMethod::where('id', $request->payment_method_id)
        ->where('user_id', $user->id)
        ->firstOrFail();

    $proofPath = $request->file('payment_proof')->store('proofs', 'public');

    Order::create([
        'user_id' => $user->id,
        'package_id' => $package->id,
        'package_name' => $package->name,
        'package_price' => $package->price,
        'payment_method_id' => $mop->id,
        'payment_method_name' => $mop->method_name,
        'payment_account_name' => $mop->account_name,
        'payment_account_number' => $mop->account_number,
        'full_name' => $request->full_name,
        'mobile' => $request->mobile,
        'address' => $request->address,
        'payment_proof' => $proofPath,
    ]);

    return response()->json(['success' => 'Your order has been placed successfully!']);
}



public function thankYou($username)
{
    $user = Users::where('username', $username)->first();

    if (!$user) {
        abort(404, 'User not found');
    }

    $funnel = UserFunnel::where('user_id', $user->id)->first();

    if (!$funnel) {
        abort(404, 'Funnel not found');
    }

    // Kunin ang latest order ng user
    $order = Order::where('user_id', $user->id)->latest()->first();

    // Buttons mula sa funnel
    $buttons = [
        'messenger_btn' => $funnel->messenger_btn,
        'referral_btn'  => $funnel->referral_btn,
        'shop_btn'      => $funnel->shop_btn,
    ];

    return view('checkout.thank-you', compact('funnel', 'buttons', 'order', 'user'));
}

}
