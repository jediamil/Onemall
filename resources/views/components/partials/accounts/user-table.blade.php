@props(['users' => []])
<div class="overflow-x-auto rounded-lg shadow-sm">
    <!-- Success/Error Messages -->
    @if (session('success'))
        <div class="bg-teal-50 border border-teal-200 text-teal-700 px-4 py-3 rounded-lg flex items-center mb-4">
            <span class="material-symbols-outlined mr-2 text-teal-600">check_circle</span>
            {{ session('success') }}
        </div>
    @endif
    
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
            <div class="flex items-center mb-1">
                <span class="material-symbols-outlined mr-2">error</span>
                <span class="font-medium">Please fix the following errors:</span>
            </div>
            <ul class="list-disc list-inside text-sm space-y-1 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-linear-to-r from-teal-400 to-teal-500">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold text-white text-sm uppercase tracking-wider">Vendor</th>
                    <th class="px-6 py-4 text-left font-semibold text-white text-sm uppercase tracking-wider">Contact</th>
                    <th class="px-6 py-4 text-left font-semibold text-white text-sm uppercase tracking-wider">Role</th>
                    <th class="px-6 py-4 text-left font-semibold text-white text-sm uppercase tracking-wider">Food Stall</th>
                    <th class="px-6 py-4 text-left font-semibold text-white text-sm uppercase tracking-wider">Joined Date</th>
                    <th class="px-6 py-4 text-left font-semibold text-white text-sm uppercase tracking-wider">Permit</th>
                    <th class="px-6 py-4 text-left font-semibold text-white text-sm uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-cyan-100 divide-y divide-gray-100">
                @forelse ($users as $uid => $user)
                    <tr class="hover:bg-cyan-200 transition-all duration-200 ease-in-out group border-l-2 border-l-transparent hover:border-l-teal-400">
                        <!-- Vendor Name with Avatar -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 relative">
                                    <img class="h-10 w-10 rounded-full ring-2 ring-white shadow-sm" 
                                        src="https://ui-avatars.com/api/?name={{ urlencode($user['vendor_name']) }}&background=0D9488&color=ffffff&size=40" 
                                        alt="{{ $user['vendor_name'] }}">
                                    <div class="absolute -bottom-1 -right-1 h-4 w-4 rounded-full border-2 border-white 
                                        {{ $user['role'] === 'Admin' ? 'bg-purple-500' : 
                                        ($user['role'] === 'Vendor' ? 'bg-teal-500' : 'bg-gray-400') }}">
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="font-semibold text-gray-900">{{ $user['vendor_name'] }}</div>
                                    <div class="text-xs text-gray-500">ID: {{ substr($uid, 0, 8) }}...</div>
                                </div>
                            </div>
                        </td>
                        
                        <!-- Email -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center text-gray-600">
                                <span class="material-symbols-outlined text-gray-400 text-sm mr-2">mail</span>
                                <span class="text-sm">{{ $user['email'] }}</span>
                            </div>
                        </td>
                        
                        <!-- Role Badge -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold
                                        {{ $user['role'] === 'Admin' ? 'bg-purple-100 text-purple-800 ring-1 ring-purple-200' : 
                                        ($user['role'] === 'Vendor' ? 'bg-teal-100 text-teal-800 ring-1 ring-teal-200' : 'bg-gray-100 text-gray-800 ring-1 ring-gray-200') }}">
                                <span class="w-1.5 h-1.5 rounded-full mr-1.5
                                    {{ $user['role'] === 'Admin' ? 'bg-purple-500' : 
                                    ($user['role'] === 'Vendor' ? 'bg-teal-500' : 'bg-gray-500') }}">
                                </span>
                                {{ $user['role'] }}
                            </span>
                        </td>
                        
                        <!-- Food Stall -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center text-gray-600">
                                <span class="material-symbols-outlined text-gray-400 text-sm mr-2">storefront</span>
                                <span class="text-sm font-medium">{{ $user['food_stall'] }}</span>
                            </div>
                        </td>
                        
                        <!-- Joined Date -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">
                                <div class="font-medium">{{ \Carbon\Carbon::parse($user['created_at'])->format('M j, Y') }}</div>
                                <div class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($user['created_at'])->diffForHumans() }}</div>
                            </div>
                        </td>
                        
                        <!-- Permit Download -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if(($user['permitURL'] ?? false) && Storage::disk('public')->exists('permits/' . basename($user['permitURL'])))
                                <div class="flex flex-col space-y-1">
                                    <a href="{{ $user['permitURL'] }}" download 
                                    class="inline-flex items-center justify-center px-3 py-2 bg-linear-to-r from-teal-500 to-teal-600 text-white rounded-lg text-sm font-medium hover:from-teal-600 hover:to-teal-700 transition-all duration-200 shadow-sm hover:shadow-md">
                                        <span class="material-symbols-outlined text-sm mr-1.5">download</span>
                                        Download
                                    </a>
                                    <span class="text-xs text-gray-500 text-center truncate max-w-[120px] mx-auto">
                                        {{ \Illuminate\Support\Str::limit(basename($user['permitURL']), 15) }}
                                    </span>
                                </div>
                            @else
                                <span class="inline-flex items-center px-3 py-2 bg-gray-100 text-gray-400 rounded-lg text-sm font-medium border border-gray-200">
                                    <span class="material-symbols-outlined text-sm mr-1.5">file_upload_off</span>
                                    No Permit
                                </span>
                            @endif
                        </td>
                        
                        <!-- Actions -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-1 opacity-70 group-hover:opacity-100 transition-opacity duration-200">
                                <!-- Edit Button -->
                                <a href="{{ route('user.edit', $uid) }}" 
                                    class="inline-flex items-center p-2 rounded-lg bg-white text-gray-600 hover:text-teal-600 hover:bg-teal-50 border border-gray-200 hover:border-teal-200 transition-all duration-200 shadow-sm hover:shadow"
                                    title="Edit User">
                                    <span class="material-symbols-outlined text-base">edit</span>
                                </a>
                                
                                {{-- <!-- View Profile Button -->
                                <button type="button" 
                                    class="inline-flex items-center p-2 rounded-lg bg-white text-gray-600 hover:text-blue-600 hover:bg-blue-50 border border-gray-200 hover:border-blue-200 transition-all duration-200 shadow-sm hover:shadow"
                                    title="View Profile">
                                    <span class="material-symbols-outlined text-base">visibility</span>
                                </button> --}}
                                
                                <!-- Delete Button -->
                                <form action="{{ route('user.delete', $uid) }}" method="POST" 
                                    onsubmit="return confirm('Are you sure you want to delete {{ $user['vendor_name'] }}? This action cannot be undone.')"
                                    class="inline-flex">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="inline-flex items-center p-2 rounded-lg bg-white text-gray-600 hover:text-red-600 hover:bg-red-50 border border-gray-200 hover:border-red-200 transition-all duration-200 shadow-sm hover:shadow"
                                        title="Delete User">
                                        <span class="material-symbols-outlined text-base">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <span class="material-symbols-outlined text-5xl mb-4">group_off</span>
                                <p class="text-lg font-medium text-gray-500 mb-1">No users found</p>
                                <p class="text-sm text-gray-400">Users will appear here once they register in the system</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>