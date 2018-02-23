<script>
	$(document).ready(function () {
		/*
         |--------------------------------------------------------------------------
         | Countries Main List Grid
         |--------------------------------------------------------------------------
         | Standard grid to list countries
         */
		if ($('#countriesMainTable').length) {

			var countriesMainTable = $('#countriesMainTable').DataTable({
				processing: true,
				serverSide: true,
				responsive: true,
				pageLength: 25,
				dom: "Blfrtip",
				ajax: '{{ url('api/cpanel/general/countries/get-countries') }}',
				buttons: getDatatableButtons(),
				initComplete: function () {
					initComplete(countriesMainTable)
				},
				columns: [
					{data: 'name', name: 'name'},
					{data: 'capital', name: 'capital'},
					{data: 'citizenship', name: 'citizenship'},
					{data: 'country_code', name: 'country_code'},
					{data: 'calling_code', name: 'calling_code'},
					{data: 'currency', name: 'currency'},
					{data: 'currency_symbol', name: 'currency_symbol'},
					{data: 'iso_3166_2', name: 'iso_3166_2'},
					{data: 'iso_3166_3', name: 'iso_3166_3'},
					{data: 'flag', name: 'flag'},
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
							return '' +
								'<a class="btn btn-xs btn-info" onclick="editCountry('+ data +')">' +
								'<i class="fa fa-pencil"></i>&nbsp;{{ trans("buttons.edit") }}</a>&nbsp;' +
								'<a class="btn btn-xs ' + changeStatusBtnClass + '" onclick="changeStatus(' + data + ')">' +
								'<i class="fa fa-toggle-off"></i>&nbsp;' + changeStatusBtnTitle + '</a>&nbsp;' +
								'<a class="btn btn-xs btn-danger" onclick="deleteCountry(' + data + ')">' +
								'<i class="fa fa-trash"></i>&nbsp;{{ trans("buttons.delete") }}</a>';
						}
					}
				],
			});
		}

		/*
        * SAVE
        * */
		$('#addCountryForm').validator().on('submit', function (e) {
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
				var url = '{{ route("countries.store") }}';
				$.ajax({
					url: url,
					type: "POST",
					data: $('#addCountryForm').serialize()
				})
					.success(function (data) {
						if (data.country.id) {
							$('#addCountryModal').modal('hide');
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
		$('#editCountryForm').validator().on('submit', function (e) {
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
				var url = '{{ route("countries.update", [':id']) }}';
				url = url.replace(':id', $('#edit_id').val());
				$.ajax({
					url: url,
					type: "PUT",
					data: $('#editCountryForm').serialize()
				})
					.success(function (data) {
						if (data.country.id) {
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
	function editCountry(id) {
		$('#editCountryModal').modal('show');
		waitBusy('editCountryModal', '{{config('waitme.info')}}');
		var url = '{{ route("countries.edit", [':id']) }}';
		url = url.replace(':id', id);
		var data = {'id': id};
		$.ajax({
			url: url,
			type: "GET",
			data: data
		})
			.success(function (res) {
				$('#editCountryModal').waitMe('hide');
				//populate form fields
				$('#btnUpdate').removeClass('disabled');
				$('#edit_id').val(res.data.id);
				$('#editCountryForm #name').val(res.data.name);
				$('#editCountryForm #full_name').val(res.data.full_name);
				$('#editCountryForm #capital').val(res.data.capital);
				$('#editCountryForm #citizenship').val(res.data.citizenship);
				$('#editCountryForm #country_code').val(res.data.country_code);
				$('#editCountryForm #calling_code').val(res.data.calling_code);
				$('#editCountryForm #currency').val(res.data.currency);
				$('#editCountryForm #currency_symbol').val(res.data.currency_symbol);
				$('#editCountryForm #iso_3166_2').val(res.data.iso_3166_2);
				$('#editCountryForm #iso_3166_3').val(res.data.iso_3166_3);
				$('#editCountryForm #flag').val(res.data.flag);
			})
	}
	/**
	 * DELETE
	 * @param id
	 */
	function deleteCountry(id) {
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
					var url = '{{ route("countries.destroy", [':id']) }}';
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
	 * CHANGE  STATUS
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

					var url = '{{ url('api/cpanel/general/countries/change-status') }}/' + id;
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
