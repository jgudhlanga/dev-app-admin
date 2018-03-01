@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">@lang('roles.edit')</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('cpanel/security/roles') }}">
                    <i class="{{config('buttons.icons.back')}}"></i>
                    @choice('roles.title', 2)
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form id="editRoleForm" role="form" data-toggle="validator" method="PUT" action="{{route('roles.update', [$role->id])}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <input type="hidden" id="edit_id" value="{{$role->id}}">
                @include('cpanel.security._partials.forms.roles-fields')
                <div class="col-md-12">
                    <div class="caption-title-div">
                        <div class="caption-title ">@choice('permissions.title',2)</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row pull-right">
                        <div class="col-md-12">
                            <a class="btn btn-default" href="{{ url('cpanel/security/roles') }}">
                                <i class="{{config('buttons.icons.back')}}"></i>&nbsp;
                                @lang('buttons.cancel')
                            </a>
                            <button class="btn btn-success" type="submit">
                                <i class="{{config('buttons.icons.save')}}"></i>&nbsp;
                                @lang('buttons.update')
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    @include('cpanel.security._partials.forms.permissions')
                </div>
            </form>
        </div>
    </section>
    @include('cpanel.security.assets.js.roles-js')
@endsection