@extends('layouts.main.app-template')
<!-- Content Wrapper. Contains page content -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="h1">{{trans('modules.view')}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('modules') }}"><i class="fa fa-chevron-circle-left"></i>{{trans('cpanel.modules')}}</a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <form id="editModuleForm" role="form" data-toggle="validator" method="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <input type="hidden" name="edit_id" id="edit_id"
                           @isset($module->id) value="{{ $module->id }}" @endisset/>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">{{trans('modules.edit')}}</h2>
                        </div>
                        <div class="panel-body">

                            @include('cpanel.modules._partials.forms.module-fields')

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
            @include('cpanel.modules.pages')
        </div>
    </section>
    @include('cpanel.modules._partials.modals.add-page')
    @include('cpanel.modules.assets.js.modules-js')
    @include('cpanel.modules.assets.js.pages-js')
@endsection