<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function orderShow(Request $request)
    {
        $view = $request->query('view', 'all');
        $search = $request->query('search', '');

        $userId = Auth::id(); // Get the logged-in user's ID

        // Base query filtered by user_id
        $query = Checkout::where('user_id', $userId);

        if ($view === 'pending') {
            $query->where('status', 0);
        } elseif ($view === 'shipped') {
            $query->where('status', 1);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                  ->orWhere('last_name', 'like', '%' . $search . '%');
            });
        }

        // Count filtered by user_id
        $pendingCount = Checkout::where('user_id', $userId)->where('status', 0)->count();
        $shippedCount = Checkout::where('user_id', $userId)->where('status', 1)->count();

        // Paginate and pass filters
        $checkouts = $query->paginate(5)->appends(['view' => $view, 'search' => $search]);

        return view('order-details', compact('checkouts', 'view', 'pendingCount', 'shippedCount', 'search'));
    }

    // ✅ Update Order Status (0 = Pending, 1 = Shipped)
    public function updateStatus(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'status' => 'required|in:0,1', // Ensure the status is either 0 (Pending) or 1 (Shipped)
        ]);

        // Find the order
        $checkout = Checkout::findOrFail($id);

        // Optional: check if the current user owns this order before updating
        if ($checkout->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Update the status
        $checkout->status = $request->status;
        $checkout->save();

        // Redirect back with success message
        return back()->with('success', 'Order status updated successfully.');
    }


 public function destroy($id)
{
    $checkout = Checkout::findOrFail($id);

    if ($checkout->proof_of_payment) {
        Storage::disk('public')->delete($checkout->proof_of_payment);
    }

    $checkout->delete();

    return back()->with('success', 'Order deleted successfully.');
}


}
