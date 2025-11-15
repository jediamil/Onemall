@props(['users' => []])
<div class="overflow-x-auto rounded-lg shadow-sm">
    <table class="min-w-full bg-cyan-100 rounded-lg overflow-hidden border border-gray-200">
        <thead class="bg-linear-to-r from-teal-500 to-teal-600 text-white">
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
            @foreach ($users as $uid => $user)
                <tr class="hover:bg-teal-50 transition-colors duration-150 ease-in-out">
                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $user['vendor_name'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $user['email'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800">
                            {{ $user['role'] }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $user['food_stall'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $user['created_at'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center space-x-3">
                            <button class="p-2 rounded-lg hover:bg-teal-100 text-teal-600 hover:text-teal-700 transition-colors" title="Edit">
                                <span class="material-symbols-outlined text-lg">edit_document</span>
                            </button>
                            <button class="p-2 rounded-lg hover:bg-teal-100 text-teal-600 hover:text-teal-700 transition-colors" title="Manage">
                                <span class="material-symbols-outlined text-lg">manage_accounts</span>
                            </button>
                            <button class="p-2 rounded-lg hover:bg-red-100 text-red-500 hover:text-red-600 transition-colors" title="Delete">
                                <span class="material-symbols-outlined text-lg">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>