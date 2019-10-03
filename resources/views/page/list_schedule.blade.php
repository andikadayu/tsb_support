@extends('master')
@section('active-schedule','active')
@section('title-navbar','List Schedule')
@section('title','List Schedule')
@section('content')
<div class="container">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header card-header-info card-header-icon">
						<div class="card-icon">
							<i class="material-icons">assignment</i>
						</div>
						<div class="card-title">
							<h4>DATA</h4>                      
						</div>
					</div>
					<div class="card-body">
						<div class="toolbar">
							<div class="justify-content-center">							
								<input type="search" id="cari_tgl" class="form-control-sm w-25 datepicker" value="<?php echo date('Y/m/d'); ?>" placeholder="Search records" aria-controls="datatables">							
								<button type="search" id="search-button" class="btn btn-success btn-sm" onclick="cari_schedule()">SEARCH</button>				
							</div>
						</div>
						<div class="material-datatables" id="tbb">
							
						
						</div>
					</div>
				</div>
				<!-- end content-->
			</div>
			<!--  end card  -->
		</div>
		<!-- end col-md-12 -->
	</div>
	<!-- Modal Cancel -->
	<div class="modal fade" id="addReason" tabindex="-1" role="">
		<div class="modal-dialog modal-login" role="document">
			<div class="modal-content">
				<div class="card card-signup card-plain">
					<div class="modal-header">
						<div class="card-header card-header-info text-center">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								<i class="material-icons">clear</i>
							</button>

							<h4 class="card-title">Reason Cancelation</h4>                    
						</div>
					</div>
					<div class="modal-body">
						<form class="form" method="post" id="cancel_rec">
								<input type="text" name="cancel_by" value="{{session('id')}}" hidden="">
								<input type="text" name="receipt" id="tss" hidden="">
							<div class="card-body">
								<label id="ts" class="form-control-plaintext"></label>
								<div class="form-group ">
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text"><i class="material-icons">message</i></div>
										</div>
										<textarea class="form-control" cols="5" rows="5" id="reason" name="reason" placeholder="Reason to Cancel Schedule"></textarea>
									</div>
								</div>
								<div class="form-group ">
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text"><i class="material-icons">face</i></div>
										</div>
										<input type="text" name="req_by" class="form-control" placeholder="Requested By">
									</div>
								</div>
							</div>                    
						</div>
						<div class="modal-footer justify-content-center">
							<a onclick="cancel_data()" class="btn btn-info btn-link btn-wd btn-lg">Confirm</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Change Driver -->
	<div class="modal fade" id="upd_driv" tabindex="-1" role="">
		<div class="modal-dialog modal-login" role="document">
			<div class="modal-content">
				<div class="card card-signup card-plain">
					<div class="modal-header">
						<div class="card-header card-header-info text-center">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								<i class="material-icons">clear</i>
							</button>

							<h4 class="card-title">Update Driver and Truck</h4>                    
						</div>
					</div>
					<div class="modal-body">
						<form class="form" method="post" id="save_dt">
							<div class="card-body">
								<div class="form-group bmd-form-group">
									<div class="input-group">
										<label id="ss"> </label>
										<input type="text" name="receipt" id="rex" hidden="">
									</div>
								</div>
								<div id="drvtrk">
									
								</div>
							</div>                    
						</div>
						<div class="modal-footer justify-content-center">
							<a onclick="save_data()" class="btn btn-info btn-link btn-wd btn-lg">Submit</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('js')
<script>
	function cancel_data() {
		var rc = document.getElementById('ts').innerHTML;

		Swal.fire({
			title: 'Are you sure?',
			text: 'You will Cancel this Schedule with  '+rc,
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes',
			cancelButtonText: 'No',
			confirmButtonClass: "btn btn-success",
			cancelButtonClass: "btn btn-danger",
			buttonsStyling: false
		}).then((result) => {
			if (result.value) {
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: "{{route('schedule_cancel')}}",
					processData: false,
					contentType : false,
					data: new FormData($('#cancel_rec')[0]),
					type: 'post',
					success: function (data) {    
						if (data == "sukses") {
							Swal.fire(
								'Success',
								'Schedule Cancelation Success',
								'success'
								)
							location.reload();
						}else{
							Swal.fire(
								'Failed',
								'Schedule Cancelation Failed',
								'error'
								)
						}

					},
					error : function (data) {            
						$.notify(data, "error");
					}
				})
			} else if (result.dismiss === Swal.DismissReason.cancel) {
				Swal.fire(
					'Failed',
					'Schedule Cancelation Failed',
					'error'
					)
			}
		})
	}
</script>
<script>
	$(document).ready(function () {
		var cari = document.getElementById('cari_tgl').value;
		tampil_list(cari);
	})

	function cari_schedule() {
		var cari = document.getElementById('cari_tgl').value;
		tampil_list(cari);
	}

	function tampil_list(cari) {
		console.log(cari);
		$.ajax({
			url : "{{route('tampil_list')}}",
			method : "GET",
			data :{
				cari : cari
			},
			dataType:"html",
			success:function (data) {
				console.log(data);
				$('#tbb').html(data);
				$('#datatables').dataTable();
			}
		})
	}
</script>
<script>
	function get_tamp(rec) {
		console.log(rec);
		$('#ts').text("Receipt No : "+rec);
		$('#tss').val(rec);

	}
</script>
<script>
	function get_ven(ven,re) {
		console.log(ven,re);
		$('#ss').text("Receipt No : "+re);
		$('#rex').val(re);
		$.ajax({
			url : "{{route('tampil_dt')}}",
			method : "GET",
			data : {
				rec : re,
				ven : ven
			},
			dataType : "html",
			success:function (data) {
				console.log(data);
				$('#drvtrk').html(data);
				$('#truk').selectpicker();
				$('#driver').selectpicker();
				$('#truk').selectpicker('refresh');
				$('#driver').selectpicker('refresh');
			}
		})
	}

	function save_data() {
		$.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: "{{ route('update_drvtrk')}}",
              processData: false,
              contentType : false,
              data: new FormData($('#save_dt')[0]),
              type: 'post',
              success: function (result) {    
                if (result == 'sukses') {
                  $('#upd_driv').modal('hide');
                  $.notify({
                    icon: "notification_important",
                    message: "Driver and Truck Change Successfully"

                  }, {
                    type: "success",
                    timer: 3000,
                    placement: {
                      from: "top",
                      align: "center"
                    }
                  });
                  location.reload();
                }else{
                  $('#upd_driv').modal('hide');
                  $.notify({
                    icon: "notification_important",
                    message: "Driver and Truck Change Failed"

                  }, {
                    type: "danger",
                    timer: 3000,
                    placement: {
                      from: "top",
                      align: "center"
                    }
                  });
                }
              },
              error : function (data) {
                $('#upd_driv').modal('hide');
                $.notify(data, "error");
              }
            })
	}
</script>
@endsection
