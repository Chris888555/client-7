<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\FunnelPageView;
use App\Http\Controllers\UserFunnelController;
use Illuminate\Support\Facades\DB;


class PageViewController extends Controller
{
 
    public function track($subdomain, Request $request)
    {
       
        // 1. Get page owner
        $user = User::where('subdomain', $subdomain)->first();

        if (!$user) {
            abort(404, 'Page not found.');
        }

        // 2. Get or create user_cookie
        $user_cookie = $request->cookie('user_cookie');
        if (!$user_cookie) {
            // Generate a shorter random string with a 'user-' prefix
            $user_cookie = 'user-' . Str::random(6); // 6-character random string
            Cookie::queue('user_cookie', $user_cookie, 60 * 24 * 365); // 1 year
        }

        // 3. Check if already viewed
        $alreadyTracked = FunnelPageView::where('user_id', $user->id)
            ->where('user_cookie', $user_cookie)
            ->exists();

        if (!$alreadyTracked) {
            FunnelPageView::create([
                'user_id' => $user->id,
                'user_cookie' => $user_cookie,
            ]);
        }

        // 4. Show funnel
        return app(UserFunnelController::class)->showFunnel($subdomain, $request);
    }


  
public function pageViewAnalytics(Request $request)
{
    $userId = Auth::id();

    // If the year and month are provided, use them; otherwise, use the current date
    $year = $request->input('year', now()->year);
    $month = $request->input('month', now()->month);

    // Get the page views count for each day of the given month and year
    $pageViews = DB::table('funnel_page_views')
        ->select(DB::raw('DAY(created_at) as day'), DB::raw('count(*) as view_count'))
        ->where('user_id', $userId)
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->groupBy(DB::raw('DAY(created_at)'))
        ->orderBy(DB::raw('DAY(created_at)'))
        ->get();

    // Create labels for each day (Date 1 to Date 31)
    $labels = collect(range(1, 31))->map(function ($day) {
        return 'Date ' . $day;
    });

    // Map the page view data to each day
    $data = $labels->map(function ($day) use ($pageViews) {
        return $pageViews->firstWhere('day', (int) str_replace('Date ', '', $day))->view_count ?? 0;
    });

    // Calculate total views
    $totalViews = $data->sum();

    // Return view with chart data and total
    return view('page-view', compact('labels', 'data', 'totalViews', 'year', 'month'));
}




}

