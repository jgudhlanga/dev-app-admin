@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">@lang('general.create') @choice('users.user', 1)</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}"><i class="fa fa-home"></i>{{trans('general.home')}}</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form id="addRoleForm" role="form" data-toggle="validator" method="POST" action="{{route('users.store')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                @include('users._partials.forms.user-fields')
            </form>
        </div>
    </section>
    @include('users.assets.users-js')
@endsection