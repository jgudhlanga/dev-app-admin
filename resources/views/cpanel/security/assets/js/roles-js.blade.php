<script>
	$(document).ready(function () {

		/*
        * SAVE
        * */
		$('#addRoleForm').validator().on('submit', function (e) {
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
				waitBusy('app_wrapper', '{{config('waitme.success')}}');
				var url = '{{ route("roles.store") }}';
				$.ajax({
					url: url,
					type: "POST",
					data: $('#addRoleForm').serialize()
				})
					.success(function (data) {
						if (data.role.id) {
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
						var arr = Object.entries(data.responseJSON.errors);
						var message = '';
						for (i = 0; i < arr.length; i++) {
							message += "<br>" + arr[i][1];
						}
						$('#app_wrapper').waitMe('hide');
						swal("{{ trans('alerts.error') }}", message, "error");
					});
			}
		});


		/*
        * UPDATE
        * */
		$('#editRoleForm').validator().on('submit', function (e) {
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
				waitBusy('app_wrapper', '{{config('waitme.success')}}');
				var url = '{{ route("roles.update", [':id']) }}';
				url = url.replace(':id', $('#edit_id').val());
				$.ajax({
					url: url,
					type: "PUT",
					data: $('#editRoleForm').serialize()
				})
					.success(function (data) {
						if (data.role.id) {
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

		/* CHECK ALL */
		$('#check_all').click(function () {
			if($(this).prop('checked')) {
				$('input[type=checkbox]').prop('checked', true);
            }
            else{
				$('input[type=checkbox]').prop('checked', false);
            }
		});
	});

	/**
	 * DELETE
	 * @param id
	 */
	function deleteRole(id) {
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

					waitBusy('app_wrapper', '{{config('waitme.danger')}}');
					var url = '{{ route("roles.destroy", [':id']) }}';
					url = url.replace(':id', id);
					var data = {'_token': "{{ csrf_token() }}"};
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
	 * CHANGE STATUS
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

					waitBusy('app_wrapper', '{{config('waitme.info')}}');

					var url = '{{ url('api/cpanel/security/roles/change-status') }}/' + id;
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
