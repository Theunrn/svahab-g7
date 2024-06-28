<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Field
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

        <form action="{{ route('admin.fields.update', $field->id) }}" method="POST" class="mt-4 bg-white p-6 rounded-lg shadow-lg max-w-200 mx-auto">
            @csrf
            @method('PUT')

            <div class="flex flex-col space-y-2 mb-4">
                <label for="name" class="text-gray-700 select-none font-medium">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $field->name) }}" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
            </div>

            <div class="flex flex-col space-y-2 mb-4">
                <label for="location" class="text-gray-700 select-none font-medium">Location</label>
                <input type="text" id="location" name="location" value="{{ old('location', $field->location) }}" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
            </div>

            <div class="flex flex-col space-y-2 mb-4">
                <label for="field_type" class="text-gray-700 select-none font-medium">Field Type</label>
                <input type="text" id="field_type" name="field_type" value="{{ old('field_type', $field->field_type) }}" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
            </div>

            <div class="flex flex-col space-y-2 mb-4">
                <label for="owner_id" class="text-gray-700 select-none font-medium">OwnerID</label>
                <input type="number" id="owner_id" name="owner_id" value="{{ old('owner_id', $field->owner_id) }}" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
            </div>

            <div class="flex flex-col space-y-2 mb-4">
                <label class="text-gray-700 select-none font-medium">Availability</label>
                <div class="flex items-center">
                    <div class="mr-4">
                        <input type="radio" id="availablity_yes" name="availablity" value="1" {{ old('availablity', $field->availablity) == 1 ? 'checked' : '' }} class="form-radio h-4 w-4 text-indigo-600">
                        <label for="availablity_yes" class="ml-2 text-sm font-medium text-gray-700">Yes</label>
                    </div>
                    <div>
                        <input type="radio" id="availablity_no" name="availablity" value="0" {{ old('availablity', $field->availablity) == 0 ? 'checked' : '' }} class="form-radio h-4 w-4 text-indigo-600">
                        <label for="availablity_no" class="ml-2 text-sm font-medium text-gray-700">No</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Save Changes
            </button>
        </form>
    </div>
</x-app-layout>