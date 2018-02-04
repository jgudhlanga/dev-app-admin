<div class="form-group">
    <label class="col-sm-2 control-label" for="name">@choice('general.name', 1)
<i class="fa fa-asterisk asterisk"></i>
</label>
<div class="col-sm-10">
    <input type="text" class="form-control input-sm" name="name" id="name" data-error="{{trans('forms.required')}}"
           required placeholder="{{trans('general.placeholders.name')}}"
           @isset($edit->name)
           value="{{$edit->name}}"
            @endisset
    >
    <div class="help-block with-errors"></div>
</div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="description">{{trans('general.description')}}</label>
    <div class="col-sm-10">
            <textarea class="form-control input-sm" name="description" id="description"
                      placeholder="{{trans('general.description')}}">@isset($edit->description){{$edit->description}}@endisset
            </textarea>
    </div>
</div>