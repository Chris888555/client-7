<style>
/* Webkit Browsers (Chrome, Safari, Edge) */
::-webkit-scrollbar {
    width: 1px;
    height: 2px;
}

::-webkit-scrollbar-thumb {
    background-color: #F3F4F6; /* Tailwind Gray 100 */
    border-radius: 10px;
}
</style>


<!-- Mobile Overlay -->
<div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden xl:hidden"></div>

<!-- Desktop Sidebar -->
<aside id="sidebar" class="fixed w-[280px] border rounded-2xl inset-y-0 left-0 z-50 my-4 xl:ml-4 p-4 transition-all duration-200 xl:translate-x-0 transform -translate-x-full xl:relative bg-white">
  <!-- Close Icon (mobile only) -->
  <div class="relative h-16 flex items-center justify-between px-4 xl:hidden">
    <span id="close-sidebar" class="material-icons text-slate-500 cursor-pointer text-lg opacity-70">close</span>
  </div>

  <!-- Logo (Text Only) -->
<a href="javascript:;" id="sidebar-logo" class="flex items-center px-4 py-4 transition-all duration-300 pl-2 pr-4 justify-start">
  <span id="logo-text" class="text-lg font-bold transition-all duration-300">Rtech Solutions</span>
  <span id="logo-initial" class="hidden text-2xl font-bold mx-auto transition-all duration-300">R</span>
</a>

  <hr class="border-t border-slate-100 my-2">

  <!-- Menu Items -->
  <nav class="overflow-y-auto max-h-[calc(100vh-150px)]">
    <ul class="flex flex-col space-y-1 px-2 text-sm font-medium text-slate-700">
        
      <li>
        <a href="{{ route('user.dashboard') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-4 py-2 hover:bg-slate-100 transition">
          <div class="bg-slate-100 text-slate-700 rounded-lg p-2 flex items-center justify-center">
            <span class="material-icons text-xs">dashboard</span>
          </div>
          <span class="sidebar-text">Dashboard</span>
        </a>
      </li>

      <li>
        <a href="{{ route('materials.index') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-4 py-2 hover:bg-slate-100 transition">
          <div class="bg-slate-100 text-white rounded-lg p-2 flex items-center justify-center">
            <span class="material-icons text-xs text-slate-700">handyman</span>
          </div>
          <span class="sidebar-text">Marketing Tools</span>
        </a>
      </li>

       <li>
        <a href="{{ route('academy.show') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-4 py-2 hover:bg-slate-100 transition">
          <div class="bg-slate-100 text-white rounded-lg p-2 flex items-center justify-center">
            <span class="material-icons text-xs text-slate-700">school</span>
          </div>
          <span class="sidebar-text">Academy</span>
        </a>
      </li>

      
        <li>
        <a href="{{ route('funnels.activate.form') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-4 py-2 hover:bg-slate-100 transition">
          <div class="bg-slate-100 text-white rounded-lg p-2 flex items-center justify-center">
            <span class="material-icons text-xs text-slate-700">filter_alt</span>
          </div>
          <span class="sidebar-text">Sales Funnel</span>
        </a>
      </li>



    </ul>
  </nav>
</aside>

