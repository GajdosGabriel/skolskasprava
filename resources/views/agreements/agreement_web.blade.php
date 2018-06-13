@extends('layouts.app')

@section('content')

<div class="row">

    <div style="border: 2px solid #a6a6a6; border-radius: 5px" class="col-md-8">

        <h3 class="text-center mt-3 mb-3"><strong>Súhlas zákonného zástupcu</strong></h3>
            <h5>Rodič: <strong>{{ $user->full_name() }}</strong>, {{ $user->street }}, {{ $user->city }}, {{ $user->psc }}</h5>

        <p>V súlade s § 11 zákona č. 122/2013 Z. z. o ochrane osobných údajov v platnom znení (ďalej len „zákon
        o OOÚ“) menovaná dotknutá osoba poskytuje <strong>{{ $owner->company }}</strong>, {{ $owner->street }}, {{ $owner->psc }},
        {{ $owner->city }}, ICO: {{ $owner->ico }} (ďalej „škole“) ako prevádzkovateľovi dobrovoľný súhlas na spracovanie svojich osobných
        údajov v informačnom systéme s osobnými údajmi školy.
        </p>

        <strong>Účelom spracovania je ochrana osobných údajov pre:</strong>

            <table class="table">
                <thead style="background: #d8d8d8">
                <tr>
                    <th scope="col">#</th>
                    <th>Súhlas šk.r. 2017/2018</th>
                    <th>Spracovanie osob. údajov</th>
                    <th>Zverejnenie mena na šk. nástenke</th>
                    <th>Zverejnenie na šk. webe</th>
                    <th>Vytlačiť/zobraziť</th>
                </tr>
                </thead>
                <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $student->full_name()  }}</strong></td>

                        @if($student->agreement(1) )
                            <td><a class="btn btn-primary btn-sm  @if(! Auth::user()->hasRole(3)) disabled @endif" href="{{ route('students.agreement', [$student->id,  1]) }}">ÁNO súhlasím</td>
                        @else
                            <td><a class="btn btn-outline-primary btn-sm  @if(! Auth::user()->hasRole(3)) disabled @endif" href="{{ route('students.agreement', [$student->id,  1]) }}">Udeliť súhlas</td>
                        @endif

                        @if($student->agreement(2) )
                            <td><a class="btn btn-primary btn-sm  @if(! Auth::user()->hasRole(3)) disabled @endif" href="{{ route('students.agreement', [$student->id,  2]) }}">ÁNO súhlasím</td>
                        @else
                            <td><a class="btn btn-outline-primary btn-sm  @if(! Auth::user()->hasRole(3)) disabled @endif" href="{{ route('students.agreement', [$student->id,  2]) }}">Udeliť súhlas</td>
                        @endif

                        @if($student->agreement(3) )
                            <td><a class="btn btn-primary btn-sm  @if(! Auth::user()->hasRole(3)) disabled @endif" href="{{ route('students.agreement', [$student->id,  3]) }}">ÁNO súhlasím</td>
                        @else
                            <td><a class="btn btn-outline-primary btn-sm  @if(! Auth::user()->hasRole(3)) disabled @endif" href="{{ route('students.agreement', [$student->id,  3]) }}">Udeliť súhlas</td>
                        @endif

                        <td><a target="_blank" href="{{ route('agreement.show', [$student->id, $student->slug] ) }}" class="btn btn-outline-primary btn-sm float-right">Zobraziť súhlas</td>
                    </tr>
                @empty
                    <tr><td colspan="3">Rodič neposkytol žiadny súhlas</td></tr>
                @endforelse
                </tbody>
            </table>



            <p>Týmto udeľujem súhlas podľa § 11 zákona č. 122/2013 Z.z. o ochrane osobných údajov a o
            zmene a doplnení niektorých zákonov so spracúvaním mojich osobných údajov.
            Dotknutá osoba dáva prevádzkovateľovi svoj súhlas, na spracovanie osobných údaje vo vyššie uvedenom rozsahu, na uvedený účel a počas vyššie uvedenej doby.

            Dotknutá osoba má právo svoj súhlas kedykoľvek odvolať alebo zmeniť.
            Odvolanie súhlasu nemá vplyv na zákonnosť spracúvania osobných údajov pred jeho odvolaním.
            </p>

            @if($user->confirmed)
                <p>Súhlas bol podpísaný elektronicky z IP adresy počítača</p>
                <p>Otlačok elektronický podpisu: <small> {{ bin2hex(random_bytes(46)) }} {{ bin2hex(random_bytes(46)) }} </small></p>
            @else

                <p><input type="checkbox"> <strong>Súhlasim s elektronickým udeľovaním súhlasu: </strong> Email rodiča: ..............................................................
                    </br> <small>Uvedením emailu budete môsť udeľovať/odvolávať všetky súhlasy požadované školou elektronicky.</small>
                </p>
                <p style="margin-top: 80px">Podpis rodiča: .............................................................................
                    </br>
                    <small>zákonný zástupca</small></p>

            @endif
    </div>


    <div class="col-md-4">

        <div class="alert alert-success" role="alert">
            <strong>Na formuláry vidíte tri tlačidlá</strong>
            <ul>
                <li>Ak súhlasite s pracovaním osobných údajov, kliknite na tlačidlo "Udeliť súhlas".</li>
                <li>Ak súhlasite s zverejnením mena na nástenke, kliknite na tlačidlo "Udeliť súhlas".</li>
                <li>Ak súhlasite s zverejnením mena alebo fotografie na školskej webovej stránke, kliknite na tlačidlo "Udeliť súhlas".</li>
            </ul>
            <strong>Opätovným kliknutím na tlačidlo súhlas zrušíte.
            {{--<a href="{{route('folks.show', [Auth::user()->id, Auth::user()->slug])}}" class="btn btn-primary">Prejsť na formulár súhlasu</a>--}}
        </div>

        @if(auth()->user()->isSuperAdmin())
        @include('messenger.parent-modul')
        @endif

    </div>

</div>


@endsection