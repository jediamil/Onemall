<x-layouts.app title="Dashboard"> 
    
    <div class="flex justify-center items-start md:items-center h-screen w-full">
        <div class="w-full bg-black/20 p-4 md:p-10 m-4 md:m-0 md:mr-10 rounded-3xl h-[82vh]">
            <x-partials.admin-header title="Dashboard" />
            Welcome to dashboard, <p>Your UID: {{ session('user_uid') }}</p> <p>Your name: {{ session('account_name') }}</p> <p>Your role: {{ session('user_role') }}</p>
        </div>
    </div>

</x-layouts.app> 