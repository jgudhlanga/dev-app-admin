@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">
            @lang('cpanel.general') @choice('general.setting', 2)
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('cpanel') }}"><i class="fa fa-chevron-circle-left"></i>{{trans('cpanel.index')}}</a></li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-sm-2">
                <a class="btn btn-info btn-sm btn-block text-bold text-light" href="{{ url('cpanel/general/status') }}">
                    {{trans('cpanel.status')}}
                    &nbsp;<span class="badge">{{$statusCount}}</span>
                </a>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-info btn-sm btn-block text-bold text-light" href="{{ url('cpanel/general/icons') }}">
                    {{trans('cpanel.menu_icons')}}
                    &nbsp;<span class="badge">{{$iconCount}}</span>
                </a>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-info btn-sm btn-block text-bold text-light" href="{{ url('cpanel/general/titles') }}">
                   @choice('titles.title', 2)
                    &nbsp;<span class="badge">{{$titleCount}}</span>
                </a>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-info btn-sm btn-block text-bold text-light" href="{{ url('cpanel/general/marital-statuses') }}">
                    @choice('marital-status.title', 2)
                    &nbsp;<span class="badge">{{$maritalStatusCount}}</span>
                </a>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-info btn-sm btn-block text-bold text-light" href="{{ url('cpanel/general/gender') }}">
                    @lang('gender.gender')
                    &nbsp;<span class="badge">{{$genderCount}}</span>
                </a>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-info btn-sm btn-block text-bold text-light" href="{{ url('cpanel/general/occupations') }}">
                    @choice('general.occupations.heading', 2)
                    &nbsp;<span class="badge">{{$occupationCount}}</span>
                </a>
            </div>
        </div>
    </section>
@endsection