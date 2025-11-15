<x-layouts.app title="Dashboard"> 
    
    <div class="flex justify-center items-start md:items-center w-full">
        <div class="w-full bg-black/20 p-4 md:p-10 m-4 md:m-0 md:mr-10 rounded-3xl min-h-[84vh]">
            <x-partials.admin-header title="Dashboard" />
            @if (session('error'))
                <div class="bg-teal-500 text-white p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            Welcome to dashboard, <p>Your UID: {{ session('user_uid') }}</p> <p>Your name: {{ session('vendor_name') }}</p> <p>Your food_stall: {{ session('food_stall') }}</p> <p>Your role: {{ session('role') }}</p>

        </div>
    </div>

</x-layouts.app> 