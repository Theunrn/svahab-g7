@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $field->field_name }}</h1>
    <p><strong>Location:</strong> {{ $field->field_location }}</p>
    <p><strong>Type:</strong> {{ $field->field_type }}</p>
    <p><strong>Size:</strong> {{ $field->field_size }}</p>
    <p><strong>Number of Players:</strong> {{ $field->number_of_players }}</p>
    <p><strong>Lighting Availability:</strong> {{ $field->lighting_availability }}</p>
    <a href="{{ route('fields.edit', $field->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('fields.destroy', $field->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <a href="{{ route('fields.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection