@extends('admin.layouts.app')
@section('title', 'Support')
@section('content')
    @push('styles')
        <style>
            .message-container {
                margin: 20px auto;
                max-width: 800px;
            }

            .user-message,
            .admin-message {
                padding: 10px;
                border-radius: 8px;
                max-width: 60%;
                margin-bottom: 1rem;
                word-wrap: break-word;
            }

            .user-message {
                background-color: rgb(169, 240, 5);
                color: black;
                margin-right: auto;

            }

            .admin-message {
                background-color: #fff;
                color: black;
                border: 1px solid #ddd;
                margin-left: auto;

            }

            .reply-form {
                margin-top: 20px;
                clear: both;
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

    <div class="container">
        <div class="message-container">
            <h2 class="text-center mb-4">{{ $token->title }}</h2>
            @foreach ($messages as $message)
                @if ($message->user->role === 'user')
                    <div class="user-message">
                        <p><strong>{{ $message->user->name }}</strong></p>

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
            @endforeach
        </div>

        <!-- Admin Reply Form -->
        <form class="reply-form" method="POST" action="{{ route('admin.support.store', $token->id) }}">
            @csrf
            {{-- <div class="mb-3">
                <input type="text" name="title" placeholder="Enter the title" >
                @if ($errors->has('title'))
                <p class="text-danger mt-2">{{ $errors->first('title') }}</p>
            @endif
            </div> --}}
            <textarea name="msg_text" placeholder="Type your reply here..."></textarea>
            @if ($errors->has('msg_text'))
                <p class="text-danger mt-2">{{ $errors->first('msg_text') }}</p>
            @endif
            <button type="submit" class="btn btn-primary">Send Reply</button>
        </form>
    </div>
@endsection
