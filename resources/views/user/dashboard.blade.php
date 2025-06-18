@extends('layouts.users')

@section('title', 'Dashboard')

@section('content')
<div class="container m-auto p-4 sm:p-8 max-w-full">

    {{-- FUNNEL VIEWS SECTION --}}
    <div class="mb-16">
        <h2 class="text-xl font-semibold text-blue-500 mb-4">Funnel Views</h2>
        @if($funnelViews->isEmpty())
        <p class="text-gray-400 italic">No funnel views found.</p>
        @else
        <div class="flex flex-col md:flex-row gap-4">
            {{-- Cards: 1/3 width --}}
            <div class="w-full md:w-1/3 border rounded-lg bg-white">
                <div class="grid grid-cols-1 gap-4 p-4">
                    @php $view = $funnelViews->sortByDesc('created_at')->first(); @endphp
                    <div class="rounded-none p-6 min-h-[200px]">
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-globe-asia text-blue-500 mr-2"></i> IP Address:
                        </p>
                        <p class="text-base text-gray-700">{{ $view->ip_address }}</p>

                        <p class="text-sm text-gray-500 mt-3">
                            <i class="fas fa-calendar-alt text-green-500 mr-2"></i> Viewed At:
                        </p>
                        <p class="text-base text-gray-700">{{ $view->created_at->format('M d, Y h:i A') }}</p>
                    </div>

                    <a href="?funnel_page=1" class="mt-4 text-blue-600 hover:underline text-sm">
                        View More
                    </a>
                </div>

                @if(request()->has('funnel_page'))
                <div class="mt-6 space-y-4 px-4 pb-4">
                    <h3 class="text-md font-semibold text-blue-500">All Funnel Views</h3>
                    @foreach ($funnelViewsPaginated as $view)
                    <div class="border p-4 rounded bg-white">
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-globe-asia text-blue-500 mr-2"></i> IP Address:
                            <span class="text-gray-700">{{ $view->ip_address }}</span>
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            <i class="fas fa-calendar-alt text-green-500 mr-2"></i> Viewed At:
                            <span class="text-gray-700">{{ $view->created_at->format('M d, Y h:i A') }}</span>
                        </p>
                    </div>
                    @endforeach

                    <div class="mt-4">
                        {{ $funnelViewsPaginated->withQueryString()->links() }}
                    </div>

                    {{-- Close button --}}
                    <div>
                        <a href="{{ route('user.dashboard') }}" class="text-sm text-red-600 hover:underline">Close</a>
                    </div>
                </div>
                @endif
            </div>

            {{-- Chart: 2/3 width --}}
            <div class="w-full md:w-2/3 p-4 bg-white border rounded-lg">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center text-blue-500 text-nd font-semibold">
                        <i class="fas fa-chart-line mr-2"></i>
                        <span>Funnel View Chart</span>
                    </div>

                    <div class="flex items-center text-gray-700 text-sm">
                        <i class="fas fa-users text-blue-500 mr-2"></i>
                        <span class="font-medium">Page Views:</span>
                        <span class="ml-1 font-bold">{{ $totalPageViews }}</span>
                    </div>
                </div>

                <canvas id="funnelViewsChart" height="100"></canvas>
            </div>
        </div>
        @endif
    </div>

    {{-- VIDEO ENGAGEMENT SECTION --}}
    <div class="mb-16">
        <h2 class="text-xl font-semibold text-green-500 mb-4">Video Engagement</h2>
        @if($videoProgress->isEmpty())
        <p class="text-gray-400 italic">No video progress data available.</p>
        @else
        <div class="flex flex-col md:flex-row gap-4">
            <div class="w-full md:w-1/3 border rounded-lg bg-white">
                <div class="grid grid-cols-1 gap-4 p-4">
                    @php $progress = $videoProgress->sortByDesc('created_at')->first(); @endphp
                    <div class="bg-white rounded-none p-6 min-h-[200px]">
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-play-circle text-purple-500 mr-2"></i> Current Progress:
                        </p>
                        <div class="w-full bg-gray-100 rounded-full h-2.5 mb-1">
                            <div class="bg-green-500 h-2.5 rounded-full"
                                style="width: {{ $progress->progress * 100 }}%"></div>
                        </div>
                        <p class="text-xs text-gray-600">{{ number_format($progress->progress * 100, 2) }}%</p>

                        <p class="text-sm text-gray-500 mt-3">
                            <i class="fas fa-chart-line text-indigo-500 mr-2"></i> Max Watched:
                        </p>
                        <div class="w-full bg-gray-100 rounded-full h-2.5 mb-1">
                            <div class="bg-indigo-500 h-2.5 rounded-full"
                                style="width: {{ $progress->max_watch_percentage * 100 }}%"></div>
                        </div>
                        <p class="text-xs text-gray-600">{{ number_format($progress->max_watch_percentage * 100, 2) }}%
                        </p>

                        <p class="text-sm text-gray-500 mt-3">
                            <i class="fas fa-calendar-check text-green-500 mr-2"></i> Watched At:
                        </p>
                        <p class="text-base text-gray-700">{{ $progress->created_at->format('M d, Y h:i A') }}</p>
                    </div>

                    <a href="?video_page=1" class="mt-4 text-green-600 hover:underline text-sm">
                        View More
                    </a>
                </div>

                @if(request()->has('video_page'))
                <div class="mt-6 space-y-4 px-4 pb-4">
                    <h3 class="text-md font-semibold text-green-500">All Video Engagement</h3>
                    @foreach ($videoProgressPaginated as $progress)
                    <div class="border p-4 rounded bg-white">
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-play-circle text-purple-500 mr-2"></i> Progress:
                            <span class="text-gray-700">{{ number_format($progress->progress * 100, 2) }}%</span>
                        </p>
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-chart-line text-indigo-500 mr-2"></i> Max Watched:
                            <span
                                class="text-gray-700">{{ number_format($progress->max_watch_percentage * 100, 2) }}%</span>
                        </p>
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-calendar-check text-green-500 mr-2"></i> Watched At:
                            <span class="text-gray-700">{{ $progress->created_at->format('M d, Y h:i A') }}</span>
                        </p>
                    </div>
                    @endforeach

                    <div class="mt-4">
                        {{ $videoProgressPaginated->withQueryString()->links() }}
                    </div>


                    {{-- Close button --}}
                    <div>
                        <a href="{{ route('user.dashboard') }}" class="text-sm text-red-600 hover:underline">Close</a>
                    </div>
                </div>
                @endif
            </div>

            <div class="w-full md:w-2/3 p-4 bg-white border rounded-lg">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center text-green-500 text-md font-semibold">
                        <i class="fas fa-chart-line mr-2"></i>
                        <span>Video Engagement Chart</span>
                    </div>

                    <div class="flex items-center text-gray-700 text-sm">
                        <i class="fas fa-users text-green-500 mr-2"></i>
                        <span class="font-medium">Video Views:</span>
                        <span class="ml-1 font-bold">{{ $totalVideoViews }}</span>
                    </div>
                </div>

                <canvas id="videoProgressChart" height="100"></canvas>
            </div>
        </div>
        @endif
    </div>
</div>


{{-- Chart JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Funnel Views Chart
const funnelCtx = document.getElementById('funnelViewsChart')?.getContext('2d');
if (funnelCtx) {
    new Chart(funnelCtx, {
        type: 'line',
        data: {
            labels: [...Array(31).keys()].map(i => i + 1),
            datasets: [{
                label: 'Page Views',
                data: @json(array_values($pageViews)),
                borderColor: 'rgba(59, 130, 246, 1)',
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                },
                x: {
                    title: {
                        display: true,
                        text: 'Day of Month'
                    }
                }
            }
        }
    });
}

// Video Progress Chart
const videoCtx = document.getElementById('videoProgressChart')?.getContext('2d');
if (videoCtx) {
    new Chart(videoCtx, {
        type: 'line',
        data: {
            labels: [...Array(31).keys()].map(i => i + 1),
            datasets: [{
                label: 'Video Views',
                data: @json(array_values($videoViews)),
                borderColor: 'rgba(34, 197, 94, 1)',
                backgroundColor: 'rgba(34, 197, 94, 0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                },
                x: {
                    title: {
                        display: true,
                        text: 'Day of Month'
                    }
                }
            }
        }
    });
}
</script>


@endsection