@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">@lang('permissions.create')</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('cpanel/security/permissions') }}">
                    <i class="fa fa-chevron-circle-left"></i>
                    @choice('permissions.title', 2)
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="radio radio-primary radio-inline">
                            <input type="radio" id="basic" value="basic" name="permission_type" checked="">
                            <label for="basic"> @lang('permissions.types.basic') </label>
                        </div>
                        <div class="radio radio-primary radio-inline">
                            <input type="radio" id="crud" value="crud" name="permission_type">
                            <label for="crud"> @lang('permissions.types.crud') </label>
                        </div>
                    </div>
                </div>
            </div>

            <div id="basicPermissionHolder">
                @include('cpanel.security._partials.forms.basic-permission')
            </div>
            <div id="crudPermissionHolder" class="hide">
                @include('cpanel.security._partials.forms.crud-permission')
            </div>
        </div>
    </section>
    @include('cpanel.security.assets.js.permissions-js')
@endsection
