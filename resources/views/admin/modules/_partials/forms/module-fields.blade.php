<div class="form-group">
    <label class="col-sm-2 control-label" for="title">{{trans('modules.title')}}
        <i class="fa fa-asterisk asterisk"></i>
    </label>
    <div class="col-sm-10">
        <input type="text" class="form-control input-sm" name="title" id="title" data-error="{{trans('forms.required')}}"
               required placeholder="{{trans('modules.placeholders.title')}}"
               @isset($module->title)
                    value="{{$module->title}}"
               @endisset
        >
        <div class="help-block with-errors"></div>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="module_url">
        {{trans('modules.url')}}
        <i class="fa fa-asterisk asterisk"></i>
    </label>
    <div class="col-sm-10">
        <input type="text" class="form-control input-sm" name="module_url" id="module_url"
               data-error="{{trans('forms.required')}}" required
               placeholder="{{trans('modules.placeholders.url')}}"
               @isset($module->module_url)
                    value="{{$module->module_url}}"
               @endisset
        >
        <div class="help-block with-errors"></div>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="class">{{trans('modules.icon')}}</label>
    <div class="col-sm-10">
        <select name="class" id="class" class="form-control input-sm">
            <option value="">{{ trans('forms.choose') }}</option>
            @if(count($icons) > 0)
                @foreach($icons as $icon)
                    <option value="{{$icon->class}}" @isset($module->class) @if($module->class == $icon->class) selected="selected" @endif @endisset>
                        {{$icon->class}}
                    </option>
                @endforeach
            @endif
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="description">{{trans('modules.description')}}</label>
    <div class="col-sm-10">
            <textarea class="form-control input-sm" name="description" id="description"
                      placeholder="{{trans('modules.placeholders.description')}}">@isset($module->description){{$module->description}}@endisset
            </textarea>
    </div>
</div>