<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Funnel\FunnelLead;

class UserDashboardController extends Controller
{
    public function viewDashboard()
    {
        $recentLeads = FunnelLead::with('funnel')
            ->where('user_id', Auth::id())
            ->latest()
            ->take(5) // recent 5 leads
            ->get();

        return view('user.home.dashboard', compact('recentLeads'));
    }
}
