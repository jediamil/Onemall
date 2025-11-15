<div class="flex justify-between w-full pb-4">
    <h2 class="text-3xl text-teal-600 font-medium">{{ $title }}</h2>
    <div class="flex items-center space-x-3">
        <!-- Avatar generated from name -->
        <img 
            src="https://ui-avatars.com/api/?name={{ urlencode(session('vendor_name') ?? 'Guest User') }}&background=14B8A6&color=ffffff&size=64&bold=true" 
            alt="Avatar"
            class="w-10 h-10 rounded-full object-cover"
        >
        <!-- Name -->
        <p class="text-gray-50 text-lg">
            {{ session('vendor_name') ?? 'Guest User' }}
        </p>
    </div>
</div>