@extends('layouts.main.app-template')
<!-- Content Wrapper. Contains page content -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="h1">
            {{trans('admin.menu_icons')}} {{trans('admin.settings')}}
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('common') }}">
                    <i class="fa fa-chevron-circle-left"></i>{{trans('admin.common')}}
                </a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-6 text-left"></div>
                    <div class="col-sm-6 text-right">

                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div id="table-responsive">
                        <table class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>@lang('icons.id')</th>
                                <th>@lang('icons.class')</th>
                                <th>@lang('icons.status')</th>
                                <th class="text-right">@lang('general.action')</th>
                            </tr>
                            </thead>
                            @if(count($classes) > 0)
                                @foreach($classes as $class)
                                    <tr>
                                        <td>{{$class->id}}</td>
                                        <td>{{$class->class}}</td>
                                        <td>{{$class->status->title}}</td>
                                        <td class="text-right">
                                            <button class="btn btn-info btn-sm" id="btnEdit"
                                                    onclick='return editClass("{{$class->id}}}")'>
                                                <i class="fa fa-edit"></i> {{trans('buttons.edit')}}
                                            </button>
											<?php
											$newStatus = ($class->status_id == $statusActive) ? $statusInActive : $statusActive;
											$btnClass = ($class->status_id == $statusActive) ? 'btn-warning' : 'btn-success';
											$toggleClass = ($class->status_id == $statusActive) ? 'fa fa-toggle-off' : 'fa fa-toggle-on';
											$toggleTitle = ($class->status_id == $statusActive) ? trans('buttons.deactivate') : trans('buttons.reactivate');
											?>
                                            <button class="btn {{$btnClass}} btn-sm"
                                                    onclick='return changeStatus("{{$class->id}}", "{{$newStatus}}")'>
                                                <i class="{{$toggleClass}}"></i> {{$toggleTitle}}
                                            </button>
                                            <button class="btn btn-danger btn-sm"
                                                    onclick='return deleteClass("{{$class->id}}}")'>
                                                <i class="fa fa-trash"></i> {{trans('buttons.delete')}}
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">
                                        <div class="text-danger text-center">{{trans('general.no_records_found')}}</div>
                                    </td>
                                </tr>
                            @endif
                            @include('admin.common._partials.forms.add-edit-icons')
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('admin.common.assets.js.icons-js')
    <!-- /.content -->
@endsection