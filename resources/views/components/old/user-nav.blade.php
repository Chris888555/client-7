<div class="flex items-center justify-between p-4 bg-white shadow-md">
    <!-- Mobile toggle -->
    <button id="mobileToggle" class="lg:hidden p-2 rounded-md bg-indigo-700 text-white">
        ☰
    </button>

    <!-- PC collapse toggle -->
    <button id="pcCollapse" class="hidden lg:inline-block p-2 rounded-md bg-indigo-700 text-white">
        ⇔
    </button>

    <h1 class="text-lg font-semibold">Toolbar Area</h1>
</div>
<script>
    const sidebar = document.getElementById('sidebar');
    const mobileToggle = document.getElementById('mobileToggle');
    const pcCollapse = document.getElementById('pcCollapse');

    // Mobile toggle (slide in/out)
    if (mobileToggle) {
        mobileToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    }

    // PC collapse (icon only)
    if (pcCollapse) {
        pcCollapse.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
        });
    }
</script>
