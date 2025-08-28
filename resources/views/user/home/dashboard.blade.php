@extends('layouts.users')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto p-4 sm:p-8 max-w-full">

    <div class="flex flex-col md:flex-row gap-6">

        <!-- Left: Profile Card (centered) -->
        <div class="w-full md:w-1/3 bg-white  rounded-xl p-6 flex flex-col items-center">
            <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/profile_picture/profile.png') }}"
                 alt="Profile Photo"
                 class="h-52 w-52 object-cover rounded-full border-8 border-gray-300 mb-4">

            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900">Hello, {{ Auth::user()->name }}</h1>
                <p class="text-gray-700 mt-1">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <!-- Right: Recent Leads Card (larger) -->
        <div class="w-full md:w-2/3 bg-white  rounded-xl p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Leads</h2>

            @if($recentLeads->count() > 0)
                <ul class="space-y-3 max-h-[32rem] overflow-y-auto">
                    @foreach($recentLeads as $lead)
                        <li class="p-4 bg-gray-50 rounded-lg shadow flex justify-between items-center hover:bg-gray-100 transition">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $lead->name }}</p>
                                <p class="text-sm text-gray-500">{{ $lead->email }}</p>
                            </div>
                            <span class="text-sm text-gray-400">{{ $lead->created_at->format('M d, Y') }}</span>
                        </li>
                    @endforeach
                </ul>
           @else
                <x-no-data />
            @endif

        </div>
    </div>



<!-- Funnel Views Chart -->
<div class="mt-8 bg-white rounded-xl shadow-sm border p-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-y-4 sm:gap-y-0 mb-4">
        <h2 class="text-lg font-semibold">
            Funnel Page Views ({{ \Carbon\Carbon::create($year, $month)->format('F Y') }})
        </h2>

        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
            <!-- Summary -->
            <div class="text-sm text-center sm:text-left">
                <div class="text-gray-700">
                    <span class="font-semibold text-blue-600">{{ $totalViewsThisMonth }}</span> total views this month
                </div>
                <div class="text-gray-500">
                    <span class="font-semibold">{{ $totalViewsAllTime }}</span> current and old views
                </div>
            </div>

            <!-- Year + Month Selector -->
            <form method="GET" action="{{ route('user.dashboard') }}" 
                  class="flex flex-col sm:flex-row items-center gap-2">
                <select name="year" class="w-full sm:w-auto px-3 py-2 border rounded-md text-sm focus:outline-none focus:ring">
                    @for ($y = now()->year; $y >= now()->year - 5; $y--)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
                <select name="month" class="w-full sm:w-auto px-3 py-2 border rounded-md text-sm focus:outline-none focus:ring"
                    onchange="this.form.submit()">
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                        </option>
                    @endfor
                </select>
            </form>
        </div>
    </div>

    <canvas id="viewsChart" height="100"></canvas>
</div>


<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('viewsChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [...Array({{ count($viewsCounts) }}).keys()].map(i => i + 1), // Days of month
            datasets: [{
                label: 'Page Views',
                data: @json($viewsCounts),
                backgroundColor: 'rgba(37, 99, 235, 0.7)',
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: { title: { display: true, text: 'Day of Month' } },
                y: { title: { display: true, text: 'Views' }, beginAtZero: true }
            }
        }
    });
</script>


</div>
@endsection
