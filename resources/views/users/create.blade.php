@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">@lang('general.create') @choice('users.user', 1)</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('users') }}"><i class="fa fa-home"></i>{{trans('general.home')}}</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <form id="addUserForm" role="form" data-toggle="validator" method="POST" action="{{route('users.store')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                @include('users._partials.forms.user-fields')
                <div class="col-md-12  text-center">
                    <div class="padding-top-5">
                        <a class="btn btn-default" type="button" href="{{route('users.index')}}">
                            <i class="{{config('buttons.icons.back')}}"></i>&nbsp;@lang('buttons.back')
                        </a>
                        <button class="btn btn-success" type="submit">
                            <i class="{{config('buttons.icons.save')}}"></i>&nbsp;@lang('buttons.save')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    @include('users.assets.users-js')
@endsection