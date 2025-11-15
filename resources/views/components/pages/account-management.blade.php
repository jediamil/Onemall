<x-layouts.app title="Account management"> 
    
    <div class="flex justify-center items-start md:items-center w-full">
        <div class="w-full bg-black/20 p-4 m-4 md:m-0 md:p-10 md:mr-10 rounded-3xl min-h-[84vh]">
            <x-partials.admin-header title="Account management" />
            <x-partials.accounts.user-table :users="$users"/>
        </div>
    </div>

</x-layouts.app> 