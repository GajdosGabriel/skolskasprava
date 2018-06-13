@extends('layouts.app')

@section('content')

@include('moduls.errors')

<h2>Učitelia
    @can('admin-edit')
    <button class="btn btn-default float-right" type="button"  data-toggle="modal" data-target="#workerStore">
        Pridať zamestnanca
    </button>
    @include('workers.create-modal')
    @endcan
</h2>

<table class="table">
    <thead>
    <tr class="bg-success">
        <td>Por.</td>
        <td>Meno</td>
        <td>Funkcia</td>
        <td>Triedny učiteľ</td>
        @can('admin-edit')
        <td>Email</td>
        <td>Pozvánka</td>
        @endcan
    </tr>
    </thead>
    @forelse($users as $user)
        <tr>
            <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
            <td>
                <a href="{{ route('user.edit', [$user->id, $user->slug]) }}">
                    {{ $user->full_name() }}
                </a>
            </td>
            @forelse($user->roles as $role)
                <td>{{ $role->name }}</td>
            @empty
                <td>Rola nepridelená</td>
            @endforelse

            <td>
            {{ $user->grade->name or 'neuvedený' }}
            </td>

            @can('admin-edit')
            <td>{{ $user->email }}</td>
            @endcan

            @can('admin-edit')
            <td title="Pozvánka na prihlásenie už bola odoslaná."> @if($user->invitation) Odoslaná  @else <a Onclick="return SendInvitation()" href="{{ route('user.sendInvitation', [$user->id, $user->slug]) }}" title="Poslať pozzvánku aby sa pracovník mohol prihlásiť.">Neodoslaná</a>@endIf</td>
            @endcan
        </tr>
    @empty
        <tbody><tr><td colspan="2">Bez zamestnancov</td></tr></tbody>
    @endforelse
</table>

{{ $users->links('partials.simple') }}
    @endsection

<script>


    function SendInvitation()
    {
        var x = confirm("Poslať učiteľovi prihlasovací email?");
        if (x)
            return true;
        else
            return false;
    }
</script>