@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">@choice('users.user', 2) @choice('general.list', 1)</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('users/dashboard') }}"><i class="fa fa-dashboard"></i>{{trans('general.dashboard')}}</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="pull-right margin-bottom-5 margin-left-5">
                    <a class="btn btn-primary" href="{{url('users/create')}}">
                        <i class="fa fa-plus-circle"></i> {{ trans('buttons.add_new') }}
                    </a>
                </div>
                <div id="tableGridLayout">
                    <table id="usersMainTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>@lang('general.people.title')</th>
                            <th>@lang('general.people.first_name')</th>
                            <th>@lang('general.people.last_name')</th>
                            <th>@lang('general.email')</th>
                            <th>@lang('general.people.cell_number')</th>
                            <th>@lang('general.people.gender')</th>
                            <th>@lang('general.status')</th>
                            <th>@lang('general.action')</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>@lang('general.people.title')</th>
                            <th>@lang('general.people.first_name')</th>
                            <th>@lang('general.people.last_name')</th>
                            <th>@lang('general.email')</th>
                            <th>@lang('general.people.cell_number')</th>
                            <th>@lang('general.people.gender')</th>
                            <th>@lang('general.status')</th>
                            <th></th>
                        </tr>
                        </tfoot>

                    </table>
                </div>

            </div>
        </div>
    </section>
    @include('users.assets.users-js')
@endsection