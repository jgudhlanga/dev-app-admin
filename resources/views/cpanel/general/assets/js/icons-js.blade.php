<script>
	$(document).ready(function () {
		/*
        * SAVE CLASS
        * */
		$('#addEditIconsForm').validator().on('submit', function (e) {
			if (e.isDefaultPrevented()) {
				swal({
					title: "{{ trans('alerts.error') }}",
					text: "{{ trans('alerts.form_error') }}",
					type:"error",
					allowOutsideClick: false
				});
			}
			else {
				e.preventDefault();
				waitBusy('app_wrapper', '{{config('waitme.success')}}');
				var url = '{{ route("icons.store") }}';
				$.ajax({
					url: url,
					type: "POST",
					data: $('#addEditIconsForm').serialize()
				})
					.success(function (data) {
						if (data.data.id) {
							$('#app_wrapper').waitMe('hide');
							swal("{{ trans('alerts.created') }}",
								data.message,
								"success"
							).then(function () {
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
	});
	/* EDIT BUTTON CLICK */
	function editClass(id) {
		waitBusy('app_wrapper', '{{config('waitme.info')}}');
		var url = '{{ route("icons.edit", [':class_id']) }}';
		url = url.replace(':class_id', id);
		var data = {'class_id': id};
		$.ajax({
			url: url,
			type: "GET",
			data: data
		})
			.success(function (res) {
				$('#app_wrapper').waitMe('hide');
				//show update button
				$('#btnUpdate').removeClass('hide');
				$('#btnSave').addClass('hide');

				//populate form fields
				$('#class').val(res.data.class);
				$('#edit_id').val(res.data.id);
			})
	}


	/* UPDATE CLASS */
	$('#btnUpdate').click(function () {
		waitBusy('app_wrapper', '{{config('waitme.success')}}');
		var url = '{{ route("icons.update",  [':class_id']) }}';
		url = url.replace(':class_id', $('#edit_id').val());
		$.ajax({
			url: url,
			type: "PUT",
			data: $('#addEditIconsForm').serialize()
		})
			.success(function (data) {
				$('#app_wrapper').waitMe('hide');
				location.reload(true);
			})
	});


	/*DELETE CLASS*/
	function deleteClass(id) {
		swal({
			title: "{{trans('alerts.confirm')}}",
			text: "{{trans('alerts.delete_text')}}",
			type: "question",
			showCancelButton: true,
			confirmButtonClass: "{{ config('sweetalerts.confirm_button_class') }}",
			cancelButtonColor: "{{ config('sweetalerts.confirm_button_color') }}",
			confirmButtonText: "{{ trans('alerts.confirm_button_text') }}",
			allowOutsideClick: false
		})
			.then(function (result) {
				if (result.value) {
					waitBusy('app_wrapper', '{{config('waitme.danger')}}');
					var url = '{{ route("icons.destroy", [':class_id']) }}';
					url = url.replace(':class_id', id);
					var data = {'class_id': id, '_token': "{{ csrf_token() }}"};
					$.ajax({
						url: url,
						type: "DELETE",
						data: data
					})
						.success(function (data) {
							$('#app_wrapper').waitMe('hide');
							location.reload(true);
						})

				}
			})
	}

	function changeStatus(id, status) {
		swal({
			title: "{{trans('alerts.confirm')}}",
			text: "{{trans('alerts.change_status_text')}}",
			type: "question",
			showCancelButton: true,
			confirmButtonClass: "{{ config('sweetalerts.confirm_button_class') }}",
			cancelButtonColor: "{{ config('sweetalerts.confirm_button_color') }}",
			confirmButtonText: "{{ trans('alerts.confirm_button_text') }}",
			allowOutsideClick: false
		})
			.then(function (result) {
				waitBusy('app_wrapper','{{config('waitme.warning')}}');
				if (result.value) {
					var url = '{{ url("api/cpanel/general/icons/change-status") }}/'+ id;
					var data = {status_id: status, '_token': "{{ csrf_token() }}"};
					$.ajax({
						url: url,
						type: "PUT",
						data: data
					})
						.success(function (data) {
							$('#app_wrapper').waitMe('hide');
							swal({
                                title: data.title,
                                text: data.message,
                                type: "success"
                                }
							).then(function () {
								location.reload(true);
							});
						})

				}
			})
	}
</script>