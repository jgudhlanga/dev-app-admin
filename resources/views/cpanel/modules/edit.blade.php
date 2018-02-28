@extends('layouts.main.app-template')
@section('content')
    <section class="content-header">
        <h1 class="h1">@lang('modules.pages.heading') ( {{$module->title}} )</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('cpanel/modules') }}"><i class="fa fa-chevron-circle-left"></i>{{trans('cpanel.modules')}}</a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            @include('cpanel.modules.pages')
        </div>
    </section>
    @include('cpanel.modules._partials.modals.add-page')
    @include('cpanel.modules._partials.modals.edit-page')
    @include('cpanel.modules.assets.js.modules-js')
    @include('cpanel.modules.assets.js.pages-js')
@endsection