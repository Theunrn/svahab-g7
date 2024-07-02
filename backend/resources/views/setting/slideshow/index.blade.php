<x-app-layout>
    @extends('layouts.app')

    @section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Slide Show Images</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($images as $image)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="{{ asset('storage/' . $image->image) }}" alt="Image" class="w-full h-auto">
                <div class="p-4">
                    <p class="text-gray-700">{{ $image->image }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endsection

</x-app-layout>