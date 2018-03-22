<script>
	$(document).ready(function () {
		/*
         |--------------------------------------------------------------------------
         | Users Main List Grid
         |--------------------------------------------------------------------------
         | Standard grid to list Users
         */
		if ($('#usersMainTable').length) {

			var usersMainTable = $('#usersMainTable').DataTable({
				processing: true,
				serverSide: true,
				responsive: true,
				pageLength: 25,
				dom: "Blfrtip",
				ajax: '{{ url('api/users/get-users') }}',
				buttons: getDatatableButtons(),
				initComplete: function () {
					initComplete(usersMainTable)
				},
				columns: [
					{data: 'title', name: 'title'},
					{data: 'first_name', name: 'first_name'},
					{data: 'last_name', name: 'last_name'},
					{data: 'email', name: 'email'},
					{data: 'mobile', name: 'mobile'},
					{data: 'gender', name: 'gender'},
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
								'<i class="fa fa-user"></i>&nbsp;{{ trans_choice("general.profile",1) }}</a>&nbsp;' +
								'<a class="btn btn-xs ' + changeStatusBtnClass + '" onclick="changeStatus(' + data + ')">' +
								'<i class="fa fa-toggle-off"></i>&nbsp;' + changeStatusBtnTitle + '</a>&nbsp;' +
								'<a class="btn btn-xs btn-danger" onclick="deleteUser(' + data + ')">' +
								'<i class="fa fa-trash"></i>&nbsp;{{ trans("buttons.delete") }}</a>';
						}
					}
				],
			});
		}

		/*
        * SAVE USER
        * */
		$('#addUserForm').validator().on('submit', function (e) {
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
				var url = '{{ route("users.store") }}';
				$.ajax({
					url: url,
					type: "POST",
					data: $('#addUserForm').serialize()
				})
					.success(function (data) {
						if (data.user.id) {
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
        * UPDATE USER
        * */
		$('#editUserForm, #userSocialMediaForm').validator().on('submit', function (e) {
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
				var url = '{{ route("users.update", [':id']) }}';
				url = url.replace(':id', $('#edit_id').val());
				$.ajax({
					url: url,
					type: "PUT",
					data: $(this).serialize()
				})
					.success(function (data) {
						if (data.user.id) {
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

	/**
	 * DELETE USER
	 * @param id
	 */
	function deleteUser(id) {
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
					var url = '{{ route("users.destroy", [':id']) }}';
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
							swal("{{ trans('alerts.error') }}", data.responseJSON.message, "error");
						});
				}
			});
	}

	/**
	 * CHANGE USER STATUS
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

					var url = '{{ url('api/users/change-user-status') }}/' + id;
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
