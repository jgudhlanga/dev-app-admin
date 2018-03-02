@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">{{trans('cpanel.c_panel')}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}">
                    <i class="fa fa-home"></i>{{trans('general.home')}}</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle collapsed" data-toggle="collapse"  data-parent="#accordion" href="#advanced">
                            @lang('general.advanced')&nbsp;|&nbsp;
                            @lang('cpanel.security')&nbsp;
                            @choice('general.setting', 2)
                        </a>
                    </h4>
                </div>
                <div id="advanced" class="panel-collapse accordion-body collapse">
                    <div class="panel-body">
                        @include('cpanel._partials.advanced')
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#personal">
                            @lang('general.personal_related')
                        </a>
                    </h4>
                </div>
                <div id="personal" class="panel-collapse accordion-body collapse">
                    <div class="panel-body">
                        @include('cpanel._partials.personal')
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle collapsed" data-toggle="collapse"  data-parent="#accordion" href="#other">
                            @lang('general.other')
                        </a>
                    </h4>
                </div>
                <div id="other" class="panel-collapse accordion-body collapse">
                    <div class="panel-body">
                        @include('cpanel._partials.other')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection