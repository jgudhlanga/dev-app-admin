@extends('layouts.main.app-template')
<!-- Content Wrapper. Contains page content -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="h1">
            {{trans('admin.status')}} {{trans('admin.settings')}}
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
                    <div class="table-responsive" id="tblStatuses">
                        <table class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>@lang('status.id')</th>
                                <th>@lang('status.title')</th>
                                <th>@lang('status.description')</th>
                                <th class="text-right" width="150">@lang('general.action')</th>
                            </tr>
                            </thead>
                            @if(count($statuses) > 0)
                                @foreach($statuses as $status)
                                    <tr>
                                        <td>{{$status->id}}</td>
                                        <td>{{$status->title}}</td>
                                        <td>{{$status->description}}</td>
                                        <td class="text-right">
                                            <button class="btn btn-info btn-sm" id="btnEdit"
                                                    onclick='return editStatus("{{$status->id}}}")'>
                                                <i class="fa fa-edit"></i> {{trans('buttons.edit')}}
                                            </button>
                                            <button class="btn btn-danger btn-sm"
                                                    onclick='return deleteStatus("{{$status->id}}}")'>
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
                            @include('admin.common._partials.forms.add-edit-status')
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('admin.common.assets.js.status-js')
    <!-- /.content -->
@endsection