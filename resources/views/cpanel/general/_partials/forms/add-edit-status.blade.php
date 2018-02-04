<form  class="form-horizontal" role="form" id="addEditStatusForm" data-toggle="validator">
    <input type="hidden" id="edit_id" name="edit_id">
    {{csrf_field()}}
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td><input type="text" name="title" id="title" class="form-control input-sm" required="required"></td>
        <td><input type="text" name="description" id="description" class="form-control input-sm"></td>
        <td>
            <button type="submit" class="btn btn-success btn-sm" id="btnSave">
                <i class="fa fa-save"></i> {{trans('buttons.save')}}
            </button>
            <button type="button" class="btn btn-success btn-sm hide" id="btnUpdate">
                <i class="fa fa-save"></i> {{trans('buttons.update')}}
            </button>
        </td>
    </tr>
</form>