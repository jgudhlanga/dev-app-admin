<script>
    $(document).ready(function(){

		/*
         |--------------------------------------------------------------------------
         | Permissions Main List Grid
         |--------------------------------------------------------------------------
         | Standard grid to list permissions
         */
		if ($('#permissionsMainTable').length) {

			var permissionsMainTable = $('#permissionsMainTable').DataTable({
				processing: true,
				serverSide: true,
				responsive: true,
				pageLength: 25,
				dom: "Blfrtip",
				ajax: '{{ url('api/cpanel/security/permissions/get-permissions') }}',
				buttons: getDatatableButtons(),
				initComplete: function () {
					initComplete(permissionsMainTable)
				},
				columns: [
					{data: 'name', name: 'name'},
					{data: 'display_name', name: 'display_name'},
					{data: 'description', name: 'description'},
					{data: 'status', name: 'status'},
					{
						data: 'id',
						orderable: false,
						className: "text-center",
						render: function (data, type, full, meta) {
							var changeStatusBtnTitle = "{{trans('buttons.deactivate')}}";
							var changeStatusBtnClass = "btn-warning";
							if (full.status_id == "{{App\Models\General\Status::INACTIVE}}") {
								changeStatusBtnTitle = "{{trans('buttons.reactivate')}}";
								changeStatusBtnClass = "btn-success";
							}
							return '' +
								'<a class="btn btn-xs btn-default" href="{{ url()->current() }}/' + data + '">' +
								'<i class="fa fa-pencil"></i>&nbsp;@lang('buttons.edit')</a>&nbsp;' +
								'<a class="btn btn-xs ' + changeStatusBtnClass + '" onclick="changeStatus(' + data + ')">' +
								'<i class="fa fa-toggle-off"></i>&nbsp;' + changeStatusBtnTitle + '</a>&nbsp;' +
								'<a class="btn btn-xs btn-danger" onclick="deleteModule(' + data + ')">' +
								'<i class="fa fa-trash"></i>&nbsp;{{ trans("buttons.delete") }}</a>';
						}
					}
				],
			});
		}

		$('input[type=radio]').click(function () {
			if($(this).prop('checked')) {
				if($(this).val() == 'crud')
                {
                	$('#crudPermissionHolder').removeClass('hide');
                	$('#basicPermissionHolder').addClass('hide');
                }
                else{
					$('#crudPermissionHolder').addClass('hide');
					$('#basicPermissionHolder').removeClass('hide');
                }
            }
		});


		/*
		* TYPING RESOURCE NAME FILL CRUD FIELDS
		* */
		var crud = ['create', 'read', 'update', 'delete'];
		$(document).off('input', "#resource").on('input', '#resource', function (e) {
			e.preventDefault();

			var resource = $(this).val();
            if(resource.length >= 3 ) {

				for(i=0; i < crud.length; i++)
				{
					$('#' + crud[i] + '_name').val( crud[i] + '-' + $('#resource').val());
					$('#' + crud[i] + '_display_name').val( crud[i].toUpperCase() + ' ' + $('#resource').val().toUpperCase());
					$('#' + crud[i] + '_description').val("@lang('permissions.allow_user_to') " + crud[i].toUpperCase() + ' ' + $('#resource').val().toUpperCase());
				}

            	$('#crud_details, #crud_options').removeClass('hide');

				$('input[type=checkbox]').click(function () {
					if($(this).prop('checked')) {
						$('#row_' + $(this).attr('id')).removeClass('hide');
					}
					else{
						$('#row_' + $(this).attr('id')).addClass('hide');
					}
				});

            }
            else{
				$('#crud_details, #crud_options').addClass('hide')
            }

		});

		/* SAVE CRUD PERMISSIONS */

		$('#addPermissionForm').validator().on('submit', function (e) {
			if (e.isDefaultPrevented()) {
				swal({
					title: "{{ trans('alerts.error') }}",
					text: "{{ trans('alerts.form_error') }}",
					type: "error",
					allowOutsideClick: false
				});
			}
			else {
				e.preventDefault();
				waitBusy('app_wrapper','{{config('waitme.success')}}');
				var url = '{{ url("cpanel/security/permissions/store-crud") }}';
				$.ajax({
					url: url,
					type: "POST",
					data: $('#addPermissionForm').serialize()
				})
					.success(function (data) {
						if (data.permission > 0) {
							swal("{{ trans('alerts.created') }}",
								data.message,
								"success"
							).then(function () {
								$('#app_wrapper').waitMe('hide');
								location.reload(true);
							});
						}
					})
					.error(function (data) {
						$('#app_wrapper').waitMe('hide');
						swal("{{ trans('alerts.error') }}", "{{trans('permissions.alerts.crud_error')}}", "error");
					});
			}
		});

    })
</script>
