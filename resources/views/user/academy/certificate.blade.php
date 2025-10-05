@extends('layouts.academy')

@section('title', 'Certificate of Completion')

@section('content')
<!-- ✅ Load Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

<div class="flex flex-col items-center justify-center py-12 px-6 bg-gradient-to-b from-white to-green-50 min-h-screen">

    <!-- Certificate container -->
    <div id="certificate"
        class="relative mx-auto bg-white border-[5px] border-yellow-500 rounded-xl shadow-2xl text-center"
        style="
            width: 800px;
            height: 560px;
            background-image: url('{{ asset('assets/images/certificate.png') }}');
            background-size: cover;
            background-position: center;
            font-family: 'Inter', sans-serif;
        ">

        <div class="flex flex-col items-center justify-center h-full px-12 py-8 text-gray-100">

            <h1 class="text-4xl font-bold mb-4 text-yellow-300 drop-shadow-md"
                style="font-family: 'Playfair Display', serif;">
                Certificate of Completion
            </h1>

            <!-- 👏 Congratulations Message -->
            <p class="text-lg mb-4 text-yellow-200 drop-shadow-sm font-semibold uppercase tracking-wide"
               style="font-family: 'Inter', sans-serif;">
                 🎉 Congratulations! 🎉
            </p>

            <p class="text-lg mb-6 text-gray-200 drop-shadow-sm">
              You have successfully completed the module:
            </p>

            <h2 class="text-2xl font-semibold mb-8 italic text-yellow-200 drop-shadow-md"
                style="font-family: 'Playfair Display', serif;">
                {{ $module->module_name }}
            </h2>

            <p class="text-md mb-6 text-gray-300 drop-shadow-sm">
                <strong>Date Completed:</strong>
                {{ \Carbon\Carbon::parse($completedModule->completion_date)->format('F j, Y') }}
            </p>

            <div class="border-t border-gray-400 pt-6 mt-6 text-gray-100">
                <p>This certificate is awarded to</p>
                <p class="text-2xl font-bold mt-2 text-white drop-shadow"
                    style="font-family: 'Playfair Display', serif;">
                    {{ auth()->user()->name }}
                </p>
            </div>
        </div>
    </div>

    <!-- Download button -->
    <div class="text-center mt-6">
        <button onclick="downloadCertificate()" class="bg-green-600 text-white px-6 py-2 rounded shadow hover:bg-green-700">
            Download Certificate as Image
        </button>
    </div>
</div>

<!-- ✅ Confetti CDN -->
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<!-- ✅ html2canvas -->
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

<script>
    // 🎊 Trigger confetti when page loads
    window.addEventListener('load', () => {
        launchConfetti();
    });

    function launchConfetti() {
        const duration = 3 * 1000; // 3 seconds
        const end = Date.now() + duration;

        (function frame() {
            // Two side bursts
            confetti({
                particleCount: 4,
                angle: 60,
                spread: 55,
                origin: { x: 0 }
            });
            confetti({
                particleCount: 4,
                angle: 120,
                spread: 55,
                origin: { x: 1 }
            });

            if (Date.now() < end) {
                requestAnimationFrame(frame);
            }
        }());
    }

    function downloadCertificate() {
        const element = document.getElementById('certificate');
        setTimeout(() => {
            html2canvas(element, { useCORS: true, scale: 2 }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'certificate.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        }, 300);
    }
</script>
@endsection
