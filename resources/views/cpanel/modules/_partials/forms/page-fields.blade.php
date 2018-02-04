<div class="form-group">
    <label class="col-sm-2 control-label" for="title">{{trans('modules.pages.title')}}
        <i class="fa fa-asterisk asterisk"></i>
    </label>
    <div class="col-sm-10">
        <input type="text" class="form-control input-sm" name="title" id="title" data-error="{{trans('forms.required')}}"
               required placeholder="{{trans('modules.pages.placeholders.title')}}"
               @isset($page->title)
               value="{{$page->title}}"
                @endisset
        >
        <div class="help-block with-errors"></div>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="page_url">
        {{trans('modules.pages.url')}}
        <i class="fa fa-asterisk asterisk"></i>
    </label>
    <div class="col-sm-10">
        <input type="text" class="form-control input-sm" name="page_url" id="page_url"
               data-error="{{trans('forms.required')}}" required
               placeholder="{{trans('modules.pages.placeholders.url')}}"
               @isset($page->page_url)
               value="{{$page->page_url}}"
                @endisset
        >
        <div class="help-block with-errors"></div>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="class">{{trans('modules.pages.icon')}}</label>
    <div class="col-sm-10">
        <select name="class" id="class" class="form-control input-sm">
            <option value="">{{ trans('forms.choose') }}</option>
            @if(count($icons) > 0)
                @foreach($icons as $icon)
                    <option value="{{$icon->class}}" @isset($page->class) @if($page->class == $icon->class) selected="selected" @endif @endisset>
                        {{$icon->class}}
                    </option>
                @endforeach
            @endif
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="description">{{trans('modules.pages.description')}}</label>
    <div class="col-sm-10">
            <textarea class="form-control input-sm" name="description" id="description"
                      placeholder="{{trans('modules.pages.placeholders.description')}}">@isset($page->description){{$page->description}}@endisset
            </textarea>
    </div>
</div>