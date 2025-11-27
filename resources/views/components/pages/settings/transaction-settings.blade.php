<x-layouts.app title="System maintenance">
    <div class="flex justify-center items-start md:items-center w-full">
        <div class="w-full bg-black/20 p-4 m-4 md:m-0 md:p-10 md:mr-10 rounded-3xl min-h-[84vh]">
            <x-partials.admin-header title="Transaction Limits" />
                <div class="w-full h-100 flex justify-center items-start md:items-center">
                    <form action="{{ route('admin.updateTransLimit') }}" method="POST" class="p-4 bg-cyan-100 rounded-xl shadow w-full max-w-xl">
                        @csrf
                        @if(session('success'))
                            <div class="mb-4 p-3 rounded bg-teal-100 text-teal-700 border border-teal-300">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mb-4 p-3 rounded bg-red-100 text-red-700 border border-red-300">
                                {{ session('error') }}
                            </div>
                        @endif

                        {{-- Validation errors --}}
                        @if ($errors->any())
                            <div class="mb-4 p-3 rounded bg-red-100 text-red-700 border border-red-300">
                                <ul class="list-disc ml-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <span class="block text-gray-700 mb-2">
                            The current point limit of the user is: {{ $TransLimit['limit'] }}
                        </span>

                        <label for="limit" class="block text-teal-700 font-semibold mb-1">
                            Change User Limit
                        </label>

                        <input 
                            type="number" 
                            id="limit" 
                            name="limit"
                            placeholder="Enter new limit"
                            required
                            class="w-full p-2 border border-teal-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                        >

                        <button 
                            type="submit"
                            class="mt-3 w-full bg-teal-600 text-white py-2 rounded-lg hover:bg-teal-700 transition cursor-pointer">
                            Update Limit
                        </button>
                    </form>
                </div>
            </div>
        </x-layouts.app>

