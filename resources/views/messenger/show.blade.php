@extends('layouts.app')

@section('content')


    <h1>Messenger</h1>

    <div class="row">

    <div class="col-md-4">
       @include('messenger.list_of_users')
    </div>


    <div class="col-md-6">

        <form method="POST" action="{{ route('messenger.store', [$requested_user->id]) }}">
            @csrf
            <div class=" row col-auto mb-3">
                <label class="sr-only" for="inlineFormInputGroup">Správa</label>
                <div class="input-group mb-2">
                    <input type="text" name="body" class="form-control" id="inlineFormInputGroup" required placeholder="Správa...">
                    <div class="input-group-prepend">
                        <button class="btn btn-primary" id="btn-chat">Poslať</button>
                    </div>
                </div>
            </div>
        </form>


        <div id="messages">


        @forelse( $questions as $question)

                {{--Odpovede administrátora--}}
            @if($question->user_id == auth()->user()->id)
                    <div class="row msg_container base_receive">
                        <div style="background: silver; font-size: 150%; padding: .7rem; margin-left: .7rem; border-radius: 50%;height: 50px" class="avatar">
                            <div style="margin-top: -4px">{{ $question->user->firstLettersName() }}</div>
                            {{--<img src="{{asset('image/administrator.jpg')}}" class=" img-responsive ">--}}
                        </div>
                        <div class="col-xs-10 col-md-10">
                            <div style="background: rgba(46, 46, 60, 0.82); color:#d1d1d1; padding: 8px; font-size: 14px;margin-bottom: 10px; border-radius:6px; ">
                                <p>
                                    <small><strong>{{ auth()->user()->full_name() }}</strong> píše:</small>
                                    <span class="pull-right">{{ $question->format_created_at }} </span><br>
                                    {{ $question->body }}
                                </p>
                            </div>
                        </div>
                    </div>
                @else

                    {{--Otázky usera--}}
                    <div class="row">
                        <div class="col-xs-10 col-md-10">
                            <div style="background: rgba(166, 166, 255, 0.82); color:black; padding: 8px; font-size: 14px;margin-bottom: 10px; border-radius:6px; ">
                                <p><strong> {{ $question->owner->first_name }}</strong> píše: <span class="pull-right" style="color:silver;font-style: italic">{{  $question->format_created_at }}</span> <br>
                                {{ $question->body }}</p>
                            </div>
                        </div>
                        <div style="background: silver; font-size: 150%; padding: .7rem; margin-left: .7rem; border-radius: 50%;height: 50px" class="avatar">
                            <div style="margin-top: -4px">{{ $question->user->firstLettersName() }}</div>
                            {{--<img src="{{asset('image/administrator.jpg')}}" class=" img-responsive ">--}}
                        </div>
                    </div>
                @endif
            @empty
                Nemáte žiadnu správu.
            @endforelse

        </div>
    </div>
    </div>



<script>
    (function() {
        var box = document.getElementById('messages');
        box.scrollTop = box.scrollHeight;
    })()
</script>








@endsection

