<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Funnel\FunnelLead;
use App\Models\Funnel\FunnelView;
use Carbon\Carbon;

class UserDashboardController extends Controller
{
    public function viewDashboard()
    {
        $recentLeads = FunnelLead::with('funnel')
            ->where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();

        // Defaults = current year & month
        $year = request()->get('year', now()->year);
        $month = request()->get('month', now()->month);

        // Group funnel views by day of month
        $viewsData = FunnelView::where('user_id', Auth::id())
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->selectRaw('DAY(created_at) as day, COUNT(*) as total')
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('total', 'day');

        // Fill missing days (for smooth chart)
        $daysInMonth = range(1, Carbon::create($year, $month)->daysInMonth);
        $viewsCounts = [];
        foreach ($daysInMonth as $day) {
            $viewsCounts[] = $viewsData[$day] ?? 0;
        }

        // ✅ Totals
        $totalViewsAllTime = FunnelView::where('user_id', Auth::id())->count();
        $totalViewsThisMonth = FunnelView::where('user_id', Auth::id())
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();

        return view('user.home.dashboard', compact(
            'recentLeads',
            'viewsCounts',
            'year',
            'month',
            'totalViewsAllTime',
            'totalViewsThisMonth'
        ));
    }
}
