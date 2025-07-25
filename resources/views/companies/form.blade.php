
<x-app-layout>
<div class="max-w-xl mx-auto p-4">
    <h1 class="text-xl font-bold mb-4 dark:text-gray-100">{{ isset($company) ? 'Edit' : 'Add' }} Company</h1>
    <form method="POST" action="{{ isset($company) ? route('companies.update', $company) : route('companies.store') }}">
        @csrf
        @if(isset($company))
            @method('PUT')
        @endif

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium dark:text-gray-100" >Name</label>
            <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" value="{{ old('name', $company->name ?? '') }}" required>
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="industry" class="block text-sm font-medium dark:text-gray-100">Industry</label>
            <input type="text" name="industry" id="industry" class="w-full border rounded px-3 py-2" value="{{ old('industry', $company->industry ?? '') }}" required>
            @error('industry') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="address" class="block text-sm font-medium dark:text-gray-100">Address</label>
            <textarea name="address" id="address" class="w-full border rounded px-3 py-2" required>{{ old('address', $company->address ?? '') }}</textarea>
            @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center space-x-2">
            <button class="bg-blue-600 text-white px-4 py-2 rounded dark:text-gray-100">{{ isset($company) ? 'Update' : 'Create' }}</button>
            <a href="{{ route('companies.index') }}" class="text-gray-600 dark:text-gray-100">Cancel</a>
        </div>
    </form>
</div>
</x-app-layout>
