@extends('layouts.app')

@section('content')

@include('moduls.errors')

<h2>Zoznam</h2>

<table class="table">
    <thead>
    <tr class="bg-success">
        <td>Por.</td>
        <td>Firma</td>
        <td>Meno</td>
        <td>Funkcia</td>
        <td>Triedny učiteľ</td>
        <td>Email</td>
        <td>Pozvánka</td>
        <td>Akcia</td>
    </tr>
    </thead>
    @forelse($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>

            <td>{{ $user->company }}</td>
            <td>{{ $user->full_name() }}</td>
            @forelse($user->roles as $role)
            <td>{{ $role->name }}</td>
            @empty
            <td>Rola nepridelená</td>
            @endforelse

            <td>{{ $user->email }}</td>


            <td>
            @forelse($user->grades as $grade)
            {{ $grade->name }}
            @empty
            Trieda nepridelená
            @endforelse
            </td>
            @can('admin-user')
            <td> @if($user->invitation) Odoslaná  @else <a Onclick="return SendInvitation()" href="{{ route('user.sendInvitation', [$user->id, $user->slug]) }}">Neodoslaná</a>@endIf</td>
            <td>
                <a Onclick="return ConfirmDelete()" href="{{ route('worker.destroy', [ $user->id, $user->slug ]) }}" onclick="get_form(this).submit(); return false">
                <i class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Vymazať položku"></i></a>
                <a href="{{ route('user.edit', [$user->id, $user->slug]) }}"><i class="fa fa-pencil" aria-hidden="true" title="Editovať položku"></i></a>
                @endcan
            </td>
        </tr>
    @empty
        <tbody><tr><td colspan="2">Bez zamestnancov</td></tr></tbody>
    @endforelse
</table>

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

    function SendInvitation()
    {
        var x = confirm("Poslať učiteľovi prihlasovací email?");
        if (x)
            return true;
        else
            return false;
    }
</script>