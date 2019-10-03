@extends('master')
@section('active-dashboard','active')
@section('title-navbar','Dashboard')
@section('title','Dashboard')
@section('content')

<div class="container-fluid">
	<div class="row">
		
		<div class="col-lg-4 col-md-6 col-sm-6">
			<div class="card card-stats">
				<div class="card-header card-header-info card-header-icon">
					<div class="card-icon">
						<i class="material-icons">person</i>
					</div>
					<p class="card-category">TOTAL ADMIN</p>
					<h3 class="card-title" id="total_admin"></h3>
				</div>
				<div class="card-footer">
					<div class="stats">
						<i class="material-icons">date_range</i>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-4 col-md-6 col-sm-6">
			<div class="card card-stats">
				<div class="card-header card-header-info card-header-icon">
					<div class="card-icon">
						<i class="material-icons">people</i>
					</div>
					<p class="card-category">TOTAL DRIVERS</p>
					<h3 class="card-title" id="total_driver"></h3>
				</div>
				<div class="card-footer">
					<div class="stats">
						<i class="material-icons">date_range</i>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-4 col-md-6 col-sm-6">
			<div class="card card-stats">
				<div class="card-header card-header-info card-header-icon">
					<div class="card-icon">
						<i class="material-icons">local_shipping</i>
					</div>
					<p class="card-category">TOTAL TRUCKS</p>
					<h3 class="card-title" id="total_truck"></h3>
				</div>
				<div class="card-footer">
					<div class="stats">
						<i class="material-icons">date_range</i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('js')
<script>
	$.ajax({
		url : "{{route('statistik')}}",
		method : "get",
		type : "json",
		success:function(data) {
			console.log(data);
			$('#total_admin').text(data.total_admin),
			$('#total_driver').text(data.total_driver),
			$('#total_truck').text(data.total_truck)
		}
	})
</script>


@endsection