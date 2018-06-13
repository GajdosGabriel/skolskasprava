
@extends('layouts.app')

@section('content')


    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">

            </div>

            <div class="col-md-6">
                @include('pages.moduls.info_admin')
                @include('pages.moduls.video_worker')
            </div>
        </div>
    </div>


    @endsection

