<!-- Responsive Sidebar Navigation -->
<nav class="bg-cyan-100 min-h-[90%] flex flex-col md:w-72 w-full transition-all duration-300 mt-0 md:mt-17 ml-0 md:ml-4 ">
  <!-- Header / Logo -->
  <div class="flex items-center justify-between p-4 md:p-0 md:pl-7 border-b border-cyan-200">
    <div class="w-25 md:w-40">
        <img src="{{ asset('images/ONEMALLLOGOFORLIGHTBG.png') }}" alt="ONEMALL">
    </div>
    <!-- Mobile toggle button -->
    <button id="menuBtn" class="md:hidden text-gray-700">
      <span class="material-symbols-outlined">menu</span>
    </button>
  </div>

  <!-- Links -->
    <div id="menu" class="flex-col space-y-2 mt-4 md:flex hidden ">
    <a href="/dashboard" 
        class="flex items-center px-4 py-3 rounded-l-3xl 
        {{ Request::is('dashboard') ? 'bg-cyan-200 text-teal-900 font-medium' : 'text-teal-700 hover:bg-cyan-200' }}">
        <span class="material-symbols-outlined mr-3">dashboard</span>
        Dashboard
    </a>

    <a href="/account-management" 
        class="flex items-center px-4 py-3 rounded-l-3xl
        {{ Request::is('account-management') ? 'bg-cyan-200 text-teal-900 font-medium' : 'text-teal-700 hover:bg-cyan-200' }}">
        <span class="material-symbols-outlined mr-3">account_circle</span>
        Account Management
    </a>

    <a href="/vendor-management" 
        class="flex items-center px-4 py-3 rounded-l-3xl 
        {{ Request::is('vendor-management') ? 'bg-cyan-200 text-teal-900 font-medium' : 'text-teal-700 hover:bg-cyan-200' }}">
        <span class="material-symbols-outlined mr-3">key_vertical</span>
        Vendor Management
    </a>

    <a href="/settings" 
        class="flex items-center px-4 py-3 rounded-l-3xl 
        {{ Request::is('settings') ? 'bg-cyan-200 text-teal-900 font-medium' : 'text-teal-700 hover:bg-cyan-200' }}">
        <span class="material-symbols-outlined mr-3">settings</span>
        Settings
    </a>

    <a href="#" 
        class="flex items-center px-4 py-3 text-teal-700 hover:bg-cyan-200 rounded-l-3xl">
        <span class="material-symbols-outlined mr-3">chip_extraction</span>
        Logout
    </a>
    </div>
</nav>

<!-- Toggle Script -->
<script>
  const menuBtn = document.getElementById('menuBtn');
  const menu = document.getElementById('menu');
  menuBtn.addEventListener('click', () => {
    menu.classList.toggle('hidden');
  });
</script>
