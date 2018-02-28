<form id="addPermissionForm" role="form" data-toggle="validator" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
    <div class="form-group">
        <div class="col-sm-8">
            <input type="text" class="form-control input-sm" name="resource" id="resource"
                   required placeholder="{{trans('permissions.placeholders.resource')}}">
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form-group hide" id="crud_options">
        <div class="col-md-2">
            <div class="checkbox checkbox-success margin-top-5">
                <input id="create" type="checkbox" checked="checked" name="resources[create][id]" >
                <label for="create">@choice('permissions.crud.c', 2)</label>
            </div>
            <div class="checkbox checkbox-success margin-top-5">
                <input id="read" type="checkbox" checked="checked" name="resources[read][id]" >
                <label for="read">@choice('permissions.crud.r', 2)</label>
            </div>
            <div class="checkbox checkbox-success margin-top-5">
                <input id="update" type="checkbox" checked="checked" name="resources[update][id]" >
                <label for="update">@choice('permissions.crud.u', 2)</label>
            </div>
            <div class="checkbox checkbox-success margin-top-5">
                <input id="delete" type="checkbox" checked="checked" name="resources[delete][id]" >
                <label for="delete">@choice('permissions.crud.d', 2)</label>
            </div>
        </div>
        <div class="col-md-10 hide" id="crud_details">
            <div class="row" id="row_create">
                <div class="col-md-4"><input type="text" name="resources[create][name]"  class="form-control" id="create_name"></div>
                <div class="col-md-4"><input type="text" name="resources[create][display_name]" class="form-control" id="create_display_name"></div>
                <div class="col-md-4"><input type="text" name="resources[create][description]" class="form-control" id="create_description"></div>
            </div>
            <div class="row margin-top-5" id="row_read">
                <div class="col-md-4"><input type="text" name="resources[read][name]"  class="form-control" id="read_name"></div>
                <div class="col-md-4"><input type="text" name="resources[read][display_name]" class="form-control" id="read_display_name"></div>
                <div class="col-md-4"><input type="text" name="resources[read][description]" class="form-control" id="read_description"></div>
            </div>
            <div class="row margin-top-5" id="row_update">
                <div class="col-md-4"><input type="text" name="resources[update][name]"  class="form-control" id="update_name"></div>
                <div class="col-md-4"><input type="text" name="resources[update][display_name]" class="form-control" id="update_display_name"></div>
                <div class="col-md-4"><input type="text" name="resources[update][description]" class="form-control" id="update_description"></div>
            </div>
            <div class="row margin-top-5" id="row_delete">
                <div class="col-md-4"><input type="text" name="resources[delete][name]"  class="form-control" id="delete_name"></div>
                <div class="col-md-4"><input type="text" name="resources[delete][display_name]" class="form-control" id="delete_display_name"></div>
                <div class="col-md-4"><input type="text" name="resources[delete][description]" class="form-control" id="delete_description"></div>
            </div>

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
