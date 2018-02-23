<form id="addBasicPermissionForm" role="form" data-toggle="validator">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
    <div class="form-group">
        <div class="col-sm-8">
            <input type="text" class="form-control input-sm" name="display_name" id="display_name" data-error="{{trans('forms.required')}}"
                   required placeholder="{{trans('permissions.placeholders.display_name')}}"
                   @isset($edit->display_name)
                   value="{{$edit->display_name}}"
                    @endisset
            >
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8">
            <input type="text" class="form-control input-sm" name="name" id="name" data-error="{{trans('forms.required')}}"
                   required placeholder="{{trans('permissions.placeholders.name')}}"
                   @isset($edit->name)
                   value="{{$edit->name}}"
                    @endisset
            >
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8">
                <textarea class="form-control input-sm" name="description" id="description"
                          placeholder="{{trans('permissions.placeholders.description')}}">@isset($edit->description){{$edit->description}}@endisset
                </textarea>
        </div>
    </div>
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