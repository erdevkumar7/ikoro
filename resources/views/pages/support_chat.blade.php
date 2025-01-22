<x-guest-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/content.css') }}">
        <style>
            .message-container {
                display: flex;
                margin-bottom: 1rem;
            }

            .user-message {
                background-color: rgb(169, 240, 5);
                color: black;
                padding: 10px;
                border-radius: 8px;
                /* max-width: 60%;
                margin-left: auto; */
            }

            .admin-message {
                background-color: #fff;
                color: black;
                padding: 10px;
                border-radius: 8px;
                max-width: 60%;
                margin-right: auto;
                border: 1px solid #ddd;
            }

            .reply-form {
                margin-top: 20px;
            }

            .reply-form textarea {
                width: 100%;
                resize: none;
                height: 100px;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 8px;
                margin-bottom: 10px;
            }
        </style>
    @endpush

    <div class="container py-5">
        <h2 class="text-center mb-4">{{ $token->title }}</h2>
        <div class="messages">
            @foreach ($messages as $message)
                <div class="message-container">
                    @if ($message->user->role === 'user')
                        <div class="user-message">
                            <h4>{{ $message->msg_text }}</h4>
                            <small>{{ $message->created_at->format('d M Y, h:i A') }}</small>
                        </div>
                    @elseif ($message->user->role === 'admin')
                        <div class="admin-message">
                            <p><strong>{{ $message->user->name }}</strong></p>
                            <h4>{{ $message->msg_text }}</h4>
                            <small>{{ $message->created_at->format('d M Y, h:i A') }}</small>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- User Reply Form -->
        <form class="reply-form" method="POST" action="{{ route('user.reply', $token->id) }}">
            @csrf
            <textarea name="msg_text" placeholder="Type your message here..." style="border-radius: 30px; margin-top:30px;"></textarea>
            @if ($errors->has('msg_text'))
                <p class="text-danger mt-2">{{ $errors->first('msg_text') }}</p>
            @endif
            <button type="submit" class="btn">Send Reply</button>
            <a class="btn" href="{{ route('user.close_chat',$token->id) }}">Close Chat</a>
        </form>
    </div>
</x-guest-layout>
