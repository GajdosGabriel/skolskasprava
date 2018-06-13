@extends('layouts.app')

@section('content')


    <h1>Messenger</h1>

    <div class="row">

        <div class="col-md-4">
            @include('messenger.list_of_users')
        </div>

        <div class="col-md-8">
            @forelse($usermessages as $message)
              <p><strong><a href="{{ route('messenger.show', [ $message->user->id, $message->user->slug ]) }}">{{ $message->user->last_name }}</a></strong> píše:  {{ $message->body }}</p>
            @empty
                Žiadna nová správa.
            @endforelse
        </div>

    </div>










@endsection

