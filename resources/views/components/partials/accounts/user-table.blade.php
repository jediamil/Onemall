@props(['users' => []])

<div class="overflow-x-auto rounded-lg shadow-sm">

    {{-- Success Message --}}
    @if (session('success'))
        <div class="bg-teal-50 border border-teal-200 text-teal-700 px-4 py-3 rounded-lg flex items-center mb-4">
            <span class="material-symbols-outlined mr-2 text-teal-600">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Messages --}}
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

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-linear-to-r from-teal-400 to-teal-500">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-white uppercase">Vendor</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-white uppercase">Contact</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-white uppercase">Role</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-white uppercase">Food Stall</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-white uppercase">Joined Date</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-white uppercase">Permit</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-white uppercase">Actions</th>
                </tr>
            </thead>

            <tbody class="bg-cyan-100 divide-y divide-gray-100">
                @forelse ($users as $uid => $user)
                    @php
                        $vendorName = $user['vendor_name'] ?? 'Unknown Vendor';
                        $email      = $user['email'] ?? 'N/A';
                        $role       = $user['role'] ?? 'User';
                        $foodStall  = $user['food_stall'] ?? '—';
                        $createdAt  = $user['created_at'] ?? null;
                        $permitURL  = $user['permitURL'] ?? null;
                    @endphp

                    <tr class="hover:bg-cyan-200 transition group">
                        {{-- Vendor --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img class="h-10 w-10 rounded-full ring-2 ring-white shadow-sm"
                                     src="https://ui-avatars.com/api/?name={{ urlencode($vendorName) }}&background=0D9488&color=ffffff&size=40"
                                     alt="{{ $vendorName }}">

                                <div class="ml-4">
                                    <div class="font-semibold text-gray-900">{{ $vendorName }}</div>
                                    <div class="text-xs text-gray-500">ID: {{ substr($uid, 0, 8) }}...</div>
                                </div>
                            </div>
                        </td>

                        {{-- Email --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $email }}
                        </td>

                        {{-- Role --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $role === 'Admin' ? 'bg-purple-100 text-purple-800' :
                                   ($role === 'Vendor' ? 'bg-teal-100 text-teal-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ $role }}
                            </span>
                        </td>

                        {{-- Food Stall --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $foodStall }}
                        </td>

                        {{-- Joined Date --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if($createdAt)
                                <div>{{ \Carbon\Carbon::parse($createdAt)->format('M j, Y') }}</div>
                                <div class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($createdAt)->diffForHumans() }}</div>
                            @else
                                <span class="text-gray-400">Unknown</span>
                            @endif
                        </td>

                        {{-- Permit --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($permitURL && Storage::disk('public')->exists('permits/' . basename($permitURL)))
                                <a href="{{ $permitURL }}" download
                                   class="inline-flex items-center px-3 py-2 bg-teal-600 text-white rounded-lg text-sm">
                                    Download
                                </a>
                            @else
                                <span class="text-sm text-gray-400">No Permit</span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        {{-- <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex space-x-2">
                                <a href="{{ route('user.edit', $uid) }}"
                                   class="p-2 border rounded hover:bg-teal-50">
                                    <span class="material-symbols-outlined">edit</span>
                                </a>

                                <form action="{{ route('user.delete', $uid) }}" method="POST"
                                      onsubmit="return confirm('Delete {{ $vendorName }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="p-2 border rounded hover:bg-red-50">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td> --}}

                        <td class="px-6 py-4 whitespace-nowrap"> <div class="flex items-center space-x-1 opacity-70 group-hover:opacity-100 transition-opacity duration-200"> <!-- Edit Button --> <a href="{{ route('user.edit', $uid) }}" class="inline-flex items-center p-2 rounded-lg bg-white text-gray-600 hover:text-teal-600 hover:bg-teal-50 border border-gray-200 hover:border-teal-200 transition-all duration-200 shadow-sm hover:shadow" title="Edit User"> <span class="material-symbols-outlined text-base">edit</span> </a> <!-- View Profile Button --> {{-- <button type="button" class="inline-flex items-center p-2 rounded-lg bg-white text-gray-600 hover:text-blue-600 hover:bg-blue-50 border border-gray-200 hover:border-blue-200 transition-all duration-200 shadow-sm hover:shadow" title="View Profile"> <span class="material-symbols-outlined text-base">visibility</span> </button> --}} <!-- Delete Button --> <form action="{{ route('user.delete', $uid) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete {{ $vendorName }}? This action cannot be undone.')" class="inline-flex"> @csrf @method('DELETE') <button type="submit" class="inline-flex items-center p-2 rounded-lg bg-white text-gray-600 hover:text-red-600 hover:bg-red-50 border border-gray-200 hover:border-red-200 transition-all duration-200 shadow-sm hover:shadow" title="Delete User"> <span class="material-symbols-outlined text-base">delete</span> </button> </form> </div> </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            No users found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
