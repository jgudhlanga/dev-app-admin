<script>
	$(document).ready(function () {
		/*
         |--------------------------------------------------------------------------
         | Pages Grid
         |--------------------------------------------------------------------------
         */
		if ($('#pagesMainTable').length) {

			var pagesMainTable = $('#pagesMainTable').DataTable({
				processing: true,
				serverSide: true,
				responsive: true,
				pageLength: 25,
				dom: "Blfrtip",
				ajax: '{{ url('api/cpanel/modules/pages/get-pages') }}/'+ "@isset($module->id){{$module->id}}@endisset",
				buttons: getDatatableButtons(),
				initComplete: function () {
					initComplete(pagesMainTable)
				},
				columns: [
					{data: 'position', name: 'position'},
					{data: 'title', name: 'title'},
					{data: 'class', name: 'class'},
					{data: 'page_url', name: 'page_url'},
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
							if (full.status_id == "{{App\Models\General\Status::INACTIVE}}") {
								changeStatusBtnTitle = "{{trans('buttons.reactivate')}}";
								changeStatusBtnClass = "btn-success";
							}
							return '<a class="btn btn-xs btn-info" onclick="editPage('+ data +')">' +
								'<i class="fa fa-edit"></i>&nbsp;{{ trans("buttons.edit") }}</a>&nbsp;' +
								'<a class="btn btn-xs ' + changeStatusBtnClass + '" onclick="changeStatus(' + data + ')">' +
								'<i class="fa fa-toggle-off"></i>&nbsp;' + changeStatusBtnTitle + '</a>&nbsp;' +
								'<a class="btn btn-xs btn-danger" onclick="deletePage(' + data + ')">' +
								'<i class="fa fa-trash"></i>&nbsp;{{ trans("buttons.delete") }}</a>&nbsp;' +
								'<a class="btn btn-xs btn-default" onclick="orderPageUp(' + data + ')">' +
								'<i class="fa fa-arrow-circle-o-up text-success"></i>&nbsp;{{ trans("buttons.up") }}</a>&nbsp;' +
								'<a class="btn btn-xs btn-default" onclick="orderPageDown(' + data + ')">' +
								'<i class="fa fa-arrow-circle-o-down text-danger"></i>&nbsp;{{ trans("buttons.down") }}</a>';
						}
					}
				],
			});
		}

		/*
        * SAVE PAGE
        * */
		$('#addPageForm').validator().on('submit', function (e) {
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
				var url = '{{ route("pages.store") }}';
				$.ajax({
					url: url,
					type: "POST",
					data: $('#addPageForm').serialize()
				})
					.success(function (data) {
						if (data.page.id) {
							$('#addPageModal').modal('hide');
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
        * UPDATE PAGE
        * */
		$('#editPageForm').validator().on('submit', function (e) {
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
				var url = '{{ route("pages.update", [':page_id']) }}';
				url = url.replace(':page_id', $('#edit_id').val());
				$.ajax({
					url: url,
					type: "PUT",
					data: $('#editPageForm').serialize()
				})
					.success(function (data) {
						if (data.page.id) {
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
	function editPage(id) {
		$('#editPageModal').modal('show');
		waitBusy('editPageModal', '{{config('waitme.info')}}');
		var url = '{{ route("pages.edit", [':id']) }}';
		url = url.replace(':id', id);
		var data = {'id': id};
		$.ajax({
			url: url,
			type: "GET",
			data: data
		})
			.success(function (res) {
				$('#editPageModal').waitMe('hide');
				//populate form fields
				$('#btnUpdate').removeClass('disabled');
				$('#edit_id').val(res.data.id);
				$('#editPageForm #title').val(res.data.title);
				$('#editPageForm #page_url').val(res.data.page_url);
				$('#editPageForm #class').val(res.data.class);
				$('#editPageForm #description').val(res.data.description);
			})
	}

	/**
	 * DELETE PAGE
	 * @param id
	 */
	function deletePage(id) {
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

					var url = '{{ route("pages.destroy", [':page_id']) }}';
					url = url.replace(':page_id', id);
					var data = {'page_id': id, '_token': "{{ csrf_token() }}"};
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
	 * CHANGE PAGE STATUS
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

					var url = '{{ url("api/cpanel/modules/pages/change-page-status") }}/'+ id;
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

	/**
	 * ORDER PAGE UP
	 * @param id
	 */
	function orderPageUp(id) {
		swal({
			title: "{{ trans('alerts.confirm') }}",
			text: "{{ trans('modules.pages.alerts.order_up') }}",
			type: 'warning',
			showCancelButton: true,
			confirmButtonClass: "{{ config('sweetalerts.confirm_button_class') }}",
			cancelButtonColor: "{{ config('sweetalerts.confirm_button_color') }}",
			confirmButtonText: "{{ trans('alerts.confirm_button_text') }}"
		})
			.then(function (result) {
				if (result.value) {

					waitBusy('app_wrapper', '{{config('waitme.info')}}');

					var url = '{{ url("api/cpanel/modules/pages/order-pages") }}/' + id;
					var data = {'page_id': id, 'direction':'up', '_token': "{{ csrf_token() }}"};
					$.ajax({
						url: url,
						type: "PUT",
						data: data
					})
						.success(function (data) {
							console.log(data);
							$('#app_wrapper').waitMe('hide');

							swal("{{ trans('alerts.success') }}",
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

	/**
	 * ORDER PAGES DOWN
	 * @param id
	 */
	function orderPageDown(id) {
		swal({
			title: "{{ trans('alerts.confirm') }}",
			text: "{{ trans('modules.pages.alerts.order_down') }}",
			type: 'warning',
			showCancelButton: true,
			confirmButtonClass: "{{ config('sweetalerts.confirm_button_class') }}",
			cancelButtonColor: "{{ config('sweetalerts.confirm_button_color') }}",
			confirmButtonText: "{{ trans('alerts.confirm_button_text') }}"
		})
			.then(function (result) {
				if (result.value) {

					waitBusy('app_wrapper', '{{config('waitme.info')}}');

					var url = '{{ url("api/cpanel/modules/pages/order-pages") }}/' + id;
					var data = {'direction':'down', '_token': "{{ csrf_token() }}"};
					$.ajax({
						url: url,
						type: "PUT",
						data: data
					})
						.success(function (data) {
							$('#app_wrapper').waitMe('hide');

							swal("{{ trans('alerts.success') }}",
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
