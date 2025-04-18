@extends('layouts.app')

@section('title', 'Page View')

@section('content')
@include('includes.nav')

<div class="container m-auto p-4 sm:p-8 max-w-full">
 
     <h1 class="text-2xl md:text-3xl font-bold text-left">Page View Analytics</h1>
        <p class="text-gray-600 text-left mb-4">Monitor how many users visit your sales funnel page.</p>


    <!-- Total Page Views Display -->
    <div class="flex items-center gap-4 bg-white shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] rounded-lg p-5 w-full  mx-auto mb-8 border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <!-- Icon -->
        <div class="w-14 h-14 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
            <svg class="w-7 h-7 text-gray-500 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                <path d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z"/>
                <path d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z"/>
            </svg>
        </div>

        <!-- Count and Label -->
        <div class="flex flex-col">
            <span class="text-4xl font-extrabold text-gray-900 dark:text-white">{{ $totalViews }}</span>
            <p class="text-sm text-gray-500 dark:text-gray-400">Total Page Views</p>
        </div>
    </div>

 <form id="analyticsForm" action="{{ route('pageView.analytics') }}" method="GET" class="mb-10">
    <div class="flex flex-wrap gap-4 items-center ">
        <!-- Year Select -->
        <div>
            <label for="year" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Select Year</label>
            <select name="year" id="year" class="w-32 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                @foreach(range(2020, now()->year) as $yearOption)
                    <option value="{{ $yearOption }}" {{ $year == $yearOption ? 'selected' : '' }}>
                        {{ $yearOption }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Month Select -->
        <div>
            <label for="month" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Select Month</label>
            <select name="month" id="month" class="w-40 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                @foreach(range(1, 12) as $monthOption)
                    <option value="{{ $monthOption }}" {{ $month == $monthOption ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::createFromFormat('m', $monthOption)->format('F') }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</form>

<script>
    // Auto-submit the form when either dropdown is changed
    document.getElementById('year').addEventListener('change', function() {
        document.getElementById('analyticsForm').submit();
    });

    document.getElementById('month').addEventListener('change', function() {
        document.getElementById('analyticsForm').submit();
    });
</script>


    <!-- Chart Container -->
    <div class="bg-white p-6 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] border border-gray-200 dark:bg-gray-800 dark:border-gray-700 mx-auto">
        <canvas id="viewsChart" height="300"></canvas>
    </div>
</div>



<!-- Chart.js Script -->
<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($labels);
    const data = @json($data);

    const ctx = document.getElementById('viewsChart').getContext('2d');

    // Create gradient background
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(59, 130, 246, 0.3)'); // blue-500
    gradient.addColorStop(1, 'rgba(59, 130, 246, 0)');

    const viewsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: '📈 Page Views',
                data: data,
                fill: true,
                backgroundColor: gradient,
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 3,
                tension: 0.4,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: '#3B82F6',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: '#3B82F6',
                pointStyle: 'circle',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    backgroundColor: '#1F2937',
                    titleColor: '#fff',
                    bodyColor: '#F3F4F6',
                    cornerRadius: 8,
                    padding: 10,
                    callbacks: {
                        label: function(context) {
                            return ` ${context.raw} page views`;
                        }
                    }
                },
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    
                    ticks: {
                        color: '#9CA3AF',
                        font: {
                            size: 12
                        }
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Sales Funnel Page Views',
                        color: '#6B7280',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    ticks: {
                        stepSize: 1,
                        color: '#9CA3AF',
                        font: {
                            size: 12
                        }
                    },
                    grid: {
                        color: 'rgba(107, 114, 128, 0.1)', // light gray
                        borderDash: [5, 5]
                    }
                }
            }
        }
    });
</script>

@endsection
