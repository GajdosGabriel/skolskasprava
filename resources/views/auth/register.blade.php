@extends('layouts.app')

@section('content')

    <div class='overlay'>
        <h1 style="color: white" class="text-center mb-5 mt-5">Najprv sa zaregistrujte</h1>


        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('auth.register_form')
                </div>
            </div>
        </div>

    </div>



@endsection
