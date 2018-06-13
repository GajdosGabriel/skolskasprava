@extends('layouts.app')

@section('content')

    @include('moduls.errors')

    <div class="row">
        <div class="col-md-6">

            <h3><small>žiak <strong>{{ $user->full_name() }}</strong></small> <span class="pull-right"> {{ $user->trieda->name or 'nepriradená' }}</span></h3>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text {{ $errors->has('first_name') ? ' has-error' : '' }}" id="meno">Meno</span>
                    </div>
                    <input disabled type="text" name="first_name" value="{{ $user->first_name }}" class="form-control" placeholder="Meno" aria-label="Meno" aria-describedby="meno">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text {{ $errors->has('last_name') ? ' has-error' : '' }}">Priezvisko</div>
                    </div>
                    <input disabled type="text" name="last_name" value="{{ $user->last_name }}"class="form-control" placeholder="Priezvisko">
                </div>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Trieda</div>
                    </div>
                    <input disabled type="text" name="last_name" value="{{ $user->trieda->name or 'nepriradená' }}"class="form-control" placeholder="Priezvisko">
                </div>

                <div class="modal-footer">
                    @if( empty(auth()->user()->grade->id) or $user->grade_id == auth()->user()->grade->id)
                        <a Onclick="return ConfirmDelete()" href="{{ route('students.destroy', [ $user->id, $user->slug ]) }}" onclick="get_form(this).submit(); return false">
                            <i @if(Auth::id() === $user->id) @else style="font-size: 118%; color: grey" @endif style="font-size: 118%; color: #b40000" class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Vymazať položku"></i></a>
                        <a href="{{ route('students.edit', [$user->id, $user->slug]) }}"><i class="fa fa-pencil" aria-hidden="true" title="Editovať položku"></i></a>
                    @endif
                </div>

        </div>

        {{--Info panel about parent--}}
        @if(isset($parent))
            <div class="col-md-6">
                <div class="d-flex justify-content-between align-items-center">
                <h3><small>rodič <strong>{{ $parent->full_name() }}</strong></small></h3>

                    <small><a href="{{ route('user.edit', [$parent->id, $parent->slug]) }}">upraviť</a></small>

                </div>


            <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text {{ $errors->has('first_name') ? ' has-error' : '' }}" id="meno">Meno</span>
            </div>
            <input disabled type="text" name="first_name" value="{{ $parent->first_name }}" class="form-control" placeholder="Meno" aria-label="Meno" aria-describedby="meno">
            </div>

            <div class="input-group mb-3">
            <div class="input-group-prepend">
            <div class="input-group-text {{ $errors->has('last_name') ? ' has-error' : '' }}">Priezvisko</div>
            </div>
            <input disabled type="text" name="last_name" value="{{ $parent->last_name }}"class="form-control" placeholder="Priezvisko">
            </div>

            <div class="input-group mb-3">
            <div class="input-group-prepend">
            <div class="input-group-text {{ $errors->has('street') ? ' has-error' : '' }}">Ulica a číslo</div>
            </div>
            <input disabled type="text" name="street" value="{{ $parent->street }}" class="form-control" placeholder="Ulica a číslo">
            </div>

            <div class="input-group mb-3">
            <div class="input-group-prepend">
            <div class="input-group-text {{ $errors->has('city') ? ' has-error' : '' }}">Mesto</div>
            </div>
            <input disabled type="text" name="city" value="{{ $parent->city }}" class="form-control" placeholder="Mesto">
            </div>

            <div class="input-group mb-3">
            <div class="input-group-prepend">
            <div class="input-group-text {{ $errors->has('psc') ? ' has-error' : '' }}">Psč</div>
            </div>
            <input disabled type="text" name="psc" value="{{ $parent->psc }}" class="form-control" placeholder="Psč">
            </div>

            @if(str_contains($parent->email, '@'))
            <div class="input-group mb-3">
            <div class="input-group-prepend">
            <div class="input-group-text {{ $errors->has('email') ? ' has-error' : '' }}">Email</div>
            </div>
            <input disabled type="email" name="email" value="{{ $parent->email }}" class="form-control" placeholder="Email..." required>
            </div>
            @else
            <div class="input-group mb-3">
            <div class="input-group-prepend">
            <div class="input-group-text {{ $errors->has('email') ? ' has-error' : '' }}">Email</div>
            </div>
            <input disabled type="email" name="email" class="form-control" placeholder="Email neuvedený">
                <div class="input-group-append" data-toggle="modal" data-target="#email{{ $parent->id }}" style="cursor: pointer">
                    <span class="input-group-text text-danger"><strong>Vložiť email</strong></span>
                </div>
            </div>
            @endif

            <div class="modal-footer">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-secondary">Späť</a>

                @if(!str_contains($parent->email, '@'))
                    <a class="btn btn-info" data-toggle="modal" data-target="#email{{ $parent->id }}">Pridať rodičovi email</a>
                    @include('students.modal-email-parent')
                @endif
            </div>

        </div>
       @else
            Rodič nie je priradený
       @endif
    </div>
@endsection



<script>
    function ConfirmDelete()
    {
        var x = confirm("Skutočne vymazať túto položku?");
        if (x)
            return true;
        else
            return false;
    }
</script>