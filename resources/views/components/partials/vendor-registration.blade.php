<div class="flex">
    <form action="{{ route('vendor.register.submit') }}" method="POST" class="max-w-lg rounded-2xl space-y-5 border-teal-500">
        @csrf

        @if (session('success'))
            <div class="bg-teal-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="text-red-800/70 p-3 rounded mb-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="space-y-6">
            <label for="vendor name" class="text-teal-800">Vendor name:</label>
            <input type="text" name="vendor_name" placeholder="Vendor name" required
                class="text-teal-700 mt-1 w-full px-4 py-2 border border-teal-600/80 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150">

            <label for="food stall" class="text-teal-800">Food stall name:</label>
            <input type="text" name="food_stall" placeholder="Food stall name" required
                class="text-teal-700 mt-1 w-full px-4 py-2 border border-teal-600/80 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150">

            <label for="email" class="text-teal-800">Email:</label>
            <input type="email" name="email" placeholder="Email" required
                class="text-teal-700 mt-1 w-full px-4 py-2 border border-teal-600/80 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150">

            <label for="passowrd" class="text-teal-800">Password:</label>
            <input type="password" name="password" placeholder="Enter Password" required
                class="text-teal-700 mt-1 w-full px-4 py-2 border border-teal-600/80 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150">

            <label for="confirm password" class="text-teal-800">Confirm password:</label>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required
                class="text-teal-700 mt-1 w-full px-4 py-2 border border-teal-600/80 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-150">
        </div>

        <button type="submit"
            class="mt-1 w-full cursor-pointer bg-teal-600 hover:bg-teal-600/0 text-white font-medium py-2.5 rounded-lg shadow-md transition duration-200">
            Register
        </button>
        </p>
    </form>
</div>