@extends('layouts.app')

@section('content')

    @can('admin-edit')

    <div class="col-md-12">
        <div class="collapse" id="collapseExample">

            <h3>Pridať triedu</h3>

            <form action="{{ route('grades.store') }}" method="POST" class="form-inline"> {{ csrf_field() }}

                <div class="form-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text text-danger {{ $errors->has('name') ? ' has-error' : '' }}">Trieda</div>
                    </div>
                    <input type="text" name="name" class="form-control" placeholder="Označenie triedy" required>
                </div>

                @can('admin-edit')
                <div class="input-group">
                <div class="input-group-prepend">
                <div class="input-group-text">Triedny učiteľ</div>
                </div>
                <select required name="class_leader" class="form-control" id="exampleFormControlSelect1">
                <option  value="" selected disabled hidden>--Vybrať--</option>
                @forelse( $users as $user)
                <option value="{{ $user->id }}">{{ $user->full_name() }}</option>
                @empty
                @endforelse
                </select>
                </div>
                @endcan

                <div class="form-group">
                    <button class="btn btn-primary">Uložiť</button>
                </div>
            </form>
        </div>
    </div>
    @endcan

    <h2>Triedy

        @can('admin-edit')
        <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Pridať triedu
        </button>
        @endcan
    </h2>

    <table class="table">
        <thead>
        <tr class="bg-success">
            <td>Trieda</td>
            <td>Počet žiakov</td>
            <td>Triedny učiteľ</td>
        </tr>
        </thead>
        @forelse( $grades as $grade)
            <tr>
                <td><a href="{{ route('grades.edit', [$grade->id]) }}"><strong>{{ $grade->name }}</strong></a></td>
                <td><a href="{{ route('grades.show', [$grade->id]) }}"><strong>{{ $grade->students()->count() }}</strong></a></td>

                <td>{{ $grade->classleader->first_name or 'nepriradená'}} {{ $grade->classleader->first_name or ''}}</td>

            </tr>
        @empty
            <tbody><tr><td>Žiadna trieda</td></tr></tbody>
        @endforelse
    </table>




    @endsection


