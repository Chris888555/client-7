<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\FunnelView;
use App\Models\User\VideoProgress;

class UserPageController extends Controller
{
    public function dashboard(Request $request)
    {
        $username = auth()->user()->username;

        // Latest full list (for chart + showing latest item)
        $funnelViews = FunnelView::where('username', $username)->latest()->get();
        $videoProgress = VideoProgress::where('username', $username)->latest()->get();

        // Paginated data for modal
        $funnelViewsPaginated = FunnelView::where('username', $username)
            ->latest()
            ->paginate(2, ['*'], 'funnel_page'); // 10 per page, custom param for modal tracking

        $videoProgressPaginated = VideoProgress::where('username', $username)
            ->latest()
            ->paginate(1, ['*'], 'video_page'); // 10 per page, custom param for modal tracking

        // Chart data: prepare 1-31 day slots
        $pageViews = array_fill(1, 31, 0);
        $videoViews = array_fill(1, 31, 0);

        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Funnel views count per day
        $funnelCounts = FunnelView::selectRaw('DAY(created_at) as day, COUNT(*) as count')
            ->where('username', $username)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->groupBy('day')
            ->pluck('count', 'day');

        foreach ($funnelCounts as $day => $count) {
            $pageViews[(int)$day] = $count;
        }

        // Video views count per day
        $videoCounts = VideoProgress::selectRaw('DAY(created_at) as day, COUNT(*) as count')
            ->where('username', $username)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->groupBy('day')
            ->pluck('count', 'day');

        foreach ($videoCounts as $day => $count) {
            $videoViews[(int)$day] = $count;
        }

        return view('user.dashboard', [
            'funnelViews' => $funnelViews,
            'videoProgress' => $videoProgress,
            'funnelViewsPaginated' => $funnelViewsPaginated,
            'videoProgressPaginated' => $videoProgressPaginated,
            'pageViews' => $pageViews,
            'videoViews' => $videoViews,
            'totalPageViews' => array_sum($pageViews),
            'totalVideoViews' => array_sum($videoViews),
        ]);
    }
}
