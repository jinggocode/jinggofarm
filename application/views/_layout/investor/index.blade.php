<?php
if (!$this->ion_auth->logged_in())
{
  // redirect them to the login page
  redirect('auth/login', 'refresh');
}

$user = $this->ion_auth->user()->row();

if ($user->group_id == 1){
    redirect('auth/logout', 'refresh');
} else if ($user->group_id == 2){
    redirect('auth/logout', 'refresh');
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>@yield('title') | Beternak Online Mudah dan Menguntungkan!</title>
  <meta charset="utf-8">
  <meta name="theme-color" content="#0D47A1" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Favicon-->
  <link rel="shortcut icon" href="{{base_url('assets/img/favicon.png')}}">
  <link rel="stylesheet" href="{{site_url()}}assets/font.css">

  <!-- MY css -->
  <link rel="stylesheet" href="{{base_url('assets/style.min.css')}}" type="text/css">
  <link rel="stylesheet" href="{{base_url('assets/investor/custom.css')}}" type="text/css">

    <!-- Load vendor -->
  <link rel="stylesheet" href="{{base_url()}}assets/vendor/progressive-image/css/progressive-image.css">
  <link rel="stylesheet" href="{{site_url()}}assets/investor/loadpage.css">
  <script type="text/javascript" src="{{site_url()}}assets/investor/js/pace.js"></script>
  <link rel="stylesheet" href="{{base_url()}}assets/vendor/fontawesome/css/font-awesome.min.css" type="text/css">

  @yield('style')
</head>

<body>
  @include('_layout/investor/navbar')

  @yield('content')

  <div class="fixed-bottom bg-secondary d-block d-md-none">
    @include('_layout/investor/navbar-responsive')
  </div>

  <div class="py-5 bg-dark text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <img src="{{base_url('assets/img/logo.png')}}" width="250">
          <p class="lead">CV. Nusantara Fresh Milk <br>
          Genteng, Banyuwangi</p>
        </div>
        <div class="col-4 col-md-1 align-self-center">
          <a href="https://www.facebook.com" target="_blank"><i class="fa fa-fw fa-facebook fa-3x text-white"></i></a>
        </div>
        <div class="col-4 col-md-1 align-self-center">
          <a href="https://twitter.com" target="_blank"><i class="fa fa-fw fa-twitter fa-3x text-white"></i></a>
        </div>
        <div class="col-4 col-md-1 align-self-center">
          <a href="https://www.instagram.com" target="_blank"><i class="fa fa-fw fa-instagram text-white fa-3x"></i></a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mt-3 text-center">
          <p>© Copyright 2018 Jinggofarm - All rights reserved.</p>
        </div>
      </div>
    </div>
  </div>

  @yield('modal')

  <script src="{{base_url()}}assets/vendor/jquery/jquery.min.js"></script>
  <script src="{{base_url()}}assets/vendor/umd/popper.min.js"></script>
  <script src="{{base_url()}}assets/vendor/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
  <script src="{{base_url()}}assets/vendor/sweetalert/sweetalert.min.js"></script>
  <script src="{{base_url()}}assets/vendor/progressive-image/js/progressive-image.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
  <script src="{{base_url('assets/vendor/jquery-loading/')}}dist/loadingoverlay.min.js"></script>
  <script>
  @if($this->session->userdata('message'))
    <?php $message = $this->session->userdata('message');?>
    function sweet(){
      swal("Informasi", "{{ $message[0] }}", "{{ $message[1] }}");
    }
    window.onload = sweet;
  @endif
    function faseDevelopment() {
      swal("Whoops Maaf, Masih dalam tahap pengembangan", "Doakan yaa :)", "success");
    }
  </script>

  @yield('script')

</body>

</html>
