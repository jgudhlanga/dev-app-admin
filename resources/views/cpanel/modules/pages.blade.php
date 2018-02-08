<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="pull-right margin-bottom-5 margin-left-5">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addPageModal">
            <i class="fa fa-plus-circle"></i> {{ trans('buttons.add_new') }}
        </button>
    </div>
    <div id="tableGridLayout">
        <table id="pagesMainTable" class="table table-striped table-bordered" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>@lang('modules.pages.position')</th>
                <th>@lang('modules.pages.title')</th>
                <th>@lang('modules.pages.icon')</th>
                <th>@lang('modules.pages.url')</th>
                <th>@lang('modules.pages.status')</th>
                <th>@lang('general.action')</th>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <th>@lang('modules.pages.position')</th>
                <th>@lang('modules.pages.title')</th>
                <th>@lang('modules.pages.icon')</th>
                <th>@lang('modules.pages.url')</th>
                <th>@lang('modules.pages.status')</th>
                <th></th>
            </tr>
            </tfoot>

        </table>
    </div>

</div>