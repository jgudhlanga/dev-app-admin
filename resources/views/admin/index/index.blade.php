@extends('layouts.main.app-template')
<!-- Content Wrapper. Contains page content -->
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>{{trans('admin.c_panel')}}</h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('home') }}"><i class="fa fa-home"></i>{{trans('general.home')}}</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-sm-4">
        <a class="btn btn-primary btn-lg btn-block" href="{{ url('modules') }}">{{trans('admin.modules')}}</a>
      </div>
      <div class="col-sm-4">
        <a class="btn btn-primary btn-lg btn-block" href="{{ url('users') }}">{{trans('admin.users')}}</a>
      </div>
      <div class="col-sm-4">
        <a class="btn btn-primary btn-lg btn-block" href="{{ url('roles') }}">{{trans('admin.roles')}}</a>
      </div>
    </div>

  </section>
@endsection