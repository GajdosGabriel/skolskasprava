@extends('layouts.app')

@section('content')

    <div class='overlay'>
        <h2 style="color: silver" class="text-center mt-5">Krok 1/4</h2>
        @if($user->hasAnyRoles([2,3]))
       <h1 style="color: white" class="text-center mt-3 mb-3">Doplnte chýbajúce údaje.</h1>
        @else
        <h1 style="color: white" class="text-center mt-3 mb-3">Doplnte chýbajúce údaje, <br> aby zmluva s rodičmi bola platná</h1>
        @endif
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('user.update', [$user->id, $user->slug]) }}" class="form">
                    @csrf {{ csrf_field('PUT') }}
                        @include('users.edit_form')
                    </form>
                </div>
            </div>
        </div>

    </div>



@endsection
