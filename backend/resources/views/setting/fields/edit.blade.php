@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Field</h1>
    <form action="{{ route('fields.update', $field->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('setting.fields.form', ['field' => $field])
        <button type="submit" class="btn btn-primary">Update Field</button>
        <a href="{{ route('fields.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection