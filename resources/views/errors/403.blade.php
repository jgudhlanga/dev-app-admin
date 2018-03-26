
@extends('layouts.main.app-template')
@section('content')
    <div class="forbidden403">
        <img src="{{ asset(config('errors.403.image')) }}" alt="403" class="image"><br/>
        <div class="code">@lang('errors.403.code')</div>
        <div class="header">@lang('errors.403.header')</div>
        <div class="body">@lang('errors.403.body')</div>
    </div>
@endsection