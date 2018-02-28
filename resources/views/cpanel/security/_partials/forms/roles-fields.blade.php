<div class="form-group">
    <div class="col-sm-8">
        <input type="text" class="form-control input-sm" name="display_name" id="display_name" data-error="{{trans('forms.required')}}"
               required placeholder="{{trans('roles.placeholders.display_name')}}"
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
               required placeholder="{{trans('roles.placeholders.name')}}"
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
                      placeholder="{{trans('roles.placeholders.description')}}">@isset($edit->description){{$edit->description}}@endisset
            </textarea>
    </div>
</div>