@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">@lang('general.edit') @choice('users.user', 1)</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('users') }}"><i class="fa fa-home"></i>{{trans('general.home')}}</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <form id="editUserForm"  role="form" data-toggle="validator" method="PUT" action="{{route('users.update', $user->id)}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div class="col-md-8">
                    <div class="card hovercard">
                        <div class="card-background">
                            <img src="{{ asset("images/theme-1.jpg") }}" class="img-circle" alt="User Image">
                        </div>
                        <div class="useravatar">
                            <img src="{{ asset("images/my-profile.png") }}" class="img-circle" alt="User Image">
                        </div>
                        <div class="card-info">
                            <span class="card-title">
                                {{$user->first_name}} {{$user->middle_name}} {{$user->last_name}}
                            </span>
                        </div>
                    </div>
                </div>
                @include('users._partials.forms.user-fields')
                <div class="col-md-8  text-center">
                    <div class="padding-top-5">
                        <a class="btn btn-default" type="button" href="{{route('users.index')}}">
                            <i class="{{config('buttons.icons.back')}}"></i>&nbsp;@lang('buttons.back')
                        </a>
                        <button class="btn btn-success" type="submit">
                            <i class="{{config('buttons.icons.save')}}"></i>&nbsp;@lang('buttons.update')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    @include('users.assets.users-js')
@endsection