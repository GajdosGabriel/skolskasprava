@extends('layouts.app')

@section('content')

    <div class='overlay'>

        {{--Pridanie rodiča a žiaka prvy krát--}}
        @if(auth()->user()->haveTutorial('create-student'))
            <h2 style="color: silver" class="text-center mt-5">Krok 3/4</h2>

            <h1 style="color: white" class="text-center  mt-3">Pridajte študenta</h1>

            <p class="text-center" style="color: silver">

            </p>

            {{--Triedny učiteľ pridáva žiaka --}}
        @else
            <h2 style="color: white" class="text-center mt-5">Pridajte žiaka do {{ auth()->user()->grade->name }}</h2>

            <p class="text-center" style="color: silver">Žiak bude pridáný do vašej triedy.</p>
        @endif


        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">

                    <form action="{{ route('students.store') }}" method="POST" class="form"> {{ csrf_field() }}

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Pridať študenta</h5>
                                <a href="{{ redirect()->getUrlGenerator()->previous() }}">
                                    <span aria-hidden="true">&times;</span>
                                </a>
                            </div>

                            <div class="modal-body">

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-danger {{ $errors->has('first_name') ? ' has-error' : '' }}" id="meno">Meno</span>
                                    </div>
                                    <input type="text" name="first_name" class="form-control" placeholder="Meno študenta" aria-label="Meno" aria-describedby="meno" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-danger {{ $errors->has('last_name') ? ' has-error' : '' }}">Priezvisko</div>
                                    </div>
                                    <input type="text" name="last_name" class="form-control" placeholder="Priezvisko študenta" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-danger {{ $errors->has('street') ? ' has-error' : '' }}">Ulica a číslo</div>
                                    </div>
                                    <input type="text" name="street" class="form-control" placeholder="Ulica a číslo" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-danger {{ $errors->has('city') ? ' has-error' : '' }}">Mesto</div>
                                    </div>
                                    <input type="text" name="city" class="form-control" placeholder="Mesto" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-danger {{ $errors->has('psc') ? ' has-error' : '' }}">Psč</div>
                                    </div>
                                    <input type="text" name="psc" class="form-control" placeholder="Psč" required>
                                </div>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-danger">Trieda</div>
                                    </div>
                                    <select name="grade_id" class="form-control" required id="exampleFormControlSelect1">
                                        <option value="" selected disabled hidden>--Vybrať--</option>
                                        @forelse( $grades as $grade)
                                            <option
                                                    @if(auth()->user()->grade->id == $grade->id) selected @endif
                                            value="{{ $grade->id }}">{{ $grade->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer ">
                                <div class="form-group form-check my-auto">
                                    <input name="add_parent" type="checkbox" class="form-check-input" checked id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Pridať aj rodiča</label>
                                </div>

                                <a href="{{ redirect()->getUrlGenerator()->previous() }}"  class="btn btn-secondary">Zrušiť</a>
                                <button class="btn btn-primary">Uložiť</button>
                            </div>

                    </form>


                </div>
            </div>
        </div>

    </div>



@endsection
