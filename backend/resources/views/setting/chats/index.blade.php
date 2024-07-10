<x-app-layout>
    <div>
        <h1>Chat Room</h1>
        <form action="{{ route('admin.chats.store') }}" method="POST">
            @csrf
            <input type="text" name="message" placeholder="Type your message..." required>
            <button type="submit">Send</button>
        </form>

        <div class="chat-messages">
            <div>
                <strong>:</strong> 
                <span></span>
            </div>
        </div>
        {{-- <div class="chat-messages">
            @foreach ($chats as $chat)
                <div>
                    <strong>{{ $chat->user->name }}:</strong> {{ $chat->message }}
                    <span>{{ $chat->created_at->diffForHumans() }}</span>
                </div>
            @endforeach
        </div> --}}

    </div>
</x-app-layout>
