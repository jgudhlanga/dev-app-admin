<div class="form-group">
    <label class="col-sm-2 control-label" for="name">{{trans('marital-status.name')}}
        <i class="fa fa-asterisk asterisk"></i>
    </label>
    <div class="col-sm-10">
        <input type="text" class="form-control input-sm" name="name" id="name" data-error="{{trans('forms.required')}}"
               required placeholder="{{trans('marital-status.placeholders.name')}}"
               @isset($edit->name)
               value="{{$edit->name}}"
                @endisset
        >
        <div class="help-block with-errors"></div>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="description">{{trans('marital-status.description')}}</label>
    <div class="col-sm-10">
            <textarea class="form-control input-sm" name="description" id="description"
                      placeholder="{{trans('marital-status.description')}}">@isset($edit->description){{$edit->description}}@endisset
            </textarea>
    </div>
</div>