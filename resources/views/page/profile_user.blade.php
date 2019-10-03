@extends('master')

@section('title-navbar','User Profile')

@section('title','USER PROFILE')

@section('show-profile','show')

@section('active-profile','active')

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header card-header-icon card-header-info">
            <div class="card-icon">
              <i class="material-icons">perm_identity</i>
            </div>
            <h4 class="card-title">User Profile 
              <small class="category"></small>
            </h4>
          </div>
          <div class="card-body">
            <form method="post" id="save_profile" enctype="multipart/form-data">
              @foreach($show as $data)
              <div class="row">
                <div class="col-sm-8">
                  <input type="hidden" name="id_hidden" id="id_hidden" value="{{$data->id_user}}">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="bmd-label-floating">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$data->nama}}">
                      </div>
                    </div>
                  </div>                    
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="bmd-label-floating">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="{{$data->username}}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="bmd-label-floating">Password</label>
                        <input type="password" name="password" id="password" class="form-control" value="{{$data->password}}">
                      </div>
                    </div>
                  </div>
                </div>
              </div>                                          
              <a onclick="save_data()" class="btn btn-info" style="color: white">UPDATE PROFILE</a>                                                         
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-profile">
          <div class="card-avatar">
            <a href="#pablo">
              <img class="img" src="{{asset('assets/img/faces/avatar.jpg')}}" />
            </a>
          </div>
          <div class="card-body">
            <h6 class="card-category text-gray"></h6>
            <h4 class="card-title">{{$data->nama}}</h4>
            <p class="card-description">

            </p>
            
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  function save_data() {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{route('save_profile')}}",
      processData: false,
      contentType : false,
      data: new FormData($('#save_profile')[0]),
      type: 'post',
      success: function (result) {    
        if (result == 'sukses') {              
          $.notify({
            icon: "notification_important",
            message: "Change Profile Successfully"

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
          $('#addUser').modal('hide');
          $.notify({
            icon: "notification_important",
            message: "Change Profile Failed"

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