
@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <div class="row">

            <div class="col-md-8">
                <div class="alert alert-success" role="alert">
                    <strong>Žiadosť o schválenie spracovania osobných údajov</strong>
                    <ul>
                        <li>Vedenie školy vás žiada, o súhlas na spracovanie osobých údajov, ktoré vyžaduje
                            nové nariadenia Európskej únie (GDPR).</li>
                        <li>Súhlas je dobrovoľný a môžete ho kedykoľkek zmeniť alebo odvolať.</li>
                        <li>Súhlas sa podpisuje elektronicky, prostredníctvom tohto
                            <a href="{{route('folks.show', [Auth::user()->id, Auth::user()->slug])}}"> formulára</a>,
                            kliknutím na príslušné tlačidko.</li>
                    </ul>
                    {{--<a href="{{route('folks.show', [Auth::user()->id, Auth::user()->slug])}}" class="btn btn-primary">Prejsť na formulár súhlasu</a>--}}
                </div>
            </div>

        </div>
    </div>



    @endsection

