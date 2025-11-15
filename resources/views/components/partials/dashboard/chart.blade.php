{{-- <div class="bg-gray-100 rounded-xl shadow-sm p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Sales Overview</h3>
        <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-500">Last 7 days</span>
            <span class="material-symbols-outlined text-gray-400 text-lg">calendar_today</span>
        </div>
    </div>
    
    <div class="h-64 flex items-end space-x-2 pb-4 border-b border-gray-100">
        <!-- Monday -->
        <div class="flex flex-col items-center flex-1">
            <div class="w-full bg-linear-to-t from-teal-500 to-teal-300 rounded-t-lg hover:from-teal-600 hover:to-teal-400 transition-all duration-200" style="height: 60%"></div>
            <span class="text-xs text-gray-500 mt-2">Mon</span>
        </div>
        <!-- Tuesday -->
        <div class="flex flex-col items-center flex-1">
            <div class="w-full bg-linear-to-t from-teal-500 to-teal-300 rounded-t-lg hover:from-teal-600 hover:to-teal-400 transition-all duration-200" style="height: 45%"></div>
            <span class="text-xs text-gray-500 mt-2">Tue</span>
        </div>
        <!-- Wednesday -->
        <div class="flex flex-col items-center flex-1">
            <div class="w-full bg-linear-to-t from-teal-500 to-teal-300 rounded-t-lg hover:from-teal-600 hover:to-teal-400 transition-all duration-200" style="height: 75%"></div>
            <span class="text-xs text-gray-500 mt-2">Wed</span>
        </div>
        <!-- Thursday -->
        <div class="flex flex-col items-center flex-1">
            <div class="w-full bg-linear-to-t from-teal-500 to-teal-300 rounded-t-lg hover:from-teal-600 hover:to-teal-400 transition-all duration-200" style="height: 85%"></div>
            <span class="text-xs text-gray-500 mt-2">Thu</span>
        </div>
        <!-- Friday -->
        <div class="flex flex-col items-center flex-1">
            <div class="w-full bg-linear-to-t from-teal-500 to-teal-300 rounded-t-lg hover:from-teal-600 hover:to-teal-400 transition-all duration-200" style="height: 65%"></div>
            <span class="text-xs text-gray-500 mt-2">Fri</span>
        </div>
        <!-- Saturday -->
        <div class="flex flex-col items-center flex-1">
            <div class="w-full bg-linear-to-t from-teal-500 to-teal-300 rounded-t-lg hover:from-teal-600 hover:to-teal-400 transition-all duration-200" style="height: 90%"></div>
            <span class="text-xs text-gray-500 mt-2">Sat</span>
        </div>
        <!-- Sunday -->
        <div class="flex flex-col items-center flex-1">
            <div class="w-full bg-linear-to-t from-teal-500 to-teal-300 rounded-t-lg hover:from-teal-600 hover:to-teal-400 transition-all duration-200" style="height: 70%"></div>
            <span class="text-xs text-gray-500 mt-2">Sun</span>
        </div>
    </div>
    
    <div class="flex items-center justify-between mt-4">
        <div class="flex items-center space-x-2">
            <div class="w-3 h-3 bg-teal-500 rounded-full"></div>
            <span class="text-sm text-gray-600">Total Revenue</span>
        </div>
        <div class="text-right">
            <p class="text-lg font-semibold text-gray-900">$8,420</p>
            <p class="text-xs text-teal-600 flex items-center justify-end">
                <span class="material-symbols-outlined text-sm mr-1">trending_up</span>
                +18.3% from last week
            </p>
        </div>
    </div>
</div> --}}

<?php 

$weeklySales = [
    ['day' => 'Mon', 'value' => 60, 'revenue' => 1200],
    ['day' => 'Tue', 'value' => 45, 'revenue' => 900],
    ['day' => 'Wed', 'value' => 75, 'revenue' => 1500],
    ['day' => 'Thu', 'value' => 85, 'revenue' => 1700],
    ['day' => 'Fri', 'value' => 65, 'revenue' => 1300],
    ['day' => 'Sat', 'value' => 90, 'revenue' => 1800],
    ['day' => 'Sun', 'value' => 70, 'revenue' => 1400],
];


// Calculate total revenue
$totalRevenue = array_sum(array_column($weeklySales, 'revenue'));

// Example growth percent (compared to last week)
$lastWeekRevenue = 10000; // replace with your actual last week total
$growthPercent = round((($totalRevenue - $lastWeekRevenue) / $lastWeekRevenue) * 100, 1);

?>

<div class="bg-gray-100 rounded-xl shadow-sm p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Sales Overview</h3>
        <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-500">Last 7 days</span>
            <span class="material-symbols-outlined text-gray-400 text-lg">calendar_today</span>
        </div>
    </div>

    <div class="h-64 flex items-end space-x-2 pb-4 border-b border-gray-100">
        @foreach ($weeklySales as $sale)
            <div class="flex flex-col items-center flex-1">
                <div class="w-full bg-linear-to-t from-teal-500 to-teal-300 rounded-t-lg hover:from-teal-600 hover:to-teal-400 transition-all duration-200"
                     style="height: {{ $sale['value'] }}%">
                </div>
                <span class="text-xs text-gray-500 mt-2">{{ $sale['day'] }}</span>
            </div>
        @endforeach
    </div>

    <div class="flex items-center justify-between mt-4">
        <div class="flex items-center space-x-2">
            <div class="w-3 h-3 bg-teal-500 rounded-full"></div>
            <span class="text-sm text-gray-600">Total Revenue</span>
        </div>
        <div class="text-right">
            <p class="text-lg font-semibold text-gray-900">${{ number_format($totalRevenue, 0) }}</p>
            <p class="text-xs text-teal-600 flex items-center justify-end">
                <span class="material-symbols-outlined text-sm mr-1">trending_up</span>
                +{{ $growthPercent }}% from last week
            </p>
        </div>
    </div>
</div>
