@extends('layouts.app')

@section('content')

@include('grades.grades_list')

@include('moduls.errors')

    @if(empty($grade->name))
        <h2>Všetci žiaci
            <div class="btn-group pull-right" role="group" aria-label="Basic example">
                <a href="{{ route('tutorial.addStudent') }}"
                @if(! isset(auth()->user()->grade->id))
                   class="btn btn-outline-dark pull-right disabled"
                @else
                   class="btn btn-outline-dark pull-right"
                @endif
                >
                    Pridať žiaka
                </a>

                <div class="dropdown show">
                    <a  class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Rodičia
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#newParent">Nový rodič</a>
                        <a class="dropdown-item" href="{{ route('folks.index') }}">Všetci rodičia</a>
                    </div>
                </div>
            </div>
        </h2>
    @else
        <h2>Žiaci {{ $grade->name }}
            <div class="btn-group pull-right" role="group" aria-label="Basic example">
                <a href="{{ route('tutorial.addStudent') }}" class="btn btn-outline-dark pull-right" >
                Pridať žiaka
                </a>

                <div class="dropdown show">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Rodičia
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#newParent">Nový rodič</a>
                        <a class="dropdown-item" href="{{ route('folks.index') }}">Všetci rodičia</a>
                    </div>
                </div>
            </div>
            @include('parents.create-modal')
        </h2>
    @endif


    @include('parents.create-modal')


    <table class="table">
        <thead>
        <tr class="bg-success">
            <td>Por.</td>
            <td>Meno žiaka</td>
            <th>Trieda</th>
            <th>Školský rok</th>
            <th>Spracovanie osob. údajov</th>
            <th>Zverejnenie na šk. nástenke</th>
            <th>Zverejnenie na šk. webe</th>
            <td>Dokument</td>
            <td>Žiadosť rodičovi</td>
        </tr>
        </thead>
        @forelse( $users as $user)
            <tr>
                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>

                <td><a href="{{ route('students.show', [$user->id, $user->slug]) }}">{{ $user->first_name }}&nbsp;{{ $user->last_name }}</a></td>

                <td>{{ $user->trieda->name or 'nepriradená'}}</td>
                <td><a href="{{ route('folks.show', [$user->parent_id, $user->slug]) }}">2017/2018</a></td>

                @if($user->agreement(1) )
                    <td><a class="btn btn-primary btn-sm  @if(! Auth::user()->hasRole(3)) disabled @endif" href="{{ route('students.agreement', [$user->id,  1]) }}">ÁNO súhlasím</td>
                @else
                    <td><a class="btn btn-outline-primary btn-sm  @if(! Auth::user()->hasRole(3)) disabled @endif" href="{{ route('students.agreement', [$user->id,  1]) }}">Udeliť súhlas</td>
                @endif

                @if($user->agreement(2) )
                    <td><a class="btn btn-primary btn-sm  @if(! Auth::user()->hasRole(3)) disabled @endif" href="{{ route('students.agreement', [$user->id,  2]) }}">ÁNO súhlasím</td>
                @else
                    <td><a class="btn btn-outline-primary btn-sm  @if(! Auth::user()->hasRole(3)) disabled @endif" href="{{ route('students.agreement', [$user->id,  2]) }}">Udeliť súhlas</td>
                @endif

                @if($user->agreement(3) )
                    <td><a class="btn btn-primary btn-sm  @if(! Auth::user()->hasRole(3)) disabled @endif" href="{{ route('students.agreement', [$user->id,  3]) }}">ÁNO súhlasím</td>
                @else
                    <td><a class="btn btn-outline-primary btn-sm  @if(! Auth::user()->hasRole(3)) disabled @endif" href="{{ route('students.agreement', [$user->id,  3]) }}">Udeliť súhlas</td>
                @endif

                <td>
                    <a @if($user->parent_id) target="_blank" href="{{ route('agreement.show', [$user->id, $user->slug] ) }}" @endif
                             class="btn btn-success btn-sm float-right">Zobraziť súhlas</a>
                </td>


                @if(!$user->parent_id)
                    <td><span data-toggle="modal" data-target="#{{ $user->id }}" class="text-danger" style="cursor: pointer">Priradiť rodiča</span>
                        @include('students.modal-add-parent')
                    </td>
                @else
                    <td> @if($user->HasParentEmail($user->parent_id))
                             @if($user->invitation)
                                <span title="Žiadosť bola odoslaná.">Odoslaná</span>
                            @else
                                <a Onclick="return SendInvitation()" href="{{ route('user.sendParentInvitation', [$user->id, $user->slug]) }}">Neodoslaná</a>
                            @endif
                        @else
                            <a href="{{ route('students.show', [$user->id, $user->slug]) }}">
                                <span title="Žiadosť pre rodiča môžete vytlačiť, alebo v editácií doplniť email rodiča." style="cursor: pointer">Rodič nemá email</span>
                            </a>
                        @endIf</td>
                    {{--<td> @if($user->invitation) Odoslaná @else <a Onclick="return SendInvitation()" href="{{ route('user.sendParentInvitation', [$user->id, $user->slug]) }}">Neodoslaná</a>@endIf</td>--}}
                @endif
            </tr>
        @empty
            <tr><td colspan="3">Žiaci nie sú zadaný.</td></tr>
        @endforelse
    </table>

{{ $users->links('partials.simple') }}
    @endsection

<script>

//    $(function(){
//        $('[data-toggle="tooltip"]').tooltip();
//
//    });



    function SendInvitation()
    {
        var x = confirm("Poslať rodičovi žiadosť o súhlas?");
        if (x)
            return true;
        else
            return false;
    }
</script>