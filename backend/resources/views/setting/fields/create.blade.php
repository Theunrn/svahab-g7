<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Field
        </h2>
    </x-slot>

    <div class="container mt-4">
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.fields.store') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-4">
                <label for="field_name" class="block text-lg font-medium text-gray-800">Field Name</label>
                <input type="text" id="field_name" name="field_name" value="{{ old('field_name') }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-4">
            </div>
            <div class="mb-4">
                <label for="field_location" class="block text-lg font-medium text-gray-800 mb-1">Field Location</label>
                <input type="text" id="field_location" name="field_location" value="{{ old('field_location') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-4">
            </div>
            <div class="mb-4">
                <label for="surface_type" class="block text-lg font-medium text-gray-800 mb-1">Surface Type</label>
                <input type="text" id="surface_type" name="surface_type" value="{{ old('surface_type') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-4">
            </div>
            <div class="mb-4">
                <label for="dimensions" class="block text-lg font-medium text-gray-800 mb-1">Dimensions</label>
                <input type="text" id="dimensions" name="dimensions" value="{{ old('dimensions') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-4">
            </div>
            <div class="mb-4">
                <label for="capacity" class="block text-lg font-medium text-gray-800 mb-1">Capacity</label>
                <input type="number" id="capacity" name="capacity" value="{{ old('capacity') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-4">
            </div>
            <div class="mb-4">
                <label class="block text-lg font-medium text-gray-800 mb-1">Lighting Availability</label>
                <div class="flex items-center">
                    <div class="mr-4">
                        <input type="radio" id="availablity_yes" name="availablity" value="1" {{ old('availablity') == 1 ? 'checked' : '' }} class="form-radio h-4 w-4 text-indigo-600">
                        <label for="availablity_yes" class="ml-1 block text-sm font-medium text-gray-700">Yes</label>
                    </div>
                    <div>
                        <input type="radio" id="availablity_no" name="availablity" value="0" {{ old('availablity') == 0 ? 'checked' : '' }} class="form-radio h-4 w-4 text-indigo-600">
                        <label for="availablity_no" class="ml-1 block text-sm font-medium text-gray-700">No</label>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label for="home_team" class="block text-lg font-medium text-gray-800 mb-1">Home Team</label>
                <input type="text" id="home_team" name="home_team" value="{{ old('home_team') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-4">
            </div>
            <button type="submit" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Submit
            </button>
        </form>
    </div>
</x-app-layout>