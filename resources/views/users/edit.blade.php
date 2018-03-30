@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">@choice('users.user', 1) @choice('general.profile', 1)</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('users') }}"><i class="fa fa-users"></i>@choice('users.user', 2)</a></li>
        </ol>
    </section>
    <section >
        <div class="row">
            <div class="card hovercard col-md-12">
                <div class="card-background">
                    <img src="{{ url()->asset(config('system.theme_background.users')) }}">
                </div>
                <div class="useravatar">
                    <img src="{{ url()->asset("storage/users/$user->profile_picture") }}" class="img-circle">
                </div>
                <div class="card-info">
                    <div>
                        <a href="#" data-toggle="modal" data-target="#profilePictureModal"><i class="fa fa-camera fa-2x"></i></a>
                    </div>
                    <span class="card-title">
                            {{$user->first_name}} {{$user->middle_name}} {{$user->last_name}}
                        </span>
                </div>
            </div>
            @include('users._partials.profile_tabs')
        </div>
    </section>
    @include('users._partials.modals.profile-picture-upload')
    @include('users.assets.users-js')
@endsection