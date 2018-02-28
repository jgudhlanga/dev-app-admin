@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">
            @choice('permissions.title', 2) @choice('general.setting', 2)
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('cpanel') }}">
                    <i class="fa fa-chevron-circle-left"></i>{{trans('cpanel.c_panel')}}
                </a>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="pull-right margin-bottom-5 margin-left-5">
                    <a class="btn btn-primary" href="{!! url('cpanel/security/permissions/create') !!}">
                        <i class="fa fa-plus-circle"></i> {{ trans('buttons.add_new') }}
                    </a>
                </div>
                <div id="tableGridLayout">
                    <table id="permissionsMainTable" class="table table-striped table-bordered" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th>@lang('permissions.name')</th>
                            <th>@lang('permissions.display_name')</th>
                            <th>@lang('permissions.description')</th>
                            <th>@lang('general.status')</th>
                            <th>@lang('general.action')</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>@lang('permissions.name')</th>
                            <th>@lang('permissions.display_name')</th>
                            <th>@lang('permissions.description')</th>
                            <th>@lang('general.status')</th>
                            <th></th>
                        </tr>
                        </tfoot>

                    </table>
                </div>

            </div>
        </div>
    </section>
    @include('cpanel.security.assets.js.permissions-js')
    @include('cpanel.security._partials.modals.edit-permission')
@endsection