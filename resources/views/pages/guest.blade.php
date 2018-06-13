
@extends('layouts.app')

@section('content')



    <div class="col-md-12">
        <div class="row">

            <div class="col-md-4">
                {{--@include('auth.register_form')--}}
                @include('pages.moduls.intro')
                @include('pages.moduls.info_panel_woman')
                @include('pages.moduls.info_panel_man')


            </div>

            <div class="col-md-8">

                <h3 class="text-center mb-3"><strong>Vzor súhlasu rodiča ktorý si vytvoríte v aplikácii</strong></h3>
                <img class="img-fluid mb-4" src="{{ url('images/suhlas_example.png') }}">

                @include('pages.moduls.video_geust')

            </div>




        </div>

    </div>






    @endsection

