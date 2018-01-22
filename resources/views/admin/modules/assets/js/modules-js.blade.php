<script>
	$(document).ready(function () {
		/*
         |--------------------------------------------------------------------------
         | Modules Main List Grid
         |--------------------------------------------------------------------------
         | Standard grid to list modules
         */
		if ($('#modulesMainTable').length) {

			var modulesMainTable = $('#modulesMainTable').DataTable({
				processing: true,
				serverSide: true,
				responsive: true,
				pageLength: 25,
				dom: "Blfrtip",
				ajax: '{{ url('api/modules/get-modules') }}',
				buttons: getDatatableButtons(),
				initComplete: function () {
					initComplete(modulesMainTable)
				},
				columns: [
					{data: 'position', name: 'position'},
					{data: 'title', name: 'title'},
					{data: 'description', name: 'description'},
					{data: 'class', name: 'class'},
					{data: 'module_url', name: 'module_url'},
					{data: 'status', name: 'status'},
					{
						data: 'id',
						orderable: false,
						className: "text-center",
						render: function (data, type, full, meta) {
							var changeStatusBtnTitle = "{{trans('buttons.deactivate')}}";
							var changeStatusBtnClass = "btn-warning";
							var upDirection = "up";
							var downDirection = "down";
							if (full.status_id == "{{App\Models\Common\Status::INACTIVE}}") {
								changeStatusBtnTitle = "{{trans('buttons.reactivate')}}";
								changeStatusBtnClass = "btn-success";
							}
							return '<a class="btn btn-xs btn-info" href="{{ url()->current() }}/' + data + '">' +
                                '<i class="fa fa-eye"></i>&nbsp;{{ trans("buttons.view") }}</a>&nbsp;' +
								'<a class="btn btn-xs ' + changeStatusBtnClass + '" onclick="changeStatus(' + data + ')">' +
								'<i class="fa fa-toggle-off"></i>&nbsp;' + changeStatusBtnTitle + '</a>&nbsp;' +
								'<a class="btn btn-xs btn-danger" onclick="deleteModule(' + data + ')">' +
								'<i class="fa fa-trash"></i>&nbsp;{{ trans("buttons.delete") }}</a>&nbsp;'+
								'<a class="btn btn-xs btn-default" onclick="orderModuleUp(' + data +')">' +
								'<i class="fa fa-arrow-circle-o-up text-success"></i>&nbsp;{{ trans("buttons.up") }}</a>&nbsp;'+
								'<a class="btn btn-xs btn-default" onclick="orderModuleDown(' + data +')">' +
								'<i class="fa fa-arrow-circle-o-down text-danger"></i>&nbsp;{{ trans("buttons.down") }}</a>';
						}
					}
				],
			});
		}

		/*
        * SAVE MODULE
        * */
		$('#addModuleForm').validator().on('submit', function (e) {
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
				waitBusy('addModuleModal', 'win8_linear', "{{trans('waitme.saving')}}", "{{config('waitme.success')}}");
				var url = '{{ route("modules.store") }}';
				$.ajax({
					url: url,
					type: "POST",
					data: $('#addModuleForm').serialize()
				})
					.success(function (data) {
						if (data.module.id) {
							$('#addModuleModal').modal('hide');
							swal("{{ trans('alerts.created') }}",
								data.message,
								"success"
							).then(function () {
								$('#addModuleModal').waitMe('hide');
								location.reload(true);
							});
						}
					})
					.error(function (data) {
						$('#addModuleModal').waitMe('hide');
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
        * SAVE MODULE
        * */
		$('#editModuleForm').validator().on('submit', function (e) {
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
				waitBusy('editModuleForm', 'win8_linear', "{{trans('waitme.updating')}}", "{{config('waitme.success')}}");
				var url = '{{ route("modules.update", [':module_id']) }}';
				url = url.replace(':module_id', $('#edit_id').val());
				$.ajax({
					url: url,
					type: "PUT",
					data: $('#editModuleForm').serialize()
				})
					.success(function (data) {
						if (data.module.id) {
							swal("{{ trans('alerts.updated') }}",
								data.message,
								"success"
							).then(function () {
								$('#editModuleForm').waitMe('hide');
								location.reload(true);
							});
						}
					})
					.error(function (data) {
						$('#editModuleForm').waitMe('hide');
						var arr = Object.entries(data.responseJSON.errors);
						var message = '';
						for (i = 0; i < arr.length; i++) {
							message += "<br>" + arr[i][1];
						}
						swal("{{ trans('alerts.error') }}", message, "error");
					});
			}
		});
	});

	/**
     * DELETE MODULE
     * @param id
     */
	function deleteModule(id) {
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

					waitBusy('tableGridLayout', 'win8_linear', "{{trans('waitme.deleting')}}", "{{config('waitme.danger')}}");

					var url = '{{ route("modules.destroy", [':module_id']) }}';
					url = url.replace(':module_id', id);
					var data = {'module_id': id, '_token': "{{ csrf_token() }}"};
					$.ajax({
						url: url,
						type: "DELETE",
						data: data
					})
						.success(function (data) {
							$('#tableGridLayout').waitMe('hide');
							swal("{{ trans('alerts.deleted') }}",
								"{{trans('alerts.after_delete_text')}}",
								"success")
								.then(function () {
									location.reload(true);
								});
						})
						.error(function (data) {
							$('#tableGridLayout').waitMe('hide');
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

					waitBusy('tableGridLayout', 'win8_linear', "{{trans('waitme.busy')}}", "{{config('waitme.info')}}");

					var url = '{{ url("api/modules/change-status") }}';
					var data = {'module_id': id, '_token': "{{ csrf_token() }}"};
					$.ajax({
						url: url,
						type: "PUT",
						data: data
					})
						.success(function (data) {

							$('#tableGridLayout').waitMe('hide');

							swal("{{ trans('alerts.status_changed') }}",
								data.message,
								"success")
								.then(function () {
									location.reload(true);
								});
						})
						.error(function (data) {

							$('#tableGridLayout').waitMe('hide');

							swal("{{ trans('alerts.error') }}", data.responseJSON.response, "error");
						});
				}
			});
	}

	/**
     * ORDER MODULE UP
	 * @param id
	 */
	function orderModuleUp(id) {
		swal({
			title: "{{ trans('alerts.confirm') }}",
			text: "{{ trans('modules.alerts.order_up') }}",
			type: 'warning',
			showCancelButton: true,
			confirmButtonClass: "{{ config('sweetalerts.confirm_button_class') }}",
			cancelButtonColor: "{{ config('sweetalerts.confirm_button_color') }}",
			confirmButtonText: "{{ trans('alerts.confirm_button_text') }}"
		})
	}

	/**
	 * ORDER MODULE DOWN
	 * @param id
	 */
	function orderModuleDown(id) {
		swal({
			title: "{{ trans('alerts.confirm') }}",
			text: "{{ trans('modules.alerts.order_down') }}",
			type: 'warning',
			showCancelButton: true,
			confirmButtonClass: "{{ config('sweetalerts.confirm_button_class') }}",
			cancelButtonColor: "{{ config('sweetalerts.confirm_button_color') }}",
			confirmButtonText: "{{ trans('alerts.confirm_button_text') }}"
		})
	}

</script>
