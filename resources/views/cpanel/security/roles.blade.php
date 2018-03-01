@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">
            @choice('roles.title', 2) @choice('general.setting', 2)
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('cpanel') }}">
                    <i class="{{config('buttons.icons.back')}}"></i>{{trans('cpanel.c_panel')}}
                </a>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="pull-right margin-bottom-5 margin-left-5">
            <a class="btn btn-primary" href="{!! url('cpanel/security/roles/create') !!}">
                <i class="fa fa-plus-circle"></i> {{ trans('buttons.add_new') }}
            </a>
        </div>
        <table class="table table-striped" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>@lang('roles.display_name')</th>
                <th>@lang('roles.name')</th>
                <th>@lang('roles.description')</th>
                <th>@choice('permissions.title', 2)</th>
                <th>@lang('general.status')</th>
                <th class="text-right">@lang('general.action')</th>
            </tr>
            </thead>
            @if(count($roles) > 0)
                @foreach($roles as $role)
                    <tr>
                        <td>{{$role->display_name}}</td>
                        <td>{{$role->name}}</td>
                        <td>{{$role->description}}</td>
                        <td class="text-center">{{count($role->permissions)}}</td>
                        <td>{{$role->status->title}}</td>
                        <td class="text-right">
                            <a class="btn btn-info btn-xs" href="{{route('roles.edit', [$role->id])}}" >
                                <i class="fa fa-edit"></i> {{trans('buttons.edit')}}
                            </a>
					        <?php
					        $newStatus = ($role->status_id == $statusActive) ? $statusInActive : $statusActive;
					        $btnClass = ($role->status_id == $statusActive) ? 'btn-warning' : 'btn-success';
					        $toggleClass = ($role->status_id == $statusActive) ? 'fa fa-toggle-off' : 'fa fa-toggle-on';
					        $toggleTitle = ($role->status_id == $statusActive) ? trans('buttons.deactivate') : trans('buttons.reactivate');
					        ?>
                            <button class="btn {{$btnClass}} btn-xs"
                                    onclick='return changeStatus("{{$role->id}}", "{{$newStatus}}")'>
                                <i class="{{$toggleClass}}"></i> {{$toggleTitle}}
                            </button>
                            <button class="btn btn-danger btn-xs"
                                    onclick='return deleteRole("{{$role->id}}}")'>
                                <i class="fa fa-trash"></i> {{trans('buttons.delete')}}
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">
                        <div class="text-danger text-center">{{trans('general.no_records_found')}}</div>
                    </td>
                </tr>
            @endif
        </table>
    </section>
    @include('cpanel.security.assets.js.roles-js')
@endsection