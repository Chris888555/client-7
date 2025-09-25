<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Order;
use App\Models\Admin\Package;
use App\Models\Mop\PaymentMethod;
use App\Models\Funnel\UserFunnel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    // Display all orders (personal details only)
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->latest()
                       ->paginate(10);

        return view('user.orders.index', compact('orders'));
    }

    // Store checkout order
    public function store(Request $request, $page_link)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'full_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'address' => 'required|string',
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // find funnel by page_link
        $funnel = UserFunnel::where('page_link', $page_link)->firstOrFail();
        $user   = $funnel->user;

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

     return response()->json([
        'success' => 'Your order has been placed successfully!',
        'redirect_url' => route('checkout.thank-you', $page_link),
    ]);
}

    // Thank you page
    public function thankYou($page_link)
    {
        $funnel = UserFunnel::where('page_link', $page_link)->firstOrFail();
        $user   = $funnel->user;

        $order = Order::where('user_id', $user->id)->latest()->first();

        $buttons = [
            'messenger_btn' => $funnel->messenger_btn,
            'referral_btn'  => $funnel->referral_btn,
            'shop_btn'      => $funnel->shop_btn,
        ];

        return view('checkout.thank-you', compact('funnel', 'buttons', 'order', 'user'));
    }



    // Bulk Delete
        public function bulkDelete(Request $request)
        {
            $ids = $request->ids ?? [];
            if (empty($ids)) {
                return response()->json(['success' => false, 'message' => 'No orders selected.']);
            }

            $orders = Order::where('user_id', Auth::id())
                        ->whereIn('id', $ids)
                        ->get();

            foreach ($orders as $order) {
                if ($order->payment_proof) {
                    Storage::disk('public')->delete($order->payment_proof); // delete file sa storage
                }
                $order->delete();
            }

            return response()->json(['success' => true, 'message' => 'Selected orders deleted successfully.']);
        }

}
