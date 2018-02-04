<script>
    $(document).ready(function () {
		/*
        * SAVE STATUS
        * */
		$('#addEditStatusForm').validator().on('submit', function (e) {
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
				var url = '{{ route("status.store") }}';
				waitBusy('app_wrapper', '{{config('waitme.success')}}');
				$.ajax({
					url: url,
					type: "POST",
					data: $('#addEditStatusForm').serialize()
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
	function editStatus(id) {
		waitBusy('app_wrapper','{{config('waitme.info')}}');
		var url = '{{ route("status.edit", [':status_id']) }}';
		url = url.replace(':status_id', id);
		var data = {'status_id': id};
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
				$('#title').val(res.data.title);
				$('#edit_id').val(res.data.id);
				$('#description').val(res.data.description);

			})
	}


	/* UPDATE STATUS */
	$('#btnUpdate').click(function () {
		waitBusy('app_wrapper','{{config('waitme.success')}}');
		var url = '{{ route("status.update",  [':status_id']) }}';
		url = url.replace(':status_id', $('#edit_id').val());
		$.ajax({
			url: url,
			type: "PUT",
			data: $('#addEditStatusForm').serialize()
		})
			.success(function (data) {
				$('#app_wrapper').waitMe('hide');
				location.reload(true);
			})
	});


	/*DELETE STATUS */
	function deleteStatus(id) {
		swal({
			title: "{{trans('alerts.confirm')}}",
			text: "{{trans('alerts.delete_text')}}",
			type: "question",
			showCancelButton: true,
			confirmButtonClass: "{{ config('sweetalerts.confirm_button_class') }}",
			cancelButtonColor: "{{ config('sweetalerts.confirm_button_color') }}",
			confirmButtonText: "{{ trans('alerts.confirm_button_text') }}"
		})
			.then(function (result) {
				waitBusy('app_wrapper','{{config('waitme.danger')}}');
				if (result.value) {
					var url = '{{ route("status.destroy", [':status_id']) }}';
					url = url.replace(':status_id', id);
					var data = {'status_id': id, '_token': "{{ csrf_token() }}"};
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
</script>