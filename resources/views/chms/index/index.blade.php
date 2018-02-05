@extends('layouts.main.app-template')

@section('content')

    <section class="content-header">
        <h1 class="h1">{{trans('chms.dashboard')}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}"><i class="fa fa-home"></i>{{trans('general.home')}}</a></li>
        </ol>
    </section>

    <section class="content">

        <div class="row">

        </div>

    </section>
@endsection