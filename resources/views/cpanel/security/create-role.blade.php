@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">@lang('roles.create')</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('cpanel/security/roles') }}">
                    <i class="fa fa-chevron-circle-left"></i>
                    @choice('roles.title', 2)
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form id="addRoleForm" role="form" data-toggle="validator" method="POST" action="{{route('roles.store')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                @include('cpanel.security._partials.forms.roles-fields')
                <div class="col-md-12">
                    <div class="col-md-12 caption-title-div">
                        <div class="caption-title ">@choice('permissions.title',2)</div>
                    </div>
                    @include('cpanel.security._partials.forms.permissions')
                </div>
                <div class="col-md-12">
                    <button class="btn btn-default">
                        <i class="fa fa-times-circle"></i>&nbsp;
                        @lang('buttons.cancel')
                    </button>
                    <button class="btn btn-success" type="submit">
                        <i class="fa fa-save"></i>&nbsp;
                        @lang('buttons.save')
                    </button>
                </div>
            </form>
        </div>
    </section>
    @include('cpanel.security.assets.js.roles-js')
@endsection