<aside id="mobile-sidebar" class="xl:hidden fixed w-[280px] border rounded-2xl inset-y-0 left-0 z-50 ml-2 my-4 p-0 bg-white flex flex-col overflow-hidden transition-all duration-200 transform -translate-x-full">

  <div class="relative h-16 flex items-center justify-between px-4">
    <span id="close-sidebar" class="material-icons text-slate-500 cursor-pointer text-lg opacity-70">close</span>
  </div>

  <!-- Logo -->
  <a href="javascript:;" id="sidebar-logo" class="flex items-center px-4 py-4 transition-all duration-300 pl-2 pr-4">
    <span class="text-lg font-bold">Rtech Solutions</span>
  </a>

  <hr class="border-t border-slate-200 my-2">

  <!-- Scrollable Menu -->
  <nav class="overflow-y-auto flex-1 px-2 pb-4">
    <ul class="flex flex-col space-y-1 text-sm font-medium text-slate-700">
      <li>
        <a href="../pages/dashboard.html" class="sidebar-item flex items-center gap-3 rounded-lg px-4 py-2 hover:bg-slate-100 transition">
          <div class="bg-slate-100 text-slate-700 rounded-lg p-2 flex items-center justify-center">
            <span class="material-icons text-xs">dashboard</span>
          </div>
          <span class="sidebar-text">Dashboard</span>
        </a>
      </li>

      <li>
        <a href="../pages/tables.html" class="sidebar-item flex items-center gap-3 rounded-lg px-4 py-2 hover:bg-slate-100 transition">
          <div class="bg-slate-100 text-slate-700 rounded-lg p-2 flex items-center justify-center">
            <span class="material-icons text-xs">table_chart</span>
          </div>
          <span class="sidebar-text">Tables</span>
        </a>
      </li>
 111111111111111


        <li>
        <a href="{{ route('funnels.activate.form') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-4 py-2 hover:bg-slate-100 transition">
          <div class="bg-slate-100 text-white rounded-lg p-2 flex items-center justify-center">
            <span class="material-icons text-xs text-slate-700">filter_alt</span>
          </div>
          <span class="sidebar-text">Sales Funnel</span>
        </a>
      </li>
        <li>
        <a href="{{ route('funnels.activate.form') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-4 py-2 hover:bg-slate-100 transition">
          <div class="bg-slate-100 text-white rounded-lg p-2 flex items-center justify-center">
            <span class="material-icons text-xs text-slate-700">filter_alt</span>
          </div>
          <span class="sidebar-text">Sales Funnel</span>
        </a>
      </li>
        <li>
        <a href="{{ route('funnels.activate.form') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-4 py-2 hover:bg-slate-100 transition">
          <div class="bg-slate-100 text-white rounded-lg p-2 flex items-center justify-center">
            <span class="material-icons text-xs text-slate-700">filter_alt</span>
          </div>
          <span class="sidebar-text">Sales Funnel</span>
        </a>
      </li>
        <li>
        <a href="{{ route('funnels.activate.form') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-4 py-2 hover:bg-slate-100 transition">
          <div class="bg-slate-100 text-white rounded-lg p-2 flex items-center justify-center">
            <span class="material-icons text-xs text-slate-700">filter_alt</span>
          </div>
          <span class="sidebar-text">Sales Funnel</span>
        </a>
      </li>
        <li>
        <a href="{{ route('funnels.activate.form') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-4 py-2 hover:bg-slate-100 transition">
          <div class="bg-slate-100 text-white rounded-lg p-2 flex items-center justify-center">
            <span class="material-icons text-xs text-slate-700">filter_alt</span>
          </div>
          <span class="sidebar-text">Sales Funnel</span>
        </a>
      </li>
        <li>
        <a href="{{ route('funnels.activate.form') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-4 py-2 hover:bg-slate-100 transition">
          <div class="bg-slate-100 text-white rounded-lg p-2 flex items-center justify-center">
            <span class="material-icons text-xs text-slate-700">filter_alt</span>
          </div>
          <span class="sidebar-text">Sales Funnel</span>
        </a>
      </li>
        <li>
        <a href="{{ route('funnels.activate.form') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-4 py-2 hover:bg-slate-100 transition">
          <div class="bg-slate-100 text-white rounded-lg p-2 flex items-center justify-center">
            <span class="material-icons text-xs text-slate-700">filter_alt</span>
          </div>
          <span class="sidebar-text">Sales Funnel</span>
        </a>
      </li>
        <li>
        <a href="{{ route('funnels.activate.form') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-4 py-2 hover:bg-slate-100 transition">
          <div class="bg-slate-100 text-white rounded-lg p-2 flex items-center justify-center">
            <span class="material-icons text-xs text-slate-700">filter_alt</span>
          </div>
          <span class="sidebar-text">Sales Funnel</span>
        </a>
      </li>
        <li>
        <a href="{{ route('funnels.activate.form') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-4 py-2 hover:bg-slate-100 transition">
          <div class="bg-slate-100 text-white rounded-lg p-2 flex items-center justify-center">
            <span class="material-icons text-xs text-slate-700">filter_alt</span>
          </div>
          <span class="sidebar-text">Sales Funnel</span>
        </a>
      </li>
        <li>
        <a href="{{ route('funnels.activate.form') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-4 py-2 hover:bg-slate-100 transition">
          <div class="bg-slate-100 text-white rounded-lg p-2 flex items-center justify-center">
            <span class="material-icons text-xs text-slate-700">filter_alt</span>
          </div>
          <span class="sidebar-text">Sales Funnel</span>
        </a>
      </li>
        <li>
        <a href="{{ route('funnels.activate.form') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-4 py-2 hover:bg-slate-100 transition">
          <div class="bg-slate-100 text-white rounded-lg p-2 flex items-center justify-center">
            <span class="material-icons text-xs text-slate-700">filter_alt</span>
          </div>
          <span class="sidebar-text">Sales Funnel</span>
        </a>
      </li>
        <li>
        <a href="{{ route('funnels.activate.form') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-4 py-2 hover:bg-slate-100 transition">
          <div class="bg-slate-100 text-white rounded-lg p-2 flex items-center justify-center">
            <span class="material-icons text-xs text-slate-700">filter_alt</span>
          </div>
          <span class="sidebar-text">Sales Funnel</span>
        </a>
      </li>


    </ul>
  </nav>
</aside>

