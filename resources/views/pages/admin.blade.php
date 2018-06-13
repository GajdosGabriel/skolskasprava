
@extends('layouts.app')

@section('content')

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                @include('pages.moduls.admin-can-add-workers')
                @include('pages.moduls.info_admin')
                </div>

                <div class="col-md-6">
                    @include('pages.moduls.video_worker')
                </div>
            </div>
        </div>


    @endsection

