@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Fields</h1>
  @if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif
  <a href="{{ route('fields.create') }}" class="btn btn-primary mb-3">Add Field</a>
  <table class="table">
    <thead>
      <tr>
        <th>Field Name</th>
        <th>Location</th>
        <th>Type</th>
        <th>Size</th>
        <th>Players</th>
        <th>Lighting</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($fields as $field)
      <tr>
        <td>{{ $field->field_name }}</td>
        <td>{{ $field->field_location }}</td>
        <td>{{ $field->field_type }}</td>
        <td>{{ $field->field_size }}</td>
        <td>{{ $field->number_of_players }}</td>
        <td>{{ $field->lighting_availability }}</td>
        <td>
          <a href="{{ route('fields.show', $field->id) }}" class="btn btn-info">View</a>
          <a href="{{ route('fields.edit', $field->id) }}" class="btn btn-warning">Edit</a>
          <form action="{{ route('fields.destroy', $field->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
