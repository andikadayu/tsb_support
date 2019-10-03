<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ url('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{ url('images/logo_title.png') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="base_url" content="{{ asset('') }}" />
  <title>
   TSB SUPPORT | LOGIN
 </title>
 <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
 <!--     Fonts and icons     -->
 <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
 <!-- CSS Files -->
 <link href="{{ url('assets/css/material-dashboard.css?v=2.1.0')}}" rel="stylesheet" />
 <!-- <link href="{{ url('assets/css/styles.css?v=2.1.0')}}" rel="stylesheet" /> -->
</head>
<body class="off-canvas-sidebar">
  <div class="wrapper wrapper-full-page">
    <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('assets/img/login2.jpg'); background-size: cover; background-position: top center;">
      <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
            <form id="login-form" novalidate="novalidate">
              <div class="card card-login card-hidden">
                <div id="login-header" class="card-header card-header-info text-center">
                  <h4 class="card-title">Login</h4>
                </div>
                <div class="card-body ">
                  <span class="form-group bmd-form-group has-danger">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">face</i>
                        </span>
                      </div>
                      <input name="username" required="true" aria-required="true" type="text" class="form-control" placeholder="Username...">
                    </div>
                  </span>
                  <span class="form-group bmd-form-group has-danger">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">lock_outline</i>
                        </span>
                      </div>
                      <input name="password" required="true" aria-required="true" type="password" class="form-control" placeholder="Password...">
                    </div>
                  </span>
                </div>
                <div class="card-footer justify-content-center">
                  <button type="submit" id="login-button" class="btn btn-info btn-link btn-lg">LOGIN</button>
                </div>
              </div>
            </form>
          </div>
        </div>          
      </div>
    </div>
  </div>
</div>

<!--   Core JS Files   -->
<script src="{{ url('assets/js/Chart.js')}}"></script>
<script src="{{ url('assets/js/core/jquery.min.js') }}"></script>
<script src="{{ url('assets/js/core/popper.min.js') }}"></script>
<script src="{{ url('assets/js/core/bootstrap-material-design.min.js') }}"></script>
<script src="{{ url('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
<!-- Chartist JS -->
<script src="{{ url('assets/js/plugins/chartist.min.js') }}"></script>
<!--  Notifications Plugin    -->
<script src="{{ url('assets/js/plugins/bootstrap-notify.js') }}"></script>
<script src="{{ url('assets/js/jquery.validate.min.js') }}"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ url('assets/js/material-dashboard.js?v=2.1.0') }}" type="text/javascript"></script>
<script>
 
</script>
<script>
  const BASE_URL = $("meta[name='base_url']").attr("content");
  const CSRF = $('meta[name="csrf-token"]').attr('content');
</script>
<script>
  $(document).ready(function() {
    md.checkFullPageBackgroundImage();
    setTimeout(function() {
        // after 1000 ms we add the class animated to the login/register card
        $('.card').removeClass('card-hidden');
      }, 700);
  });

  $('#login-form').submit(function (e) {
    e.preventDefault();
    var is_valid = $("#login-form").valid();
    if(is_valid) proses_login();
  });

  function show_notif(type, message) {

    $.notify({
      icon: "notification_important",
      message: "User is not valid"

    }, {
      type: "warning",
      timer: 3000,
      placement: {
        from: "top",
        align: "right"
      }
    });

  }

  function proses_login() {

    var object = {};
    object.headers = {};
    object.headers['X-CSRF-TOKEN'] = CSRF;
    object.url = `{{ route('postLogin') }}`;
    object.data = new FormData($('#login-form')[0]);
    object.type = 'POST';
    object.processData = false;
    object.contentType = false;
    object.success = function (result) {
      if(result.status == "success"){
        location.href = `${BASE_URL}${result.redirect_route}`;
        return;
      }

      show_notif("danger", "User is not valid")

    }

    $.ajax(object)
  }


  function setFormValidation(id) {
    $(id).validate({
      highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
        $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
      },
      errorPlacement: function(error, element) {
        error.addClass('pull-right').css('margin-top', '10px');
        $(element).closest('.form-group').append(error);
      },
    });
  }

  $(document).ready(function() {
    setFormValidation('#login-form');
  });


</script>
</body>

</html>
