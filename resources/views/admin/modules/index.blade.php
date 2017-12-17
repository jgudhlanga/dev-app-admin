
@extends('layouts.main.app-template')
<!-- Content Wrapper. Contains page content -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{trans('modules.module_list')}}</h1>
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
                        <button class="btn btn-info" data-toggle="modal" data-target="#addEditModuleModal">
                           <i class="fa fa-plus-circle"></i> {{ trans('buttons.add_new') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="box-body">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div id="tableGridLayout">
                                <table id="modulesMainTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>@lang('modules.id')</th>
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
                                        <th>@lang('modules.id')</th>
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
                    {{--<div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($modules)}} of {{count($modules)}} entries</div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                {{ $modules->links() }}
                            </div>
                        </div>
                    </div>
                </div>--}}
            </div>
        </div>
    </section>
    @include('admin.modules._partials.modals.add-edit')
    @include('admin.modules.assets.js.modules-js')
@endsection