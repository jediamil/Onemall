<div class="flex justify-between items-start w-full pb-6 px-1 flex-col sm:flex-row gap-4 sm:gap-0">
    <div class="text-start sm:text-left">
        <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800">{{ $title }}</h2>
        <p class="text-gray-500 text-sm mt-1">Manage your {{ $title }}</p>
    </div>
    <div class="hidden lg:flex items-center space-x-4 rounded-xl px-4 py-2">
        <!-- Name -->
        <div class="text-right">
            <p class="text-gray-800 font-medium">
                {{ session('vendor_name') ?? 'Guest User' }}
            </p>
            <p class="text-gray-500 text-xs">{{ session('role')}}</p>
        </div>
        <!-- Avatar generated from name -->
        <div class="relative">
            <img 
                src="https://ui-avatars.com/api/?name={{ urlencode(session('vendor_name') ?? 'Guest User') }}&background=0D9488&color=ffffff&size=64&bold=true" 
                alt="Avatar"
                class="w-11 h-11 rounded-full object-cover border-2 border-teal-100"
            >
        </div>
    </div>
</div>