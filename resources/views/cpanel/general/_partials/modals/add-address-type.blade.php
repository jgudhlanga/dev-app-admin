<div class="modal fade" id="addAddressTypeModal" tabindex="-1" role="dialog" aria-labelledby="addAddressTypeModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="addAddressTypeForm"  role="form" data-toggle="validator">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">
                        {{trans('address-types.create')}}
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="modal-close-btn">&times;</span>
                        </button>
                    </h3>
                </div>
                <div class="modal-body">
                    @include('cpanel.general._partials.forms.general-fields')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fa fa-times-circle"></i>&nbsp;{{trans('buttons.close')}}
                    </button>
                    <button type="submit" class="btn btn-success"  id="btnAdd">
                        <i class="fa fa-save"></i>&nbsp;{{trans('buttons.save')}}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>