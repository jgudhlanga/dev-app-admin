@extends('layouts.main.app-template')
<!-- Content Wrapper. Contains page content -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="h1">{{trans('modules.pages.view')}}</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('modules.show', [$page->module_id]) }}">
                    <i class="fa fa-chevron-circle-left"></i>
                    {{trans('modules.pages.heading')}}
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-8 col-xs-12">
                        <form id="editPageForm" role="form" data-toggle="validator">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            <input type="hidden" name="edit_id" id="edit_id"
                                   @isset($page->id) value="{{ $page->id }}" @endisset/>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h2 class="panel-title">{{trans('modules.pages.edit')}}</h2>
                                </div>
                                <div class="panel-body">

                                    @include('admin.modules._partials.forms.page-fields')

                                </div>
                                <div class="panel-footer text-center">
                                    <button type="submit" class="btn btn-success" id="btnUpdatePage">
                                        <i class="fa fa-save"></i>&nbsp;{{trans('buttons.update')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('admin.modules.assets.js.pages-js')
@endsection