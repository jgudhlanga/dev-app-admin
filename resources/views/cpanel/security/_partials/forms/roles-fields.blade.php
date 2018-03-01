<div class="form-group">
    <label for="display_name" class="col-md-2 control-label text-left">
        @lang('roles.display_name')
        <i class="fa fa-asterisk asterisk"></i>
    </label>
    <div class="col-sm-8">
        <input type="text" class="form-control input-sm" name="display_name" id="display_name" data-error="{{trans('forms.required')}}"
               required placeholder="{{trans('roles.placeholders.display_name')}}"
               @isset($role->display_name)
               value="{{$role->display_name}}"
                @endisset
        >
        <div class="help-block with-errors"></div>
    </div>
</div>
<div class="form-group">
    <label for="name" class="col-md-2 control-label text-left">
        @lang('roles.name')
        <i class="fa fa-asterisk asterisk"></i>
    </label>
    <div class="col-sm-8">
        <input type="text" class="form-control input-sm" name="name" id="name" data-error="{{trans('forms.required')}}"
               required placeholder="{{trans('roles.placeholders.name')}}"
               @isset($role->name)
               value="{{$role->name}}"
                @endisset
        >
        <div class="help-block with-errors"></div>
    </div>
</div>
<div class="form-group">
    <label for="description" class="col-md-2 control-label text-left">
        @lang('roles.description')
    </label>
    <div class="col-sm-8">
            <textarea class="form-control input-sm" name="description" id="description"
                      placeholder="{{trans('roles.placeholders.description')}}">@isset($role->description){{$role->description}}@endisset
            </textarea>
    </div>
</div>