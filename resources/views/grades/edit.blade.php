@extends('layouts.app')

@section('content')

    <div class="col-md-6">
        <form method="post" action="{{ route('grades.update', [$grade->id]) }}" class="form"> {{ csrf_field('PUT') }}
            @csrf

                <h4 class="mb-4">Upraviť triedu <strong>{{ $grade->name }}</strong></h4>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text text-danger {{ $errors->has('name') ? ' has-error' : '' }}" id="meno">Trieda</span>
                        </div>
                        <input type="text" name="name" value="{{ $grade->name }}" class="form-control" placeholder="Trieda" aria-label="meno" aria-describedby="meno" required>
                    </div>

            @can('admin-edit')
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Triedny učiteľ</div>
                        </div>
                        <select name="class_leader" class="form-control" id="exampleFormControlSelect1">
                            <option value="" selected disabled hidden>--Vybrať--</option>
                            @forelse( $users as $user)
                                <option value="{{ $user->id }}"
                                    @if($user->id == $grade->class_leader)
                                    selected
                                    @endif
                                >{{ $user->full_name() }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                @endcan


            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text text-danger {{ $errors->has('description') ? ' has-error' : '' }}" id="meno">Popis triedy</span>
                </div>
                <textarea name="description" rows="6" class="form-control" >{{ $grade->description ?? 'Popis triedy ... (profil triedy bude viditeľný pre rodičov)' }} </textarea>
            </div>


            <div>
                @if($grade->class_leader == auth()->user()->id or auth()->user()->hasRole(1))
                    <a Onclick="return ConfirmDelete()" href="{{ route('grades.destroy', [ Auth::user()->id, Auth::user()->slug, $grade->id ]) }}" onclick="get_form(this).submit(); return false">
                    zmazať
                    </a>

                @endif
                <button class="btn btn-primary float-right">Uložiť</button>
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-secondary mr-3 float-right">Späť</a>
            </div>
        </form>
        </div>
    </div>
@endsection

<script>
    function ConfirmDelete()
    {
        var x = confirm("Skutočne vymazať túto triedu?");
        if (x)
            return true;
        else
            return false;
    }

</script>