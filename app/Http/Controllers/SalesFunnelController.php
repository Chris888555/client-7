<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SalesFunnelController extends Controller
{
    public function showFunnel($subdomain)
    {
        // Siguraduhin na Eloquent Model ang query result
        $user = User::where('subdomain', $subdomain)->firstOrFail();

        return view('sales_funnel', compact('user'));
    }



    public function updateSubdomain(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subdomain' => 'required|string|unique:users,subdomain',
        ]);

        // Find the logged-in user and update their subdomain
        $user = User::findOrFail($request->user_id);
        $user->subdomain = $request->subdomain;
        $user->save();

        return back()->with('success', 'Subdomain updated successfully!');
    }
}
