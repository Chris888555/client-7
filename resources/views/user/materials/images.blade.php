@extends('layouts.users')

@section('title', 'Materials')

@section('content')

<div class="container mx-auto p-4 sm:p-8 max-w-full material-section">

    

    {{-- ✅ HEADER --}}
    <div class="flex justify-between items-center mb-4">
        <span class="px-3 py-2 bg-gray-100 text-gray-800 rounded border">
            {{ $materials->count() }} items
        </span>
    </div>

    @if($materials->isEmpty())
       <x-no-data />
    @else
    <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-4">

        @foreach($materials as $material)
        <div class="col">
            <div class="h-full border rounded-lg overflow-hidden flex flex-col">

                {{-- ✅ Caption Section --}}
                <div class="p-3 mb-2 border-b">
                    <div class="text-gray-500 text-sm max-h-12 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300">
                        {{ $material->caption ?? 'No caption' }}
                    </div>

                    @if($material->caption)
                    <button class="mt-3 px-2 py-1 border border-blue-600 text-blue-600 text-sm rounded hover:bg-blue-50 flex items-center copy-caption-btn"
                        data-caption="{{ $material->caption }}">
                        <i class="bi bi-clipboard mr-1"></i> Copy Caption
                    </button>
                    @endif
                </div>

                {{-- ✅ Image Section --}}
                <div class="p-3 flex-1">
                    <div class="relative overflow-hidden rounded-sm image-wrapper group">

                        <img src="{{ asset('storage/' . $material->file_path) }}" 
                             alt="Material Image"
                             class="w-full h-auto object-cover block rounded">

                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition"></div>

                        <a href="{{ asset('storage/' . $material->file_path) }}" download
                           class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white px-3 py-1 rounded hidden group-hover:flex items-center text-gray-800 shadow"
                           title="Download">
                            <i class="fas fa-cloud-download-alt mr-1"></i> Download
                        </a>

                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

{{-- ✅ Script Section --}}
<script>
document.querySelectorAll('.copy-caption-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const caption = btn.getAttribute('data-caption');
        navigator.clipboard.writeText(caption).then(() => {
            btn.innerHTML = '<i class="bi bi-check2 mr-1"></i> Text Copied';
            setTimeout(() => {
                btn.innerHTML = '<i class="bi bi-clipboard mr-1"></i> Copy Caption';
            }, 1500);
        });
    });
});
</script>

@endsection
