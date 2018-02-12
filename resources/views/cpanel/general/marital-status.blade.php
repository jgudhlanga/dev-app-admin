@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">
            @choice('marital-status.title', 2) @choice('general.setting', 2)
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
        <div class="pull-right margin-bottom-5 margin-left-5">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addMaritalStatusModal">
                <i class="fa fa-plus-circle"></i> {{ trans('buttons.add_new') }}
            </button>
        </div>
        <table class="table table-striped" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>@lang('marital-status.name')</th>
                <th>@lang('marital-status.description')</th>
                <th>@lang('general.status')</th>
                <th class="text-right">@lang('general.action')</th>
            </tr>
            </thead>
            @if(count($maritalStatuses) > 0)
                @foreach($maritalStatuses as $maritalStatus)
                    <tr>
                        <td>{{$maritalStatus->name}}</td>
                        <td>{{$maritalStatus->description}}</td>
                        <td>{{$maritalStatus->status->title}}</td>
                        <td class="text-right">
                            <button class="btn btn-info btn-xs" id="btnEdit"
                                    onclick='return editMaritalStatus("{{$maritalStatus->id}}}")'>
                                <i class="fa fa-edit"></i> {{trans('buttons.edit')}}
                            </button>
							<?php
							$newStatus = ($maritalStatus->status_id == $statusActive) ? $statusInActive : $statusActive;
							$btnClass = ($maritalStatus->status_id == $statusActive) ? 'btn-warning' : 'btn-success';
							$toggleClass = ($maritalStatus->status_id == $statusActive) ? 'fa fa-toggle-off' : 'fa fa-toggle-on';
							$toggleTitle = ($maritalStatus->status_id == $statusActive) ? trans('buttons.deactivate') : trans('buttons.reactivate');
							?>
                            <button class="btn {{$btnClass}} btn-xs"
                                    onclick='return changeStatus("{{$maritalStatus->id}}", "{{$newStatus}}")'>
                                <i class="{{$toggleClass}}"></i> {{$toggleTitle}}
                            </button>
                            <button class="btn btn-danger btn-xs"
                                    onclick='return deleteMaritalStatus("{{$maritalStatus->id}}}")'>
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
        </table>
    </section>
    @include('cpanel.general._partials.modals.add-marital-status')
    @include('cpanel.general._partials.modals.edit-marital-status')
    @include('cpanel.general.assets.js.marital-status-js')
@endsection