<script>
	$(document).ready(function () {

		/*
        * SAVE
        * */
		$('#addMaritalStatusForm').validator().on('submit', function (e) {
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
				var url = '{{ route("marital-statuses.store") }}';
				$.ajax({
					url: url,
					type: "POST",
					data: $('#addMaritalStatusForm').serialize()
				})
					.success(function (data) {
						if (data.marital_status.id) {
							$('#addMaritalStatusModal').modal('hide');
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
		$('#editMaritalStatusForm').validator().on('submit', function (e) {
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
				var url = '{{ route("marital-statuses.update", [':id']) }}';
				url = url.replace(':id', $('#edit_id').val());
				$.ajax({
					url: url,
					type: "PUT",
					data: $('#editMaritalStatusForm').serialize()
				})
					.success(function (data) {
						if (data.marital_status.id) {
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
	function editMaritalStatus(id) {
		$('#editMaritalStatusModal').modal('show');
		waitBusy('editMaritalStatusModal', '{{config('waitme.info')}}');
		var url = '{{ route("marital-statuses.edit", [':id']) }}';
		url = url.replace(':id', id);
		var data = {'id': id};
		$.ajax({
			url: url,
			type: "GET",
			data: data
		})
			.success(function (res) {
				$('#editMaritalStatusModal').waitMe('hide');
				//populate form fields
                $('#btnUpdate').removeClass('disabled');
				$('#edit_id').val(res.data.id);
				$('#editMaritalStatusForm #name').val(res.data.name);
				$('#editMaritalStatusForm #description').val(res.data.description);
			})
	}

	/**
	 * DELETE
	 * @param id
	 */
	function deleteMaritalStatus(id) {
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
					var url = '{{ route("marital-statuses.destroy", [':id']) }}';
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

					var url = '{{ url('api/cpanel/general/marital-statuses/change-status') }}/' + id;
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
