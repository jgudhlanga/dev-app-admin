@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">
            @choice('members.types.title', 2) @choice('general.setting', 2)
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
            <button class="btn btn-primary" data-toggle="modal" data-target="#addMemberTypeModal">
                <i class="fa fa-plus-circle"></i> {{ trans('buttons.add_new') }}
            </button>
        </div>
        <table class="table table-striped" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>@lang('members.types.name')</th>
                <th>@lang('members.types.description')</th>
                <th>@lang('general.status')</th>
                <th class="text-right">@lang('general.action')</th>
            </tr>
            </thead>
            @if(count($memberTypes) > 0)
                @foreach($memberTypes as $types)
                    <tr>
                        <td>{{$types->name}}</td>
                        <td>{{$types->description}}</td>
                        <td>{{$types->status->title}}</td>
                        <td class="text-right">
                            <button class="btn btn-info btn-xs" id="btnEdit"
                                    onclick='return editMemberType("{{$types->id}}}")'>
                                <i class="fa fa-edit"></i> {{trans('buttons.edit')}}
                            </button>
							<?php
							$newStatus = ($types->status_id == $statusActive) ? $statusInActive : $statusActive;
							$btnClass = ($types->status_id == $statusActive) ? 'btn-warning' : 'btn-success';
							$toggleClass = ($types->status_id == $statusActive) ? 'fa fa-toggle-off' : 'fa fa-toggle-on';
							$toggleTitle = ($types->status_id == $statusActive) ? trans('buttons.deactivate') : trans('buttons.reactivate');
							?>
                            <button class="btn {{$btnClass}} btn-xs"
                                    onclick='return changeStatus("{{$types->id}}", "{{$newStatus}}")'>
                                <i class="{{$toggleClass}}"></i> {{$toggleTitle}}
                            </button>
                            <button class="btn btn-danger btn-xs"
                                    onclick='return deleteMemberType("{{$types->id}}}")'>
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
    @include('cpanel.general._partials.modals.add-member-type')
    @include('cpanel.general._partials.modals.edit-member-type')
    @include('cpanel.general.assets.js.member-types-js')
@endsection