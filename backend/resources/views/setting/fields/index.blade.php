<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Fields
    </h2>
  </x-slot>

  <div class="container">
    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    <a href="{{ route('admin.fields.create') }}" class="btn btn-primary mb-3">Add Field</a>
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
            <a href="{{ route('admin.fields.edit', $field->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('admin.fields.destroy', $field->id) }}" method="POST" style="display:inline-block;">
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
</x-app-layout>