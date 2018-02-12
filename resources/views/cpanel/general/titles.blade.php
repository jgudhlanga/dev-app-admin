@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">
            @choice('titles.title', 2) @choice('general.setting', 2)
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
            <button class="btn btn-primary" data-toggle="modal" data-target="#addTitleModal">
                <i class="fa fa-plus-circle"></i> {{ trans('buttons.add_new') }}
            </button>
        </div>
        <table class="table table-striped" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>@lang('titles.name')</th>
                <th>@lang('titles.description')</th>
                <th>@lang('general.status')</th>
                <th class="text-right">@lang('general.action')</th>
            </tr>
            </thead>
            @if(count($titles) > 0)
                @foreach($titles as $title)
                    <tr>
                        <td>{{$title->name}}</td>
                        <td>{{$title->description}}</td>
                        <td>{{$title->status->title}}</td>
                        <td class="text-right">
                            <button class="btn btn-info btn-xs" id="btnEdit"
                                    onclick='return editTitle("{{$title->id}}}")'>
                                <i class="fa fa-edit"></i> {{trans('buttons.edit')}}
                            </button>
						    <?php
						    $newStatus = ($title->status_id == $statusActive) ? $statusInActive : $statusActive;
						    $btnClass = ($title->status_id == $statusActive) ? 'btn-warning' : 'btn-success';
						    $toggleClass = ($title->status_id == $statusActive) ? 'fa fa-toggle-off' : 'fa fa-toggle-on';
						    $toggleTitle = ($title->status_id == $statusActive) ? trans('buttons.deactivate') : trans('buttons.reactivate');
						    ?>
                            <button class="btn {{$btnClass}} btn-xs"
                                    onclick='return changeStatus("{{$title->id}}", "{{$newStatus}}")'>
                                <i class="{{$toggleClass}}"></i> {{$toggleTitle}}
                            </button>
                            <button class="btn btn-danger btn-xs"
                                    onclick='return deleteTitle("{{$title->id}}}")'>
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
    @include('cpanel.general._partials.modals.add-title')
    @include('cpanel.general._partials.modals.edit-title')
    @include('cpanel.general.assets.js.title-js')
@endsection