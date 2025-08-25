<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Responsive Modern Sidebar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-b9r+Y7lJjXl8Ox7UMr3a0xAayJ0qNd1d3D7d+ffVk4gn6r1frjJix4NScZy7XYdP3I8ZlWvM0Mj9RfP7OZ7zYQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .sidebar {
      border-top-right-radius: 2.5rem;
      border-bottom-right-radius: 2.5rem;
      transition: all 0.3s ease;
    }
    .nav-icon {
      transition: background 0.3s, transform 0.3s;
      padding-left: 1.25rem; /* px-5 */
      padding-right: 1.25rem;
      padding-top: 0.75rem;  /* py-3 */
      padding-bottom: 0.75rem;
    }
    .nav-icon:hover {
      background: rgba(255, 255, 255, 0.15);
      transform: scale(1.05);
    }
    /* PC collapse */
    .collapsed {
      width: 5rem !important;
    }
    .collapsed .nav-text,
    .collapsed .logo-text {
      display: none;
    }
    /* Keep FA icon size same */
    .sidebar i {
      font-size: 1.5rem;
      min-width: 24px;
      text-align: center;
    }
  </style>
</head>
<body class="bg-[#f8f9ff] flex">

  <!-- Overlay for mobile -->
  <div id="mobileOverlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40"></div>

  <!-- Sidebar -->
  <aside id="sidebar" class="sidebar bg-indigo-700 text-white w-64 min-h-screen flex flex-col py-6 shadow-lg lg:relative fixed top-0 left-0 z-50 lg:translate-x-0 -translate-x-full lg:transition-none transition-transform duration-300">
    <!-- Logo -->
    <div class="flex items-center justify-center lg:justify-start px-4 mb-10">
      <div class="bg-white p-3 rounded-2xl">
        <i class="fa-solid fa-house text-indigo-700"></i>
      </div>
      <span class="logo-text hidden lg:inline ml-3 font-semibold text-lg">SmartHome</span>
    </div>

    <!-- Navigation -->
    <nav class="flex flex-col gap-2 flex-1">
      <a href="#" class="nav-icon flex items-center gap-3 rounded-xl mx-3 font-medium">
        <i class="fa-solid fa-gauge"></i>
        <span class="nav-text">Dashboard</span>
      </a>
      <a href="#" class="nav-icon flex items-center gap-3 rounded-xl mx-3 font-medium">
        <i class="fa-solid fa-door-open"></i>
        <span class="nav-text">Rooms</span>
      </a>
      <a href="#" class="nav-icon flex items-center gap-3 rounded-xl mx-3 font-medium">
        <i class="fa-solid fa-lightbulb"></i>
        <span class="nav-text">Devices</span>
      </a>
      <a href="#" class="nav-icon flex items-center gap-3 rounded-xl mx-3 font-medium">
        <i class="fa-solid fa-shield-halved"></i>
        <span class="nav-text">Security</span>
      </a>
      <a href="#" class="nav-icon flex items-center gap-3 rounded-xl mx-3 font-medium">
        <i class="fa-solid fa-users"></i>
        <span class="nav-text">Members</span>
      </a>
    </nav>

    <!-- Logout -->
    <div class="mt-auto px-3">
      <a href="#" class="nav-icon flex items-center gap-3 rounded-xl font-medium">
        <i class="fa-solid fa-right-from-bracket"></i>
        <span class="nav-text">Logout</span>
      </a>
    </div>
  </aside>

</body>
</html>
