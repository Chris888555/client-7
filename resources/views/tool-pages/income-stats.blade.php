@extends('layouts.app')

@section('content')
    <div class="space-y-6 p-6">

        {{-- Profile Card (Static User Data) --}}
      {{-- Container na may 3-column grid, tapos 5 cards na full width inside it --}}
<div class=" w-full">

    {{-- Profile Card: occupying 1 column --}}
    <div class="bg-[#0B2347] rounded-xl border border-gray-700 p-6 flex items-center space-x-4 text-gray-300 shadow-lg">
        <img src="https://ceoroundtable.heart.org/wp-content/uploads/2018/05/Bradway-Robert_-tie_external_2017small.jpg"
            alt="Profile Picture"
            class="w-20 h-20 rounded-full object-cover border-4 border-teal-500 shadow-md">
        <div>
            <h2 class="text-lg md:text-2xl font-bold flex items-center space-x-2 text-white">
                <span>Juan Dela Cruz</span>
                <svg class="h-5 w-5 md:h-6 md:w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 
                          3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 
                          3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 
                          3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 
                          3.42 3.42 0 013.138-3.138z" />
                </svg>
            </h2>
            <p class="text-gray-400 flex items-center space-x-4 mt-1">
                <span class="font-semibold text-teal-400 flex items-center space-x-1">
                    <i class="fa-solid fa-ranking-star text-teal-400 mr-2"></i>
                    <span>Rank:</span>
                </span>
                <span class="text-white">Affiliate</span>
            </p>
        </div>
    </div>
 </div>
 
    {{-- Commission Cards Container: spanning 2 columns --}}
     <div class="flex flex-row space-x-4">
  <p class="text-sm font-semibold text-gray-700">Today's Earning</p>
  <p class="text-sm font-semibold text-gray-700">Date Jan-3-2025</p>
</div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 col-span-1 md:col-span-2 w-full">
        
        <div class="bg-white rounded-xl border p-6 w-full flex items-center space-x-3 shadow">
            <span class="bg-teal-600 text-white rounded-full p-3 inline-flex items-center justify-center">
                <i class="fas fa-box"></i>
            </span>
            <div>
                <p class="text-gray-600 text-sm mb-1">Whole Sale Commissions</p>
                <h3 class="text-xl font-bold text-teal-600">₱ 5,000.00</h3>
            </div>
        </div>

        <div class="bg-white rounded-xl border p-6 w-full flex items-center space-x-3 shadow">
            <span class="bg-teal-600 text-white rounded-full p-3 inline-flex items-center justify-center">
                <i class="fas fa-sync-alt"></i>
            </span>
            <div>
                <p class="text-gray-600 text-sm mb-1">
                    <span class="inline sm:block">Cycle</span>
                    <span class="inline sm:block">Commissions</span>
                </p>
                <h3 class="text-xl font-bold text-teal-600">₱ 3,000.00</h3>
            </div>
        </div>

        <div class="bg-white rounded-xl border p-6 w-full flex items-center space-x-3 shadow">
            <span class="bg-teal-600 text-white rounded-full p-3 inline-flex items-center justify-center">
                <i class="fas fa-infinity"></i>
            </span>
            <div>
                <p class="text-gray-600 text-sm mb-1">Infinity Commissions</p>
                <h3 class="text-xl font-bold text-teal-600">₱ 2,000.00</h3>
            </div>
        </div>

        <div class="bg-white rounded-xl border p-6 w-full flex items-center space-x-3 shadow">
            <span class="bg-teal-600 text-white rounded-full p-3 inline-flex items-center justify-center">
                <i class="fas fa-sitemap"></i>
            </span>
            <div>
                <p class="text-gray-600 text-sm mb-1">Group Sales Commissions</p>
                <h3 class="text-xl font-bold text-teal-600">₱ 4,000.00</h3>
            </div>
        </div>

        <div class="bg-white rounded-xl border p-6 w-full flex items-center space-x-3 shadow">
            <span class="bg-teal-600 text-white rounded-full p-3 inline-flex items-center justify-center">
                <i class="fas fa-truck"></i>
            </span>
            <div>
                <p class="text-gray-600 text-sm mb-1">Dropshipping Commissions</p>
                <h3 class="text-xl font-bold text-teal-600">₱ 1,000.00</h3>
            </div>
        </div>
    </div>



  {{-- Earnings View Toggle --}}
    <div x-data="earningsChart()" class="mt-8 p-6 bg-white rounded-xl border shadow-lg">
        <div class="flex space-x-4 mb-6 justify-center">
            <button
                :class="view === 'day' ? 'bg-teal-600 text-white' : 'bg-gray-200 text-gray-700'"
                @click="changeView('day')"
                class="px-4 py-2 rounded-md font-semibold"
            >Day</button>

            <button
                :class="view === 'week' ? 'bg-teal-600 text-white' : 'bg-gray-200 text-gray-700'"
                @click="changeView('week')"
                class="px-4 py-2 rounded-md font-semibold"
            >Week</button>

            <button
                :class="view === 'month' ? 'bg-teal-600 text-white' : 'bg-gray-200 text-gray-700'"
                @click="changeView('month')"
                class="px-4 py-2 rounded-md font-semibold"
            >Month</button>
        </div>

        {{-- Chart Container --}}
        <canvas id="earningsChart" class="w-full h-64"></canvas>
    </div>

</div>

{{-- Load Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- Alpine.js CDN (if not loaded globally) --}}
<script src="//unpkg.com/alpinejs" defer></script>

<script>
function earningsChart() {
    return {
        view: 'day', // default view
        chart: null,

        // Sample data for demo (replace with dynamic data)
        data: {
            day: {
                labels: ['12 AM', '4 AM', '8 AM', '12 PM', '4 PM', '8 PM'],
                values: [200, 500, 800, 600, 700, 900]
            },
            week: {
                labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                values: [1500, 2300, 1800, 2200, 2500, 2700, 3000]
            },
            month: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                values: [9000, 10000, 8000, 11000]
            }
        },

        init() {
            const ctx = document.getElementById('earningsChart').getContext('2d');
            this.chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: this.data[this.view].labels,
                    datasets: [{
                        label: 'Earnings',
                        data: this.data[this.view].values,
                        backgroundColor: 'rgba(14, 116, 144, 0.2)',
                        borderColor: 'rgba(14, 116, 144, 1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.3,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: value => `₱ ${value}`
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: ctx => `₱ ${ctx.parsed.y}`
                            }
                        }
                    }
                }
            });
        },

        changeView(view) {
            this.view = view;
            // Update chart data
            this.chart.data.labels = this.data[view].labels;
            this.chart.data.datasets[0].data = this.data[view].values;
            this.chart.update();
        }
    }
}
</script>

@endsection
