@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">
            @choice('countries.title', 2) @choice('general.setting', 2)
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
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addCountryModal">
                        <i class="fa fa-plus-circle"></i> {{ trans('buttons.add_new') }}
                    </button>
                </div>
                <div id="tableGridLayout">
                    <table id="countriesMainTable" class="table table-striped table-bordered" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th>@lang('countries.name')</th>
                            <th>@lang('countries.capital')</th>
                            <th>@lang('countries.citizenship')</th>
                            <th>@lang('countries.country_code')</th>
                            <th>@lang('countries.calling_code')</th>
                            <th>@lang('countries.currency')</th>
                            <th>@lang('countries.currency_symbol')</th>
                            <th>@lang('countries.iso_3166_2')</th>
                            <th>@lang('countries.iso_3166_3')</th>
                            <th>@lang('countries.flag')</th>
                            <th>@lang('countries.status')</th>
                            <th>@lang('general.action')</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>@lang('countries.name')</th>
                            <th>@lang('countries.capital')</th>
                            <th>@lang('countries.citizenship')</th>
                            <th>@lang('countries.country_code')</th>
                            <th>@lang('countries.calling_code')</th>
                            <th>@lang('countries.currency')</th>
                            <th>@lang('countries.currency_symbol')</th>
                            <th>@lang('countries.iso_3166_2')</th>
                            <th>@lang('countries.iso_3166_3')</th>
                            <th>@lang('countries.flag')</th>
                            <th>@lang('countries.status')</th>
                            <th></th>
                        </tr>
                        </tfoot>

                    </table>
                </div>

            </div>
        </div>
    </section>
    @include('cpanel.general._partials.modals.add-county')
    @include('cpanel.general._partials.modals.edit-country')
    @include('cpanel.general.assets.js.countries-js')
@endsection