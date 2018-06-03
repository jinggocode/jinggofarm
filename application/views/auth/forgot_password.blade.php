<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Masuk | Jinggofarm</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Favicon-->
  <link rel="shortcut icon" href="{{base_url('assets/img/favicon.png')}}">

  <link rel="stylesheet" href="{{base_url()}}assets/vendor/fontawesome/css/font-awesome.min.css" type="text/css">

  <link rel="stylesheet" href="{{base_url('assets/style.css')}}" type="text/css">

  <link rel="stylesheet" href="{{site_url()}}assets/investor/loadpage.css">
  <script type="text/javascript" src="{{site_url()}}assets/investor/js/pace.js"></script>
</head>
  <style>
    body {
          background-image: url(<?php echo base_url('assets/img/background.png'); ?>) ;
          background-position: center center;
          background-repeat:  no-repeat;
          background-attachment: fixed;
          background-size:  cover;
          background-color: #999;
    }
    .btn:focus,.btn:active {
       outline: none !important;
       box-shadow: none;
    }
  </style>
<body>
  <div class="py-3">
    <div class="container">
      <div class="pb-4" align="center">
        <a href="{{site_url()}}"><img src="{{base_url('assets/img/logo-blue.png')}}" class="img-fluid" width="200 " alt=""></a>
      </div>
      <div class="row">
        <div class="col-md-4"> </div>
        <div class="col-md-4">
          <div class="card p-2" style="background: rgba(255, 255, 255, 0.7)">
            <div class="card-body">
              <h3 class="mb-1 text-secondary text-center"><i class="fa fa-lock"></i> Lupa Password</h3>
              <hr class="secondary border-secondary" style="border-width: 5px; width: 12%; margin-top: 10px; margin-bottom: 10px" align="center">

                <?php if ($message): ?>

                @if ($message[0] == '<')
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Peringatan!</strong><br> <?php echo $message; ?>
                  </div>
                @else
                  <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Pendaftaran Berhasil</strong><br> <?php echo $message[0]; ?>
                  </div>
                @endif
                <?php endif ?>

              <form method="post" action="{{site_url('auth/forgot_password')}}">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />

                <div class="form-group">
                    <label class="text-dark" for="identity">Email</label>
                    <?php echo form_input($identity);?>
                </div> 

                <div class="row">
                  <div class="col-12 col-sm-12 col-md-12">
                    <button type="submit" class="btn btn-block btn-secondary mb-2"><i class="fa fa-sign"></i><i class="fa fa-send"></i> Reset</button>
                  </div> 
                </div>

              </form>
              <p class="mt-3">Belum punya akun? </p>
              <a href="{{site_url('auth/create_user')}}" class="btn btn-warning btn-block"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{base_url()}}assets/vendor/jquery/jquery.min.js"></script>
  <script src="{{base_url()}}assets/vendor/umd/popper.min.js"></script>
  <script src="{{base_url()}}assets/vendor/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>

</body>

</html>
