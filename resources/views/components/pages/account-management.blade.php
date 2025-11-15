<x-layouts.app title="Account management"> 
    
    <div class="flex justify-center items-start md:items-center w-full">
        <div class="w-full bg-black/20 p-4 m-4 md:m-0 md:p-10 md:mr-10 rounded-3xl min-h-[84vh]">
            <x-partials.admin-header title="Account management" />

                @foreach ($users as $uid => $user) 
                    <p>Your user id is: {{$uid}}</p>
                    <p>Name: {{ $user['vendor_name'] }}</p>
                    <p>Food stall: {{ $user['food_stall'] }}</p>
                    <p>Email: {{ $user['email'] }}</p>
                    <p>Role: {{ $user['role'] }}</p>
                    <p>Join: {{ $user['created_at']}}</p>
                    <hr>
                @endforeach

        </div>
    </div>

</x-layouts.app> 