@props(['title', 'details', 'link'])
        <a href="{{$link}}" class="bg-gray-100  w-full max-w-lg rounded-xl border-2 border-teal-600/60">
            <div class="group flex justify-between items-center bg-transparent hover:bg-teal-600/40 transition rounded-lg cursor-pointer">
                <!-- Left side -->
                <div class="flex flex-col p-4">
                    <div class="text-teal-600 font-medium text-xl transition group-hover:text-teal-50">
                        {{ $title }}
                    </div>
                    <div class="text-teal-500 transition group-hover:text-teal-50/60">
                        {{ $details }}
                    </div>  
                </div>

                <!-- Right side (icon) -->
                <div class="flex items-center p-4">
                    <span class="material-symbols-outlined text-teal-500 transition group-hover:text-teal-50">
                        arrow_forward_ios
                    </span>
                </div>
            </div>
        </a>