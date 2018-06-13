@extends('layouts.app')

@section('content')

    <div class="col-md-6">

        <h3>Upraviť údaje <small>{{ $user->full_name() }}</small></h3>
        <form method="POST" action="{{ route('user.update', [$user->id, $user->slug]) }}" class="form">
        @csrf {{ csrf_field('PUT') }}

        @include('users.edit_form')

        </form>
    </div>

    @endsection

<script>
    function ConfirmDelete()
    {
        var x = confirm("Skutočne natrvalo odstrániť zamestnanca?");
        if (x)
            return true;
        else
            return false;
    }
</script>