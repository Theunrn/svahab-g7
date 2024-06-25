@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Field</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.fields.update', $field->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="field_name">Field Name</label>
            <input type="text" class="form-control" id="field_name" name="field_name" value="{{ old('field_name', $field->field_name) }}" required>
        </div>
        <div class="form-group">
            <label for="field_location">Location</label>
            <input type="text" class="form-control" id="field_location" name="field_location" value="{{ old('field_location', $field->field_location) }}" required>
        </div>
        <div class="form-group">
            <label for="field_type">Type</label>
            <input type="text" class="form-control" id="field_type" name="field_type" value="{{ old('field_type', $field->field_type) }}" required>
        </div>
        <div class="form-group">
            <label for="field_size">Size</label>
            <input type="number" class="form-control" id="field_size" name="field_size" value="{{ old('field_size', $field->field_size) }}" required>
        </div>
        <div class="form-group">
            <label for="number_of_players">Number of Players</label>
            <input type="number" class="form-control" id="number_of_players" name="number_of_players" value="{{ old('number_of_players', $field->number_of_players) }}" required>
        </div>
        <div class="form-group">
            <label for="lighting_availability">Lighting Availability</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="lighting_availability" name="lighting_availability" value="1" {{ old('lighting_availability', $field->lighting_availability) ? 'checked' : '' }}>
                <label class="form-check-label" for="lighting_availability">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="lighting_availability" name="lighting_availability" value="0" {{ !old('lighting_availability', $field->lighting_availability) ? 'checked' : '' }}>
                <label class="form-check-label" for="lighting_availability">No</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Field</button>
    </form>
</div>
@endsection