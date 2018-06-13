@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
        @include('moduls.errors')
        <h3>Žiak <small>{{ $user->full_name() }}</small></h3>
        <form method="POST" action="{{ route('students.update', [$user->id, $user->slug]) }}" class="form">
            @csrf {{ csrf_field('PUT') }}

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text {{ $errors->has('first_name') ? ' has-error' : '' }}" id="meno">Meno</span>
                </div>
                <input required type="text" name="first_name" value="{{ $user->first_name }}" class="form-control" placeholder="Meno" aria-label="Meno" aria-describedby="meno">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text {{ $errors->has('last_name') ? ' has-error' : '' }}">Priezvisko</div>
                </div>
                <input required type="text" name="last_name" value="{{ $user->last_name }}"class="form-control" placeholder="Priezvisko">
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text text-danger">Trieda</div>
                </div>
                <select name="grade_id" class="form-control" required id="exampleFormControlSelect1">
                    <option value="" selected disabled hidden>--Vybrať--</option>
                    @forelse( $grades as $grade)
                        <option value="{{ $grade->id }}"
                        @if($grade->id == $user->grade_id) selected @endif

                        >{{ $grade->name }}</option>
                    @empty
                    @endforelse
                </select>
            </div>

            <div class="modal-footer">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-secondary">Späť</a>
                <button class="btn btn-primary">Uložiť</button>
            </div>

        </form>

    </div>
    </div>
    @endsection