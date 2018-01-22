@extends('layouts.main.app-template')
<!-- Content Wrapper. Contains page content -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="h1">{{trans('admin.c_panel')}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}"><i class="fa fa-home"></i>{{trans('general.home')}}</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-sm-3">
                <a class="btn btn-info btn-lg btn-block" href="{{ url('modules') }}">
                    {{trans('admin.modules')}}&nbsp;&nbsp;
                    <span class="badge">{{ @count($modules) }}</span>
                </a>
            </div>
            <div class="col-sm-3">
                <a class="btn btn-info btn-lg btn-block" href="{{ url('roles') }}">{{trans('admin.security')}}</a>
            </div>
            <div class="col-sm-3">
                <a class="btn btn-info btn-lg btn-block" href="{{ url('common') }}">{{trans('admin.common_settings')}}</a>
            </div>
        </div>

    </section>
@endsection