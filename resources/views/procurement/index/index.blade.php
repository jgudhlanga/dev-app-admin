@extends('layouts.main.app-template')
<!-- Content Wrapper. Contains page content -->
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1 class="h1">{{trans('procurement.dashboard')}}</h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('home') }}"><i class="fa fa-home"></i>{{trans('general.home')}}</a></li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

    <div class="row">

    </div>

  </section>
@endsection