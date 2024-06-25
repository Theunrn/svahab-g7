<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Field
        </h2>
    </x-slot>

    <div class="container mt-4">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.fields.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="field_name">Field Name</label>
                <input type="text" class="form-control" id="field_name" name="field_name" value="{{ old('field_name') }}" required>
            </div>
            <div class="form-group">
                <label for="field_location">Field Location</label>
                <input type="text" class="form-control" id="field_location" name="field_location" value="{{ old('field_location') }}" required>
            </div>
            <div class="form-group">
                <label for="field_type">Field Type</label>
                <input type="text" class="form-control" id="field_type" name="field_type" value="{{ old('field_type') }}" required>
            </div>
            <div class="form-group">
                <label for="field_size">Field Size</label>
                <input type="number" class="form-control" id="field_size" name="field_size" value="{{ old('field_size') }}" required>
            </div>
            <div class="form-group">
                <label for="number_of_players">Number of Players</label>
                <input type="number" class="form-control" id="number_of_players" name="number_of_players" value="{{ old('number_of_players') }}" required>
            </div>
            <div class="form-group">
                <label for="lighting_availability">Lighting Availability</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="lighting_availability" id="lighting_yes" value="1" {{ old('lighting_availability') == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="lighting_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="lighting_availability" id="lighting_no" value="0" {{ old('lighting_availability') == 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="lighting_no">No</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</x-app-layout>