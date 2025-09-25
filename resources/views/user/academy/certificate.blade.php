@extends('layouts.academy')

@section('title', 'Certificate of Completion')

@section('content')
<div class="flex flex-col items-center justify-center py-12 px-6 bg-gradient-to-b from-white to-green-50 min-h-screen">

    <!-- Certificate container -->
    <div id="certificate" class="relative mx-auto bg-white border-[5px] border-black rounded-xl shadow-2xl text-center"
        style="
            width: 800px;
            height: 560px;
            background-image: url('{{ asset('assets/images/certificate.png') }}');
            background-size: cover;
            background-position: center;
        ">

        <div class="flex flex-col items-center justify-center h-full px-12 py-8 text-green-700">

            <h1 class="text-4xl font-bold mb-4 drop-shadow-md">Certificate of Completion</h1>

            <p class="text-lg mb-6 drop-shadow-sm">
                Congratulations! You have successfully completed the module:
            </p>

            <h2 class="text-2xl font-semibold mb-8 italic drop-shadow-md">
                {{ $module->module_name }}
            </h2>

            <p class="text-md mb-6 drop-shadow-sm">
                <strong>Date Completed:</strong>
                {{ \Carbon\Carbon::parse($completedModule->completion_date)->format('F j, Y') }}
            </p>

            <div class="border-t border-white pt-6 mt-6 text-black">
                <p>This certificate is awarded to</p>
                <p class="text-2xl font-bold mt-2 drop-shadow">
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

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<script>
    function downloadCertificate() {
        const element = document.getElementById('certificate');

        // Wait a tick to ensure background image is rendered
        setTimeout(() => {
            html2canvas(element, {
                useCORS: true,
                allowTaint: false,
                scale: 2
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'certificate.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        }, 300); // slight delay to ensure rendering
    }
</script>
@endsection