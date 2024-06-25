<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Fields
    </h2>
  </x-slot>

  <div class="container mt-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <a href="{{ route('admin.fields.create') }}" class="btn btn-primary mb-3">Add Field</a>
    <div class="table-responsive">
      <table class="table table-hover table-bordered">
        <thead class="table-dark">
          <tr>
            <th scope="col">Field Name</th>
            <th scope="col">Location</th>
            <th scope="col">Type</th>
            <th scope="col">Size</th>
            <th scope="col">Players</th>
            <th scope="col">Lighting</th>
            <th scope="col">Actions</th>
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
            <td>{{ $field->lighting_availability ? 'Yes' : 'No' }}</td>
            <td>
              <a href="{{ route('admin.fields.edit', $field->id) }}" class="btn btn-primary btn-sm">Edit</a>
              <form action="{{ route('admin.fields.destroy', $field->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</x-app-layout>