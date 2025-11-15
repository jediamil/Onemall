@props(['sales', 'details', 'icon'])

<div class="flex flex-1 flex-col p-8 bg-cyan-100 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">

    <div class="flex justify-between items-start mb-4">
        <div class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $sales }}</div>

        <div class="p-2 sm:p-3 bg-linear-to-br from-teal-500 to-teal-600 text-white rounded-xl shadow-sm">
            <span class="material-symbols-outlined text-xl sm:text-2xl" style="font-size: 28px;">{{ $icon }}</span>
        </div>
    </div>

    <div class="text-gray-600 font-medium mb-2 text-sm sm:text-base md:text-lg">{{ $details }}</div>
    
    <div class="flex items-center text-xs sm:text-sm text-teal-600 font-medium mt-auto">
        <span class="material-symbols-outlined text-sm sm:text-base mr-1">trending_up</span>
        +12.4% from last month
    </div>
</div>



