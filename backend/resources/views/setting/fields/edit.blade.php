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
            <input type="text" class="form-control" id="field_name" name="field_name" value="{{ $field->field_name }}" required>
        </div>
        <div class="form-group">
            <label for="field_location">Location</label>
            <input type="text" class="form-control" id="field_location" name="field_location" value="{{ $field->field_location }}" required>
        </div>
        <div class="form-group">
            <label for="field_type">Type</label>
            <input type="text" class="form-control" id="field_type" name="field_type" value="{{ $field->field_type }}" required>
        </div>
        <div class="form-group">
            <label for="field_size">Size</label>
            <input type="text" class="form-control" id="field_size" name="field_size" value="{{ $field->field_size }}" required>
        </div>
        <div class="form-group">
            <label for="number_of_players">Number of Players</label>
            <input type="number" class="form-control" id="number_of_players" name="number_of_players" value="{{ $field->number_of_players }}" required>
        </div>
        <div class="form-group">
            <label for="lighting_availability">Lighting Availability</label>
            <select class="form-control" id="lighting_availability" name="lighting_availability" required>
                <option value="1" {{ $field->lighting_availability ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$field->lighting_availability ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Field</button>
    </form>
</div>
@endsection