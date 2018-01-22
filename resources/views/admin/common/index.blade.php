@extends('layouts.main.app-template')
<!-- Content Wrapper. Contains page content -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="h1">
            {{trans('admin.common_settings')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="fa fa-chevron-circle-left"></i>{{trans('admin.index')}}</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-sm-3">
                <a class="btn btn-info btn-lg btn-block" href="{{ url('common/status') }}">{{trans('admin.status')}}</a>
            </div>
            <div class="col-sm-3">
                <a class="btn btn-info btn-lg btn-block" href="{{ url('common/icons') }}">{{trans('admin.menu_icons')}}</a>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection