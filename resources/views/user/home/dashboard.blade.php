@extends('layouts.users')

@section('title', 'Dashboard')

@section('content')



<section class="container max-w-full  flex justify-center items-center ">
    <div class="">
        <img src="{{ asset('assets/images/header.png') }}" alt="Header Image" class="w-full h-auto ">
    </div>
</section>



<div class="container mx-auto p-4 sm:p-8 max-w-full">
  <div class="flex flex-col md:flex-row gap-6">
        

<div class="w-full sm:max-w-[430px] mx-auto flex flex-col items-center">
    
<div class="flex justify-start py-6">
    <p class="text-gray-700 text-sm">
        📌 Note: You can download your partnership poster here.
    </p>
</div>


    <!-- Profile Card 1 for view-->
    <div class="w-full sm:max-w-[430px] sm:max-h-[430px] rounded-xl flex flex-col items-center justify-center overflow-hidden"
         style="background-image: url('{{ asset('assets/images/user-poster.jpg') }}'); background-size: cover; background-position: center; aspect-ratio: 1/1;">

        <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/profile_picture/profile.png') }}"
             alt="Profile Photo"
             class="h-32 w-32 sm:h-[180px] sm:w-[180px] object-cover rounded-full border-8 border-white mb-[20px] sm:mb-[55px]">

        <div class="text-center mb-4">
            <h1 class="text-base sm:text-2xl font-bold text-white mt-[40px] sm:mt-4">{{ Auth::user()->name }}</h1>
        </div>
    </div>


   

       <!-- Profile Card 2 - Fixed Size -->
    <div id="profileCard"
     class="absolute m-8 rounded-xl flex flex-col items-center justify-center overflow-hidden "
     style="
        width: 1500px;       /* fixed width */
        height: 1500px;      /* fixed height */
        background-image: url('{{ asset('assets/images/user-poster.jpg') }}');
        background-size: cover;
        background-position: center;
        left: -9999px; 
        top: -9999px;
     ">

    <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/profile_picture/profile.png') }}"
         alt="Profile Photo"
         style="
            width: 640px;   /* fixed size */
            height: 640px;
            border-radius: 50%;
            border: 20px solid white; 
            margin-top: -400px;
         ">

        <div class="text-center mb-4">
            <h1 class="absolute bottom-[320px] right-[27%] text-7xl font-bold text-white ">{{ Auth::user()->name }}</h1>
        </div>
    </div>


   <!-- Download Button -->
   <!-- Download Button -->
<button id="downloadBtn" class="mt-4 px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition flex items-center gap-2">
    <i class="fas fa-download"></i>
    <span id="downloadText">Download as Image</span>
</button>


</div>

<!-- html2canvas CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


<script>
document.getElementById('downloadBtn').addEventListener('click', async function() {
    const btn = this;
    const textSpan = document.getElementById('downloadText');
    const card = document.getElementById('profileCard');

    // Change button text
    textSpan.textContent = 'Downloading...';
    btn.disabled = true;

    try {
        const canvas = await html2canvas(card, {
            useCORS: true,
            backgroundColor: null
        });

        const link = document.createElement('a');
        link.href = canvas.toDataURL('image/png');
        link.download = 'profile-card.png';
        link.click();

        // Show success alert
        Swal.fire({
            icon: 'success',
            title: 'NICE',
            text: 'Downloaded successfully.',
            showConfirmButton: true
        });
    } catch (err) {
        console.error('Download failed', err);
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Failed to download image.'
        });
    } finally {
        // Revert button text
        textSpan.textContent = 'Download as Image';
        btn.disabled = false;
    }
});
</script>




       <!-- Right: Recent Leads Card (larger) -->
            <div class="w-full md:w-2/3 bg-white rounded-xl p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Leads</h2>

                @if($recentLeads->count() > 0)
                    <ul class="space-y-3 max-h-[32rem] overflow-y-auto text-sm">
                        @foreach($recentLeads as $lead)
                            <li class="p-4 bg-gray-50 rounded-lg shadow flex justify-between items-center hover:bg-gray-100 transition">
                                <div>
                                    <p class="font-semibold text-gray-900 flex items-center">
                                        {{ $lead->name }}
                                        @if($lead->created_at->isToday())
                                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                NEW - Today
                                            </span>
                                        @endif
                                    </p>
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
