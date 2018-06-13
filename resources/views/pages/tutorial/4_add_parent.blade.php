@extends('layouts.app')

@section('content')

    <div class='overlay'>

        {{--Pridanie rodiča a žiaka prvy krát--}}
        @if(auth()->user()->haveTutorial('create-parent'))
        <h2 style="color: silver" class="text-center mt-5">Krok 4/4</h2>

        <h1 style="color: white" class="text-center mt-3">Pridajte rodiča</h1>
        <p class="text-center" style="color: silver">
            Posledný krok. Ak ste vyplnili žiakové údaje, teraz stačí doplniť len meno rodiča. <br>
            Ostatné údaje sa prevzali automaticky.
        </p>

            {{--Triedny učiteľ pridáva žiaka --}}
        @else
            <h2 style="color: white" class="text-center mt-5">Pridajte rodiča</h2>

            <p class="text-center" style="color: silver">Teraz pridáme rodiča ku žiakovi.</p>
            @endif

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('moduls.errors')
                    <form method="POST" action="{{ route('parents.store') }}" class="form-inline">
                        @csrf

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Pridať rodiča k žiakovi
                                    <strong>{{ $user->full_name() }}</strong>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-danger {{ $errors->has('first_name') ? ' has-error' : '' }}" id="meno">Meno</span>
                                    </div>
                                    <input type="text" name="first_name" class="form-control" placeholder="Meno žiaka" aria-label="Meno" aria-describedby="meno" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-danger {{ $errors->has('last_name') ? ' has-error' : '' }}">Priezvisko</div>
                                    </div>
                                    <input value="{{ $user->last_name }}" type="text" name="last_name" class="form-control" placeholder="Priezvisko rodiča" required>
                                </div>

                                {{--<div class="input-group mb-3">--}}
                                {{--<div class="input-group-prepend">--}}
                                {{--<div class="input-group-text {{ $errors->has('email') ? ' has-error' : '' }}">Email</div>--}}
                                {{--</div>--}}
                                {{--<input type="email" name="email" class="form-control" placeholder="Email na zaslanie potvrdenia" required>--}}
                                {{--</div>--}}

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text {{ $errors->has('street') ? ' has-error' : '' }}">Ulica a číslo</div>
                                    </div>
                                    <input value="{{ $user->street }}" type="text" name="street" class="form-control" placeholder="Ulica a číslo">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text {{ $errors->has('city') ? ' has-error' : '' }}">Mesto</div>
                                    </div>
                                    <input value="{{ $user->city }}" type="text" name="city" class="form-control" placeholder="Mesto">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text {{ $errors->has('psc') ? ' has-error' : '' }}">Psč</div>
                                    </div>
                                    <input value="{{ $user->psc }}" type="text" name="psc" class="form-control" placeholder="Psč">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text {{ $errors->has('email') ? ' has-error' : '' }}">Email</div>
                                    </div>
                                    <input type="email" name="email" class="form-control" placeholder="Email na zaslanie potvrdenia">
                                </div>

                            </div>
                            <div class="modal-footer">

                                <div class="form-check">
                                    {{--@if(str_contains($user->email, '@'))--}}
                                    {{--<input class="form-check-input" name="send_notify_parent" type="checkbox" value="true" id="defaultCheck1">--}}
                                    {{--<label class="form-check-label" for="defaultCheck1">--}}
                                    {{--Poslať rodičom požiadavku na schváleni. </label>--}}
                                    {{--@else--}}
                                    {{--<input disabled title="" class="form-check-input" name="send_notify_parent" type="checkbox" value="true" id="defaultCheck1">--}}
                                    {{--<label class="form-check-label" for="defaultCheck1">--}}
                                    {{--Súhlas nemôžno odoslať elektronicky, pretože rodič nemá zadaný email. <small> Súhlas je možné vytlačiť a podpísať.</small></label>--}}
                                    {{--@endif--}}
                                </div>

                                <button class="btn btn-primary">Uložiť</button>
                                {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Zrušiť</button>--}}
                            </div>
                    </form>


                </div>
            </div>
        </div>

    </div>



@endsection
