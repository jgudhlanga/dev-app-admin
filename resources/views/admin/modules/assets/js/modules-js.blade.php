<script>
    $(document).ready(function () {
        /*
         |--------------------------------------------------------------------------
         | Modules Main List Grid
         |--------------------------------------------------------------------------
         | Standard grid to list modules
         */
        if ($('#modulesMainTable').length) {
            //searchHeaderBox( 'modulesMainTable', ":eq(8)", '{{ trans('general.search') }}' );
            searchFooterBox( 'modulesMainTable', ":eq(6)", '{{ trans('general.search') }}' );

            var modulesMainTable = $('#modulesMainTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                pageLength: 25,
                dom: "Blfrtip",
                order: [ 1, 'acs' ],
                ajax: '{{ url('modules/get-modules') }}',
                buttons: getDatatableButtons(),
                initComplete: function() {
                    initComplete( modulesMainTable )
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'description', name: 'description' },
                    { data: 'icon', name: 'icon' },
                    { data: 'module_url', name: 'module_url' },
                    { data: 'status_id', name: 'status_id' },
                    {
                        data: 'id',
                        orderable: false,
                        className: "text-center",
                        render: function ( data, type, full, meta ) {
                            return '<a class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>&nbsp;{{ trans("buttons.edit") }}</a>&nbsp;' +
                              '<a class="btn btn-sm btn-warning" data-id="' + data + '"><i class="fa fa-toggle-off"></i>&nbsp;{{ trans("buttons.deactivate") }}</a>&nbsp;' +
                              '<a class="btn btn-sm btn-danger" data-id="' + data + '"><i class="fa fa-trash"></i>&nbsp;{{ trans("buttons.delete") }}</a>';

                        }
                    }
                ],
            });

        }
    })
</script>
