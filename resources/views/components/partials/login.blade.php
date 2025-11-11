<div class="w-80">
    <img src="{{ asset('images/ONEMALLLOGOFORLIGHTBG.png') }}" alt="ONEMALL">
</div>

<div class="w-full flex flex-col items-center p-10">
    <div class="w-full max-w-7xl mb-4 text-left">
        <span class="font-medium text-3xl text-gray-600">Login</span>
        <hr class="w-24 border-t-4 border-teal-400/70 mt-2 rounded">
    </div>

    <form action="POST" class="w-full  max-w-7xl rounded-2xl">
        <div class="flex flex-col gap-6">
        <!-- Username Field -->
        <div class="flex items-center border-b-2 border-teal-600/60 focus-within:border-teal-300">
            <span class="material-symbols-outlined text-gray-400 mr-2">mail</span>
            <input 
            type="text" 
            placeholder="Enter your username" 
            class="w-full bg-transparent outline-none py-3 text-gray-700 placeholder-gray-400"
            >
        </div>

        <!-- Password Field -->
        <div class="flex flex-col gap-3">
            <div class="flex items-center border-b-2 border-teal-600/60 focus-within:border-teal-300">
            <span class="material-symbols-outlined text-gray-400 mr-2">lock</span>
            <input 
                type="password" 
                placeholder="Enter your password" 
                class="w-full bg-transparent outline-none py-3 text-gray-700 placeholder-gray-400"
            >
            </div>  
            <a href="#" class="text-teal-500 text-sm text-right hover:underline">Forgot password?</a>
        </div>

        <!-- Submit Button -->
        <button 
            type="submit" 
            class="cursor-pointer w-full bg-teal-600/80 text-white text-lg font-semibold py-3 rounded-lg hover:bg-teal-500 transition duration-200"
        >
            Login
        </button>
        </div>
    </form>
</div>