@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">
            @lang('cpanel.general') @choice('general.setting', 2)
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('cpanel') }}"><i class="fa fa-chevron-circle-left"></i>{{trans('cpanel.index')}}</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle collapsed" data-toggle="collapse"  data-parent="#accordion" href="#system">
                            @lang('general.system_wide')
                        </a>
                    </h4>
                </div>
                <div id="system" class="panel-collapse accordion-body collapse">
                    <div class="panel-body">
                        <div class="row">
                            @include('cpanel.general._partials.system-wide')
                        </div>
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
                        @include('cpanel.general._partials.personal')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection