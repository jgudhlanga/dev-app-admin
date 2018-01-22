@extends('layouts.main.app-template')
<!-- Content Wrapper. Contains page content -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="h1">{{trans('modules.view')}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('modules') }}"><i class="fa fa-chevron-circle-left"></i>{{trans('admin.modules')}}</a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-6 text-left"></div>
                    <div class="col-sm-6 text-right"></div>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-8 col-xs-12">
                        <form id="editModuleForm"  role="form" data-toggle="validator" method="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            <input type="hidden" name="edit_id" id="edit_id" value="{{ $module->id }}"/>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h2 class="panel-title">{{trans('modules.edit')}}</h2>
                                </div>
                                <div class="panel-body">

                                    @include('admin.modules._partials.forms.module-fields')

                                </div>
                                <div class="panel-footer text-center">
                                    <button class="btn btn-success btn-sm" type="submit">
                                        <i class="fa fa-save"></i>
                                        {{trans('buttons.update')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="caption-title-div">
                            <div class="caption-title">{{trans('modules.pages.heading')}}</div>
                        </div>
                        <div class="pull-right margin-bottom-5">
                            <button class="btn btn-primary">
                                {{trans('buttons.add_new')}}
                            </button>
                        </div>
                        <div id="tableGridLayout">
                            <table id="pagesMainTable" class="table table-striped table-bordered" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>@lang('modules.pages.position')</th>
                                    <th>@lang('modules.pages.title')</th>
                                    <th>@lang('modules.pages.description')</th>
                                    <th>@lang('modules.pages.icon')</th>
                                    <th>@lang('modules.pages.url')</th>
                                    <th>@lang('modules.pages.status')</th>
                                    <th>@lang('general.action')</th>
                                </tr>
                                </thead>

                                <tfoot>
                                <tr>
                                    <th>@lang('modules.pages.position')</th>
                                    <th>@lang('modules.pages.title')</th>
                                    <th>@lang('modules.pages.description')</th>
                                    <th>@lang('modules.pages.icon')</th>
                                    <th>@lang('modules.pages.url')</th>
                                    <th>@lang('modules.pages.status')</th>
                                    <th></th>
                                </tr>
                                </tfoot>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    @include('admin.modules.assets.js.modules-js')
@endsection