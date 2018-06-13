<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>gdpr</title>

    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}

    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    {{--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">--}}
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <style>
        body { font-family: DejaVu Sans, sans-serif !important; }
    </style>

</head>
<body>

<h2>Súhlas zo spracovaním osobných údajov</h2>

<h5>Žiak: {{ $student->full_name() }} šk.r.2017/2018</h5>


<h6>Súhlas udelil rodič:
<strong>{{ $parent->full_name() }},</strong>
<span>{{ $parent->street }},</span>
<span>{{ $parent->city }},</span>
<span>{{ $parent->psc }}</span>
</h6>
<p>V súlade s § 11 zákona č. 122/2013 Z. z. o ochrane osobných údajov v platnom znení (ďalej len „zákon
    o OOÚ“) menovaná dotknutá osoba poskytuje <strong>{{ $owner->company }}</strong>, {{ $owner->street }}, {{ $owner->psc }},
    {{ $owner->city }}, ICO: {{ $owner->ico }} (ďalej „škole“) spracováva osobné údaje.

    Dotknutá osoba (zákonný zástupca) udeľuje prevádzkovateľovi dobrovoľný súhlas na spracovanie svojich osobných
    údajov v informačnom systéme s osobnými údajmi školy. </p>

<p>Za účelom uplatnenia práva na prístup k osobným údajom, ich opravu alebo výmazania či obmedzenia, alebo prenositeľnosti údajov,
    môžete vznieť námietky na adrese uvedelnej školy.
</p>

<strong>Súhlas k spracovaniu osobných údajov pre:</strong>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th>Súhlas</th>
        <th>
            @if($parent->confirmed)
            Dátum podpísania
                @else
            Vyjadriť súhlas
                @endif
        </th>
    </tr>
    </thead>
    <tbody>
    @if($parent->confirmed)
        @forelse($student->agreements as $agreement)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td><strong>{{ $agreement->title }}</strong></td>
                <td>Podpísaný: {{ date('d-m-Y', strtotime($agreement->pivot->created_at)) }}</td>
            </tr>
        @empty
            <tr><td>Rodič neposkytol žiadny súhlas</td></tr>
        @endforelse

        @else

        @forelse(\App\Agreement::all() as $agreement)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td><strong>{{ $agreement->title }}</strong></td>
                <td>
                    <div class="float-left" style="margin-right: 15px">
                    <img style="margin-right: 5px" class="img-fluid" src="{{ url('images/stvorec.png') }}">Áno
                    </div>

                    <div class="float-left">
                    <img style="margin-right: 5px" class="img-fluid" src="{{ url('images/stvorec.png') }}">Nie
                    </div>
                </td>
            </tr>
        @empty
            <tr><td>Žiadne požiadavky na súhlas</td></tr>
        @endforelse

    @endif
    </tbody>
</table>


<p>Dotknutá osoba prehlasuje, že dáva prevádzkovateľovi súhlas na spracovanie osobných údajov
    v rozsahu stanovenom zákona.
    Tento súhlas sa vzťahuje aj na neplnoleté dieťa/žiaka, by spracúval jeho osobné údaje v rozsahu zákona a nariadenie GDPR, na uvedený účely tomu poskytnué.

    Dotknutá osoba má právo kedykoľvek odvolať svoj súhlas odvolať alebo zmeniť.
    Zmena súhlasu nemá vplyv na spracúvanie pred jeho zmenou/zrušením písomne alebo prostredníctvom tohto systému.
</p>


@if($parent->confirmed)
    <p>Súhlas bol podpísaný elektronicky z IP adresy počítača</p>
    <p>Otlačok elektronický podpisu: <small> {{ bin2hex(random_bytes(46)) }} {{ bin2hex(random_bytes(46)) }} </small></p>
@else
    {{--<p> <strong>Dĺžka platnosti súhlasu: </strong>--}}
   {{--Školský rok 2017/2018 </p>--}}

    <p>
        {{--<input type="checkbox"> --}}
        <strong>Súhlasim s elektronickým udeľovaním súhlasu: </strong> Email rodiča: ..........................................
        </br> <small>Uvedením emailu budete môsť udeľovať/odvolávať všetky súhlasy požadované školou elektronicky.</small>
    </p>

    <p style="margin-top: 20px">Podpis rodiča: .....................................................

        <small>zákonný zástupca</small>
    </p>

@endif

</body>
</html>