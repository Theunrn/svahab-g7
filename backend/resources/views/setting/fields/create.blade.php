@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Field</h1>
    <form action="{{ route('fields.store') }}" method="POST">
        @csrf
        @include('setting.fields.form')
        <button type="submit" class="btn btn-primary">Add Field</button>
        <a href="{{ route('fields.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection