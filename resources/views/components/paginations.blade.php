<div class="mt-6 w-full flex items-center justify-between px-4 sm:px-6 pb-6">
    <!-- Page Count (Left) -->
    <div class="text-xs text-slate-500">
        Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}
    </div>

    <!-- Pagination Buttons (Right) -->
    <div class="flex items-center space-x-2">
        <!-- Previous Button -->
        <a href="{{ $paginator->onFirstPage() ? '#' : $paginator->previousPageUrl() }}" 
           class="rounded-md rounded-r-none border border-r border-slate-300 py-1 px-2 text-center text-xs transition-all shadow-sm text-slate-600 hover:text-white hover:bg-slate-800 hover:border-slate-800 focus:outline-none {{ $paginator->onFirstPage() ? 'pointer-events-none opacity-50 shadow-none' : '' }}"
           aria-label="Previous Page">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M11.03 3.97a.75.75 0 0 1 0 1.06l-6.22 6.22H21a.75.75 0 0 1 0 1.5H4.81l6.22 6.22a.75.75 0 1 1-1.06 1.06l-7.5-7.5a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
            </svg>
        </a>

        <!-- Next Button -->
        <a href="{{ $paginator->hasMorePages() ? $paginator->nextPageUrl() : '#' }}" 
           class="rounded-md rounded-l-none border border-l border-slate-300 py-1 px-2 text-center text-xs transition-all shadow-sm text-slate-600 hover:text-white hover:bg-slate-800 hover:border-slate-800 focus:outline-none {{ !$paginator->hasMorePages() ? 'pointer-events-none opacity-50 shadow-none' : '' }}"
           aria-label="Next Page">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06l6.22-6.22H3a.75.75 0 0 1 0-1.5h16.19l-6.22-6.22a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
        </a>
    </div>
</div>
