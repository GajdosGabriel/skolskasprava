@extends('layouts.app')

@section('content')

    @include('parents.create-modal')
    <h2>Rodičia
        <button class="btn btn-default float-right" data-toggle="modal" data-target="#newParent">
            Pridať rodiča (zákonného zástupcu)
        </button>
    </h2>

    @include('moduls.errors')

    <table class="table">
        <thead>
        <tr class="bg-success">
            <td>Rodič</td>
            <td>žiaci</td>
            <td>Pridať</td>
            <td>Email</td>
            <td>Súhlas</td>
        </tr>
        </thead>
        @forelse( $users as $user)
            <tr>
                <td><a href="{{ route('user.edit', [$user->id, $user->slug]) }}">{{ $user->full_name() }}</a></td>
                <td>
                    @forelse($user->ParentListOfStudents($user->id) as $student)

                        {{ $student->full_name() }},

                        @empty
                        žiadny žiak
                    @endforelse

                </td>
{{--                <td>{{ $user->countStudents($user->id) }}</td>--}}
                <td>
                    <a  class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#{{ $user->id }}">
                        Pridať žiaka
                    </a>
                    @include('students.create-modal')
                </td>

                <td>
                    @if(str_contains($user->email, '@'))
                        Áno
                    @else
                        <span title="Rodič nemá uvedený email.">Nie</span>
                    @endif

                </td>

                <td>
                    <a href="{{ route('folks.show', [$user->id, $user->slug]) }}">
                        @if(str_contains($user->email, '@'))
                            Elektronicky
                            @else
                       <span title="Rodič nemá uvedený email. Nemožno žiadosť odoslať elektronicky.">tlačivo</span>
                            @endif
                    </a>
                </td>
            </tr>
        @empty
            <tbody><tr><td>Žiadný rodičia</td></tr></tbody>
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
</script>