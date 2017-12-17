<div class="modal fade" id="addEditModuleModal" tabindex="-1" role="dialog" aria-labelledby="addEditModuleModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    {{trans('modules.create_module')}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="modal-close-btn">&times;</span>
                    </button>
                </h3>
            </div>
            <div class="modal-body">
                @include('admin.modules._partials.forms.add-edit')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times-circle"></i>&nbsp;{{trans('buttons.close')}}
                </button>
                <button type="button" class="btn btn-primary">
                    <i class="fa fa-save"></i>&nbsp;{{trans('buttons.save')}}
                </button>
            </div>
        </div>
    </div>
</div>