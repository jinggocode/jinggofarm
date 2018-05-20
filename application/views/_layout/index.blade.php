<?php
if ($this->ion_auth->logged_in())
{

  $user = $this->ion_auth->user()->row();

  if ($user->group_id == 3){
    redirect('investor/home', 'refresh');
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>@yield('title') | Beternak Online Mudah dan Menguntungkan!</title>
  <meta charset="utf-8">
  <meta name="theme-color" content="#0D47A1" />

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{base_url()}}assets/vendor/fontawesome/css/font-awesome.min.css" type="text/css">

  <!-- Favicon-->
  <link rel="shortcut icon" href="{{base_url('assets/img/favicon.png')}}">

  <!-- MY css -->
  <link rel="stylesheet" href="{{base_url('assets/style.min.css')}}" type="text/css">
  <link rel="stylesheet" href="{{base_url('assets/custom.css')}}" type="text/css">

  <!-- Load vendor -->
  <link rel="stylesheet" href="{{base_url()}}assets/vendor/progressive-image/css/progressive-image.css">
  <link rel="stylesheet" href="{{site_url()}}assets/investor/loadpage.css">
  <link rel="stylesheet" href="{{site_url()}}assets/font.css">
  <script type="text/javascript" src="{{site_url()}}assets/investor/js/pace.js"></script>

  @yield('style')

  <!--Start of Tawk.to Script-->
  <script type="text/javascript">
  // var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  // (function(){
  // var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  // s1.async=true;
  // s1.src='https://embed.tawk.to/5a866173d7591465c707b841/default';
  // s1.charset='UTF-8';
  // s1.setAttribute('crossorigin','*');
  // s0.parentNode.insertBefore(s1,s0);
  // })();
  </script>
  <!--End of Tawk.to Script-->
</head>

<body style="font-family: 'Quicksand', sans-serif;">
  @include('_layout/navbar')

  @yield('content')

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
  <script src="{{base_url()}}assets/vendor/progressive-image/js/progressive-image.js"></script>

  <script src="{{base_url()}}module/sw-controller.js"></script> 

  @yield('script')

</body>

</html>
