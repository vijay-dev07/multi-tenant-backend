<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto p-4">
            <h1 class="text-xl font-bold mb-4 dark:text-gray-100">Your Companies</h1>

            @if(session('success'))
                <div class="bg-green-100 p-2 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('companies.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Add Company
                </a>
                @if($companies->count())
                    <form action="{{ route('switch.company') }}" method="POST" class="flex items-center space-x-2">
                        @csrf
                        <label for="company_id" class="text-white">Switch Active Company:</label>
                        <select name="company_id" onchange="this.form.submit()" class="ml-2 px-2 py-1 rounded">
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ optional(auth()->user()->active_company)->id == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                @endif
            </div>  
            
            <table class="table-auto w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="px-4 py-2 w-1/4">Name</th>
                    <th class="px-4 py-2 w-1/4">Industry</th>
                    <th class="px-4 py-2 w-1/3">Address</th>
                    <th class="px-4 py-2 w-1/6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($companies as $company)
                    <tr class="border-t border-gray-300">
                        <td class="px-4 py-2 dark:text-gray-100">{{ $company->name }}</td>
                        <td class="px-4 py-2 dark:text-gray-100">{{ $company->industry }}</td>
                        <td class="px-4 py-2 dark:text-gray-100">{{ $company->address }}</td>
                        <td class="px-4 py-2 text-center space-x-2">
                            <a href="{{ route('companies.edit', $company) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('companies.destroy', $company) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center text-gray-500">No companies found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $companies->links() }}
        </div>
    </div>
</x-app-layout>
