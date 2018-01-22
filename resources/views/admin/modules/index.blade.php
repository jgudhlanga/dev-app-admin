@extends('layouts.main.app-template')
<!-- Content Wrapper. Contains page content -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="h1">{{trans('modules.module_list')}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="fa fa-chevron-circle-left"></i>{{trans('admin.index')}}</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-6 text-left"></div>
                    <div class="col-sm-6 text-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addModuleModal">
                            <i class="fa fa-plus-circle"></i> {{ trans('buttons.add_new') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div id="tableGridLayout">
                        <table id="modulesMainTable" class="table table-striped table-bordered" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>@lang('modules.position')</th>
                                <th>@lang('modules.title')</th>
                                <th>@lang('modules.description')</th>
                                <th>@lang('modules.icon')</th>
                                <th>@lang('modules.url')</th>
                                <th>@lang('modules.status')</th>
                                <th>@lang('general.action')</th>
                            </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <th>@lang('modules.position')</th>
                                <th>@lang('modules.title')</th>
                                <th>@lang('modules.description')</th>
                                <th>@lang('modules.icon')</th>
                                <th>@lang('modules.url')</th>
                                <th>@lang('modules.status')</th>
                                <th></th>
                            </tr>
                            </tfoot>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>
    @include('admin.modules._partials.modals.add')
    @include('admin.modules.assets.js.modules-js')
@endsection