<form id="addBasicPermissionForm" role="form" data-toggle="validator" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
    @include('cpanel.security._partials.forms.fields')
    <div class="form-group">
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
    </div>
</form>