@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Settings</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Key</th>
                <th>Value</th>
                <th>Email Address</th>
                <th>Responsible</th>
                <th>Email Notifications</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($settings as $setting)
            <tr>
                <td>{{ $setting->key }}</td>
                <td>{{ $setting->value }}</td>
                <td>{{ $setting->email_address }}</td>
                <td>{{ $setting->responsible }}</td>
                <td>{{ $setting->email_notifications ? 'Enabled' : 'Disabled' }}</td>
                <td>
                    <a href="{{ route('settings.edit', $setting->id) }}" class="btn btn-primary">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection