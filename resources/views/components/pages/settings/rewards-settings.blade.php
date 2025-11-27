<x-layouts.app title="System maintenance">
    <div class="flex justify-center items-start md:items-center w-full">
        <div class="w-full bg-black/20 p-4 m-4 md:m-0 md:p-10 md:mr-10 rounded-3xl min-h-[84vh]">
            <x-partials.admin-header title="Rewards System Settings" />
                <div class="w-full flex flex-col gap-4">
<div class="min-h-screen bg-linear-to-b from-cyan-100 to-white p-6 rounded">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-3xl font-bold text-gray-900">Rewards System Settings</h1>
                <p class="text-gray-600 mt-2">Manage your tasks efficiently</p>
            </div>
            <button class="bg-linear-to-r from-teal-500 to-cyan-600 text-white px-6 py-3 rounded-xl font-semibold 
                          hover:from-teal-600 hover:to-cyan-700 transition-all duration-300 
                          shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Task
            </button>
        </div>

        <!-- Tasks Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach ($tasks as $taskId => $task)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 
                          border border-teal-100 transform hover:-translate-y-1 p-6">
                    
                    <!-- Task Header -->
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold text-teal-800 pr-2">
                            {{ $task['title'] }}
                        </h3>
                        <span class="bg-teal-100 text-teal-800 text-xs font-medium px-2.5 py-1 rounded-full">
                            ID: {{ $taskId }}
                        </span>
                    </div>

                    <!-- Task Details -->
                    <div class="space-y-3 mb-6">
                        <div class="flex items-start gap-3">
                            <div class="bg-teal-50 p-2 rounded-lg">
                                <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Description</p>
                                <p class="text-gray-800">{{ $task['description'] }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="bg-teal-50 p-2 rounded-lg">
                                <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Reward</p>
                                <p class="text-teal-700 font-semibold">{{ $task['voucherReward'] }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-start gap-3">
                                <div class="bg-teal-50 p-2 rounded-lg">
                                    <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Deadline</p>
                                    <p class="text-gray-800 font-medium">
                                        {{ \Carbon\Carbon::createFromTimestampMs($task['deadlineDate'])->toDateString() }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="bg-teal-50 p-2 rounded-lg">
                                    <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Validity</p>
                                    <p class="text-gray-800 font-medium">
                                        {{ \Carbon\Carbon::createFromTimestampMs($task['voucherValidityDate'])->toDateString() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <form action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full bg-linear-to-r from-teal-500 to-teal-600 text-white py-3 rounded-xl 
                                       font-semibold hover:from-teal-600 hover:to-teal-700 transition-all duration-300 
                                       shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Task
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>
                </div>
            </div>
        </x-layouts.app>