<!-- Responsive Sidebar Navigation -->
<nav class="bg-cyan-100 min-h-[90%] flex flex-col md:w-72 w-full transition-all duration-300 mt-0 ml-0 md:ml-4">
  <!-- Header / Logo -->
  <div class="flex items-center justify-between px-6 md:p-0 border-b border-cyan-200">
    <div class="flex justify-start md:justify-center w-full mr-5">
        <img src="{{ asset('images/ONEMALLLOGOFORLIGHTBG.png') }}" alt="ONEMALL" class=" w-25 md:w-40">
    </div>
    <!-- Mobile toggle button -->
    <button id="menuBtn" class="md:hidden text-gray-700 p-2 rounded-lg hover:bg-cyan-200 transition-colors">
      <span class="material-symbols-outlined">menu</span>
    </button>
  </div>

  <!-- Links -->
  <div id="menu" class="flex-col space-y-2 mt-4 hidden md:flex">
    <a href="/dashboard" 
        class="flex items-center px-4 py-3 rounded-l-3xl transition-all duration-200
        {{ Request::is('dashboard') ? 'bg-cyan-200 text-teal-900 font-medium' : 'text-teal-700 hover:bg-cyan-200' }}">
        <span class="material-symbols-outlined mr-3">dashboard</span>
        <span class="md:block">Dashboard</span>
    </a>

    <a href="/account-management" 
        class="flex items-center px-4 py-3 rounded-l-3xl transition-all duration-200
        {{ Request::is('account-management') ? 'bg-cyan-200 text-teal-900 font-medium' : 'text-teal-700 hover:bg-cyan-200' }}">
        <span class="material-symbols-outlined mr-3">account_circle</span>
        <span class="md:block">Account Management</span>
    </a>

    <a href="/vendor-management" 
        class="flex items-center px-4 py-3 rounded-l-3xl transition-all duration-200
        {{ Request::is('vendor-management') ? 'bg-cyan-200 text-teal-900 font-medium' : 'text-teal-700 hover:bg-cyan-200' }}">
        <span class="material-symbols-outlined mr-3">key_vertical</span>
        <span class="md:block">Vendor Management</span>
    </a>

    <a href="/settings" 
        class="flex items-center px-4 py-3 rounded-l-3xl transition-all duration-200
        {{ Request::is('settings') ? 'bg-cyan-200 text-teal-900 font-medium' : 'text-teal-700 hover:bg-cyan-200' }}">
        <span class="material-symbols-outlined mr-3">settings</span>
        <span class="md:block">Settings</span>
    </a>

    <form action="{{ route('logout') }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="cursor-pointer w-full text-teal-700 hover:bg-cyan-200 rounded-l-3xl flex items-center px-4 py-3 transition-all duration-200">
            <span class="material-symbols-outlined mr-3">chip_extraction</span>
            <span class="md:block">Logout</span>
        </button>
    </form>
  </div>
</nav>

{{-- <script>
document.getElementById('menuBtn').addEventListener('click', function() {
    const menu = document.getElementById('menu');
    menu.classList.toggle('hidden');
    menu.classList.toggle('flex');
});
</script> --}}