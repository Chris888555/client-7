<div class="mt-6 flex justify-center items-center space-x-2">
  <!-- Previous Button -->
  <a href="{{ $paginator->onFirstPage() ? '#' : $paginator->previousPageUrl() }}" 
     class="rounded-md rounded-r-none border border-r border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm text-slate-600 hover:text-white hover:bg-slate-800 hover:border-slate-800 focus:outline-none focus:text-white focus:bg-slate-800 focus:border-slate-800 {{ $paginator->onFirstPage() ? 'pointer-events-none opacity-50 shadow-none' : '' }}"
     aria-label="Previous Page">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mx-auto">
      <path fill-rule="evenodd" d="M11.03 3.97a.75.75 0 0 1 0 1.06l-6.22 6.22H21a.75.75 0 0 1 0 1.5H4.81l6.22 6.22a.75.75 0 1 1-1.06 1.06l-7.5-7.5a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
    </svg>
  </a>

  <!-- Next Button -->
  <a href="{{ $paginator->hasMorePages() ? $paginator->nextPageUrl() : '#' }}" 
     class="rounded-md rounded-l-none border border-l border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm text-slate-600 hover:text-white hover:bg-slate-800 hover:border-slate-800 focus:outline-none focus:text-white focus:bg-slate-800 focus:border-slate-800 {{ !$paginator->hasMorePages() ? 'pointer-events-none opacity-50 shadow-none' : '' }}"
     aria-label="Next Page">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mx-auto">
      <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06l6.22-6.22H3a.75.75 0 0 1 0-1.5h16.19l-6.22-6.22a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
    </svg>
  </a>
</div>
