@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">
            {{trans('cpanel.status')}} @choice('general.setting', 2)
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
                <th>@lang('status.title')</th>
                <th>@lang('status.description')</th>
                <th class="text-right" width="150">@lang('general.action')</th>
            </tr>
            </thead>
            @if(count($statuses) > 0)
                @foreach($statuses as $status)
                    <tr>
                        <td>{{$status->title}}</td>
                        <td>{{$status->description}}</td>
                        <td class="text-right">
                            <button class="btn btn-info btn-xs" id="btnEdit"
                                    onclick='return editStatus("{{$status->id}}}")'>
                                <i class="fa fa-edit"></i> {{trans('buttons.edit')}}
                            </button>
                            <button class="btn btn-danger btn-xs"
                                    onclick='return deleteStatus("{{$status->id}}}")'>
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
            @include('cpanel.general._partials.forms.add-edit-status')
        </table>
    </section>
    @include('cpanel.general.assets.js.status-js')
@endsection