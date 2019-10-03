@extends('master')
@section('active-po','active')
@section('title','PO & PO List Management')
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-info card-header-icon">
          <div class="card-icon">
            <i class="material-icons">assignment_turned_in</i>
          </div>
          <div class="card-title">
            <h4>PO & PO List Management</h4>
          </div>
        </div>
        <div class="card-body no-gutters">
          <div class="col-md-12">
            <ul class="list-inline mt-2">
              <li class="list-inline-item">
                <input type="text" class="form-control w-100" name="cari_rcp" id="cari_rcp" placeholder="Search Receipt">
              </li>
              <li class="list-inline-item">
                <button type="button" onclick="data()" rel="tooltip" class="btn btn-info " data-original-title="Search Data" title="Search Data">
                  <i class="material-icons r-a">search</i>
                  Search
                </button>
              </li>
              <li class="list-inline-item float-right">
                <button type="button" rel="tooltip" class="btn btn-success" data-original-title="Save Data" title="Save Data" onclick="edit_sap()">
                  <i class="material-icons r-a">check</i>
                  Save
                </button>
              </li>
            </ul>
          </div>
          <div class="material-datatables" id="tbb">
            <table id="datatables" class="table table-striped table-bordered table-hover" cellspacing="0" width='100%' style='width:100%'>
              <thead>
                <tr>
                  <th hidden=""></th>
                  <th> <b class="font-weight-bold"> PO Number </b> </th>
                  <th> <b class="font-weight-bold"> PO Line / Item Number </b> </th>
                  <th> <b class="font-weight-bold"> Material Code </b> </th>
                  <th> <b class="font-weight-bold"> Material Name </b> </th>
                  <th> <b class="font-weight-bold"> Qty / Order Qty </b>  </th>
                </tr>
              </thead>  
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
        <!-- end content-->
      </div>
      <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
  </div>
</div>
</div>
@endsection
@section('js')
<script>
  function data() {
    var cari = document.getElementById('cari_rcp').value;
    tampil_rcp(cari);  
  }

  function tampil_rcp(rcp) {
    $.ajax({
      url : "{{route('get_receipt')}}",
      type : "get",
      data:{
        rcp : rcp
      },
      dataType:"html",
      success:function(data) {
        console.log(data);
        $('#tbb').html(data);
        $('#datatables').dataTable();
      }
    })
  }
</script>
<script>
  function edit() {
    var sap = document.getElementById('sap').value;
    edit_sap(sap);
  }

  function edit_sap() {
    $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: "{{route('edit_sap')}}",
              processData: false,
              contentType : false,
              data: new FormData($('#save_dt')[0]),
              type: 'post',
              success: function (result) {    
                if (result == 'sukses') {
                  $.notify({
                    icon: "notification_important",
                    message: "PO and PO Line Change Successfully"

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
                  $.notify({
                    icon: "notification_important",
                    message: "PO and PO Line Change Failed"

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
                $.notify(data, "error");
              }
            })
  }
</script>
@endsection