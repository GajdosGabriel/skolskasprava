
@extends('layouts.app')

@section('content')

    @guest

    <div class="col-md-12">
        <div class="row">

            <div class="col-md-6">

                <div class="card border border-primary mb-3">
                    <div class="card-body">
                        <h2 class="text-danger text-center"><strong>Vytvorte si elektronicky súhlas, <br>pomocou tohto webu.</strong></h2>
                        <ul>
                            <li><h4>Súhlas o spracovaní osobných údajov žiakov</h4></li>
                            <li><h4>Súhlas o zverejnení na školskej nástenke</h4></li>
                            <li><h4>Súhlas o zverejnení na webovej stránke školy</h4></li>
                            <li><h4>GDPR zmenilo nástenky v triedach, na vešanie fotiek a vyvolávanie mien treba súhlas</h4></li>
                        </ul>
                    </div>
                </div>


                <div class="card border border-primary mb-3">
                    <div class="card-body">
                        <strong>Súhlas k spracovaniu osobných údajov</strong>
                        <img class=" rounded float-left mr-4" style="width: 100px"  src="{{ url('images/gabriel.jpg') }}" alt="Card image cap">
                        <ul>
                            <li>K spracovaniu osobných údajov vyplývajúcich zo zákonov (z ktorého vyplýva aj oprávnený
                                záujem, plnenie právnych záväzkov, plnenie zmluvy, verejný záujem) je nevyhnutný súhlas osoby, o ktorej osobnej
                                údaje se jedná. Súhlas musí byť poučenený, informovaný a konkrétny, najlepšie v písomnej forme. súhlas
                                sa získavajú iba pre konkrétne údaje (určené napr. podľa druhu), na konkrétnu dobu a pre konkrétne účely.</li>
                            <li> Súhlas sa získava na spracovanie osobných údajov len vtedy, ak je ich spracovanie nevyhnutne
                                nevyhnutné a právne predpisy iné.</li>
                            <li> Súhlas sa poskytuje podľa účelu napr. na celú dobu školskej výchovy na školách, na školský rok, na
                                čas školy v prírode apod. Udelený súhlas môže byť v súladu s právnymi predpismi odvolany.</li>
                            <li> Niektoré povinnosti školy, jeho zamestnancov, prípadne iných osôb pri nakladaní s osobnými údajmi.</li>
                            <li>Každý zamestnanec školy je povinný zabezpečiť, aby sa neohrozil ochrana osobných údajov
                                spracovávaných školou.</li>
                        </ul>
                    </div>

                </div>

            </div>

            @include('moduls.video_admin')


        </div>
        <h3 class="text-center mt-3 mb-3"><strong>Vzor súhlasu ktorý si vytovríte v aplikácii</strong></h3>
        <img class="img-fluid" src="{{ url('images/suhlas_example.png') }}">
    </div>

    @endguest


    @auth
    @if(Auth::user()->hasRole(1))
        <div class="col-md-12">
            <div class="row">
                @include('moduls.owner_info')
                @include('moduls.video_admin')
            </div>
        </div>
    @endif
    @endauth



    @endsection

