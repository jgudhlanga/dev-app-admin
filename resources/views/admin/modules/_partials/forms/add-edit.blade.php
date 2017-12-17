<form id="addEditModuleForm" action="">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
    {{ method_field('POST') }}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="title">{{trans('modules.title')}}
            <i class="fa fa-asterisk asterisk"></i>
        </label>
        <div class="col-sm-10">
            <input type="text" class="form-control input-sm" name="title" id="title" required
                   placeholder="{{trans('modules.placeholders.title')}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="module_url">{{trans('modules.url')}}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control input-sm" name="module_url" id="module_url" required
                   placeholder="{{trans('modules.placeholders.url')}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="icon">{{trans('modules.icon')}}</label>
        <div class="col-sm-10">
            <select name="icon" id="icon" class="form-control input-sm">
                <option>{{ trans('forms.choose') }}</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="description">{{trans('modules.description')}}</label>
        <div class="col-sm-10">
            <textarea class="form-control input-sm" name="description" id="description"
                      placeholder="{{trans('modules.placeholders.description')}}"></textarea>
        </div>
    </div>
</form>