@props([
    'user' => [],
    'uid' => [],
])
<div class="flex justify-start max-w-full bg-cyan-100 border border-teal-100 rounded-xl">
    <form action="{{ route('user.update', $uid) }}" method="POST" class="w-full max-w-2xl py-15 px-8">
        @method('PUT')
        @csrf

        @if (session('success'))
            <div class="bg-teal-50 border border-teal-200 text-teal-700 px-4 py-3 rounded-lg flex items-center mb-3">
                <span class="material-symbols-outlined mr-2 text-teal-600">check_circle</span>
                {{ session('success') }}
            </div>
        @endif
        
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-3">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined mr-2">error</span>
                    <div>
                        @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <div class="space-y-5">
            <div>
                <label for="vendor_name" class="block text-sm font-medium text-gray-700 mb-2" value="{{ $user['vendor_name'] }}">Vendor Name</label>
                <input type="text" name="vendor_name" placeholder="Enter vendor name"  value="{{ $user['vendor_name'] }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-150 placeholder-gray-400">
            </div>

            <div>
                <label for="food_stall" class="block text-sm font-medium text-gray-700 mb-2" value="{{ $user['food_stall'] }}">Food Stall Name</label>
                <input type="text" name="food_stall" placeholder="Enter food stall name"  value="{{ $user['food_stall'] }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-150 placeholder-gray-400">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2" value="{{ $user['email'] }}">Email Address</label>
                <input type="email" name="email" placeholder="Enter email address"  value="{{ $user['email'] }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-150 placeholder-gray-400">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password" placeholder="Create password" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-150 placeholder-gray-400">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="Confirm password" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-150 placeholder-gray-400">
            </div>
        </div>

        <button type="submit"
            class="mt-5 w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-3.5 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
            Update Vendor Account
        </button>
    </form>
</div>