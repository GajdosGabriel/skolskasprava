@extends('layouts.app')

@section('content')
    <div class='overlay'>
        <h2 style="color: silver" class="text-center mt-5">Krok 2/4</h2>
        @include('moduls.errors')
        <h1 style="color: white" class="text-center mb-3 mt-3">Pridajte názov vašej triedy</h1>
        <p class="text-center" style="color: silver">Trieda môže mať rôzne označenie napr. I.A, III.B alebo 7.C a pod. <br>
            Budete triedny učiteľ, ktorej názov teraz napíšete. <br>
            Získate právo pridávať žiakov a rodičov aby mohol vytlačiť súhlas.
        </p>

        <div class="container">
            <div class="row justify-content-center mt-5">
                {{--<div class="col-md-8">--}}

                <form action="{{ route('grades.store') }}" method="POST" class="form-inline"> {{ csrf_field() }}

                    <div class="form-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text text-danger {{ $errors->has('name') ? ' has-error' : '' }}">Trieda</div>
                        </div>
                        <input type="text" name="name" class="form-control" placeholder="Označenie triedy" required>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary">Uložiť</button>
                    </div>
                </form>

                {{--</div>--}}
            </div>


            {{--Tu sa mali zobraziť triedy, ktoré už škola má založené.--}}
            <div style="color: silver" class="row justify-content-center mt-5">
                <h4>
                    @include('grades.grades_list')
                </h4>
            </div>

        </div>

    </div>



@endsection
