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
								'<a class="btn btn-xs btn-default" onclick="editPermission(' + data + ')">' +
								'<i class="fa fa-pencil"></i>&nbsp;@lang('buttons.edit')</a>&nbsp;' +
								'<a class="btn btn-xs ' + changeStatusBtnClass + '" onclick="changeStatus(' + data + ')">' +
								'<i class="fa fa-toggle-off"></i>&nbsp;' + changeStatusBtnTitle + '</a>&nbsp;' +
								'<a class="btn btn-xs btn-danger" onclick="deletePermission(' + data + ')">' +
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
					var displayName = crud[i].toUpperCase() + ' ' + $('#resource').val().toUpperCase();
					displayName = displayName.replace('-', ' ');
					$('#' + crud[i] + '_display_name').val(displayName);
					var description = "@lang('permissions.allow_user_to') " + crud[i].toUpperCase() + ' ' + $('#resource').val().toUpperCase();
					description = description.replace('-', ' ');
					$('#' + crud[i] + '_description').val(description);
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

		/* SAVE BASIC PERMISSION */

		$('#addBasicPermissionForm').validator().on('submit', function (e) {
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
				var url = '{{ route("permissions.store") }}';
				$.ajax({
					url: url,
					type: "POST",
					data: $('#addBasicPermissionForm').serialize()
				})
					.success(function (data) {
						if (data.permission.id) {
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
						var arr = Object.entries(data.responseJSON.errors);
						var message = '';
						for (i = 0; i < arr.length; i++) {
							message += "<br>" + arr[i][1];
						}
						swal("{{ trans('alerts.error') }}", message, "error");
					});
			}
		});

		/*
        * UPDATE
        * */
		$('#editPermissionForm').validator().on('submit', function (e) {
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
				var url = '{{ route("permissions.update", [':id']) }}';
				url = url.replace(':id', $('#edit_id').val());
				$.ajax({
					url: url,
					type: "PUT",
					data: $('#editPermissionForm').serialize()
				})
					.success(function (data) {
						if (data.permission.id) {
							swal("{{ trans('alerts.updated') }}",
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
						swal("{{ trans('alerts.error') }}", data.responseJSON.message, "error");
					});
			}
		});

    });

	/*
        * EDIT SHOW
        * */
	function editPermission(id) {
		$('#editPermissionModal').modal('show');
		waitBusy('editPermissionModal', '{{config('waitme.info')}}');
		var url = '{{ route("permissions.edit", [':id']) }}';
		url = url.replace(':id', id);
		var data = {'id': id};
		$.ajax({
			url: url,
			type: "GET",
			data: data
		})
			.success(function (res) {
				$('#editPermissionModal').waitMe('hide');
				//populate form fields
				$('#btnUpdate').removeClass('disabled');
				$('#editPermissionForm #edit_id').val(res.data.id);
				$('#editPermissionForm #name').val(res.data.name);
				$('#editPermissionForm #display_name').val(res.data.display_name);
				$('#editPermissionForm #description').val(res.data.description);
			})
	}
	/**
	 * DELETE MODULE
	 * @param id
	 */
	function deletePermission(id) {
		swal({
			title: "{{ trans('alerts.confirm') }}",
			text: "{{ trans('alerts.delete_text') }}",
			type: 'question',
			showCancelButton: true,
			confirmButtonClass: "{{ config('sweetalerts.confirm_button_class') }}",
			cancelButtonColor: "{{ config('sweetalerts.confirm_button_color') }}",
			confirmButtonText: "{{ trans('alerts.confirm_button_text') }}"
		})
			.then(function (result) {
				if (result.value) {

					waitBusy('app_wrapper','{{config('waitme.danger')}}');
					var url = '{{ route("permissions.destroy", [':id']) }}';
					url = url.replace(':id', id);
					var data = {'id': id, '_token': "{{ csrf_token() }}"};
					$.ajax({
						url: url,
						type: "DELETE",
						data: data
					})
						.success(function (data) {
							$('#app_wrapper').waitMe('hide');
							swal("{{ trans('alerts.deleted') }}",
								"{{trans('alerts.after_delete_text')}}",
								"success")
								.then(function () {
									location.reload(true);
								});
						})
						.error(function (data) {
							$('#app_wrapper').waitMe('hide');
							swal("{{ trans('alerts.error') }}", data.responseJSON.response, "error");
						});
				}
			});
	}

	/**
	 * CHANGE MODULE STATUS
	 * @param id
	 */
	function changeStatus(id) {
		swal({
			title: "{{ trans('alerts.confirm') }}",
			text: "{{ trans('alerts.change_status_text') }}",
			type: 'warning',
			showCancelButton: true,
			confirmButtonClass: "{{ config('sweetalerts.confirm_button_class') }}",
			cancelButtonColor: "{{ config('sweetalerts.confirm_button_color') }}",
			confirmButtonText: "{{ trans('alerts.confirm_button_text') }}"
		})
			.then(function (result) {
				if (result.value) {

					waitBusy('app_wrapper','{{config('waitme.info')}}');

					var url = '{{ url('api/cpanel/security/permissions/change-status') }}/' + id;
					var data = {'_token': "{{ csrf_token() }}"};
					$.ajax({
						url: url,
						type: "PUT",
						data: data
					})
						.success(function (data) {

							$('#app_wrapper').waitMe('hide');

							swal("{{ trans('alerts.status_changed') }}",
								data.message,
								"success")
								.then(function () {
									location.reload(true);
								});
						})
						.error(function (data) {

							$('#app_wrapper').waitMe('hide');

							swal("{{ trans('alerts.error') }}", data.responseJSON.response, "error");
						});
				}
			});
	}
</script>
