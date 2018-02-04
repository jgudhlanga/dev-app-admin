@extends('layouts.main.app-template')
<!-- Content Wrapper. Contains page content -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="h1">{{trans('cpanel.c_panel')}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}"><i class="fa fa-home"></i>{{trans('general.home')}}</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-sm-3">
                <a class="btn btn-info btn-lg btn-block text-bold text-light" href="{{ url('modules') }}">
                    {{trans('cpanel.modules')}}&nbsp;&nbsp;
                    <span class="badge">{{ $moduleCount }}</span>
                </a>
            </div>
        </div>

    </section>
@endsection