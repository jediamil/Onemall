<div class="flex flex-col lg:flex-row gap-3">
    <x-partials.dashboard.card-template 
        sales="Total of Sales"
        details="9999999"
        icon="finance_mode"
    />

    <x-partials.dashboard.card-template 
        sales="Total of QR CODE Purchases"
        details="9999999"
        icon="local_mall"
    />

    <x-partials.dashboard.card-template 
        sales="Total of Redeem Points"
        details="9999999"
        icon="hand_package"
    />
</div>
<br />
{{-- <x-partials.dashboard.chart /> --}}



<div class="bg-linear-to-b from-cyan-100 to-cyan-50 rounded-xl shadow-sm p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Sales Overview</h3>
        <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-500">Last 7 days</span>
            <span class="material-symbols-outlined text-gray-400 text-lg">calendar_today</span>
        </div>
    </div>

    @php
        $maxValue = max(array_column($weeklySales, 'value'));
        $maxBarHeight = 180; // Optimal max height for h-64 container
        $totalRevenue = array_sum(array_column($weeklySales, 'revenue'));
    @endphp

    <div class="h-64 flex items-end space-x-1 pb-4 border-b border-gray-100">
        @foreach ($weeklySales as $sale)
            @php
                $barHeight = ($sale['value'] / $maxValue) * $maxBarHeight;
                $isPeak = $sale['value'] === $maxValue;
            @endphp
            
            <div class="flex flex-col items-center flex-1 group relative">
                <!-- Bar with improved gradient and peak highlighting -->
                <div class="w-10/12 bg-linear-to-t {{ $isPeak ? 'from-teal-600 to-teal-400' : 'from-teal-500 to-teal-300' }} rounded-t-lg hover:from-teal-700 hover:to-teal-500 transition-all duration-300 ease-out hover:scale-105 relative"
                     style="height: {{ $barHeight }}px">
                     
                    <!-- Animated tooltip -->
                    <div class="absolute -top-9 left-1/2 transform -translate-x-1/2 bg-gray-900 text-white text-xs px-2 py-1.5 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 transition-all duration-200 whitespace-nowrap pointer-events-none">
                        <div class="font-medium">{{ $sale['value'] }} units</div>
                        <div class="text-teal-300">${{ number_format($sale['revenue'], 0) }}</div>
                        <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-2 h-2 bg-gray-900 rotate-45"></div>
                    </div>
                    
                    <!-- Peak indicator -->
                    @if($isPeak)
                        <div class="absolute -top-5 left-1/2 transform -translate-x-1/2">
                            <span class="material-symbols-outlined text-teal-600 text-sm">star</span>
                        </div>
                    @endif
                </div>
                
                <!-- Day label -->
                <span class="text-xs text-gray-600 mt-2 font-medium {{ $isPeak ? 'text-teal-700' : '' }}">
                    {{ $sale['day'] }}
                </span>
            </div>
        @endforeach
    </div>

    <!-- Stats footer -->
    <div class="flex items-center justify-between mt-4">
        <div class="flex items-center space-x-3">
            <div class="flex items-center space-x-1">
                <div class="w-3 h-3 bg-teal-500 rounded-full"></div>
                <span class="text-sm text-gray-600">Units Sold</span>
            </div>
        </div>
        
        <div class="text-right">
            <p class="text-lg font-semibold text-gray-900">${{ number_format($totalRevenue, 0) }}</p>
            <p class="text-xs {{ $growthPercent >= 0 ? 'text-teal-600' : 'text-red-600' }} flex items-center justify-end font-medium">
                <span class="material-symbols-outlined text-sm mr-1">
                    {{ $growthPercent >= 0 ? 'trending_up' : 'trending_down' }}
                </span>
                {{ $growthPercent >= 0 ? '+' : '' }}{{ $growthPercent }}% from last week
            </p>
        </div>
    </div>
</div>