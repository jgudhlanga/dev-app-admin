@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">
            {{trans('cpanel.menu_icons')}} @choice('general.setting', 2)
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
        <table class="table table-striped" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>@lang('icons.class')</th>
                <th>@lang('general.status')</th>
                <th class="text-right">@lang('general.action')</th>
            </tr>
            </thead>
            @if(count($classes) > 0)
                @foreach($classes as $class)
                    <tr>
                        <td>{{$class->class}}</td>
                        <td>{{$class->status->title}}</td>
                        <td class="text-right">
                            <button class="btn btn-info btn-xs" id="btnEdit"
                                    onclick='return editClass("{{$class->id}}}")'>
                                <i class="fa fa-edit"></i> {{trans('buttons.edit')}}
                            </button>
						    <?php
						    $newStatus = ($class->status_id == $statusActive) ? $statusInActive : $statusActive;
						    $btnClass = ($class->status_id == $statusActive) ? 'btn-warning' : 'btn-success';
						    $toggleClass = ($class->status_id == $statusActive) ? 'fa fa-toggle-off' : 'fa fa-toggle-on';
						    $toggleTitle = ($class->status_id == $statusActive) ? trans('buttons.deactivate') : trans('buttons.reactivate');
						    ?>
                            <button class="btn {{$btnClass}} btn-xs"
                                    onclick='return changeStatus("{{$class->id}}", "{{$newStatus}}")'>
                                <i class="{{$toggleClass}}"></i> {{$toggleTitle}}
                            </button>
                            <button class="btn btn-danger btn-xs"
                                    onclick='return deleteClass("{{$class->id}}}")'>
                                <i class="fa fa-trash"></i> {{trans('buttons.delete')}}
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">
                        <div class="text-danger text-center">{{trans('general.no_records_found')}}</div>
                    </td>
                </tr>
            @endif
            @include('cpanel.general._partials.forms.add-edit-icons')
        </table>
    </section>
    @include('cpanel.general.assets.js.icons-js')
@endsection