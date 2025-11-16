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
    <table class="min-w-full bg-cyan-100 rounded-lg overflow-hidden border border-gray-200">
        <thead class="bg-linear-to-br from-teal-400 to-teal-500 text-white shadow-sm">
            <tr>
                <th class="px-6 py-4 text-left font-semibold text-sm uppercase tracking-wider">Vendor Name</th>
                <th class="px-6 py-4 text-left font-semibold text-sm uppercase tracking-wider">Email</th>
                <th class="px-6 py-4 text-left font-semibold text-sm uppercase tracking-wider">Role</th>
                <th class="px-6 py-4 text-left font-semibold text-sm uppercase tracking-wider">Food Stall</th>
                <th class="px-6 py-4 text-left font-semibold text-sm uppercase tracking-wider">Joined</th>
                <th class="px-6 py-4 text-left font-semibold text-sm uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($users as $uid => $user)
                <tr class="hover:bg-cyan-200 transition-colors duration-200 ease-in-out group">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class=" h-10 w-10">
                                <img class="h-10 w-10 rounded-full" 
                                     src="https://ui-avatars.com/api/?name={{ urlencode($user['vendor_name']) }}&background=0D9488&color=ffffff&size=40" 
                                     alt="{{ $user['vendor_name'] }}">
                            </div>
                            <div class="ml-4">
                                <div class="font-medium text-gray-900">{{ $user['vendor_name'] }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $user['email'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                    {{ $user['role'] === 'Admin' ? 'bg-purple-100 text-purple-800' : 
                                       ($user['role'] === 'Vendor' ? 'bg-teal-100 text-teal-800' : 'bg-gray-100 text-gray-800') }}">
                            {{ $user['role'] }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $user['food_stall'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-sm">
                        {{ \Carbon\Carbon::parse($user['created_at'])->format('M j, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <a href="{{ route('user.edit', $uid) }}" 
                                class="p-2 rounded-lg hover:bg-teal-100 text-teal-600 hover:text-teal-700 transition-colors" 
                                title="Edit User">
                                <span class="material-symbols-outlined text-lg">edit</span>
                            </a>
                            <button type="button" 
                                class="p-2 rounded-lg hover:bg-blue-100 text-blue-500 hover:text-blue-600 transition-colors"
                                title="View Profile">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </button>
                            <form action="{{ route('user.delete', $uid) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete {{ $user['vendor_name'] }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="p-2 rounded-lg hover:bg-red-100 text-red-500 hover:text-red-600 transition-colors" 
                                    title="Delete User">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </form>
                        </div> 
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <span class="material-symbols-outlined text-4xl text-gray-300 mb-2">group</span>
                            <p class="text-lg font-medium text-gray-400">No users found</p>
                            <p class="text-sm text-gray-400 mt-1">Users will appear here once they register</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>