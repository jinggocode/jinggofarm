<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>Daftar | Jinggofarm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon-->
    <link rel="shortcut icon" href="{{base_url('assets/img/favicon.png')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{base_url('assets/style.css')}}" type="text/css">

    <link rel="stylesheet" href="{{base_url()}}assets/vendor/fontawesome/css/font-awesome.min.css" type="text/css">

    <link rel="stylesheet" href="{{site_url()}}assets/investor/loadpage.css">
    <script type="text/javascript" src="{{site_url()}}assets/investor/js/pace.js"></script>

    <title>Hello, world!</title>
  </head>

  <body style="background-image: url(&quot;{{base_url('assets/img/bg6.png')}}&quot;); background-size: cover; background-position: center center;
          background-repeat:  no-repeat;
          background-attachment: fixed;">
    <div class="py-5 container">
      <div class="row">
        <div class="col-md-6 align-self-center text-white">
          <img src="{{base_url('assets/img/logo.png')}}" class="responsive-img" width="200" alt="">
          <h1 class="text-md-left pt-3" style="font-size: 50px">Investasi Berdampak</h1>
          <p class="lead text-light">Ayo berinvestasi di Jinggofarm! Setiap investasi anda mensejahterakan mereka yang kurang mampu</p>
        </div>
        <div class="col-md-6" id="book">
          <div class="card py-3" style="background: rgba(255, 255, 255, 0.7)">
            <div class="card-body">

              <?php if ($message): ?>
              @if ($message[0] == '<')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Peringatan!</strong><br> <?php echo $message; ?>
                </div>
              @else
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Peringatan!</strong><br> <?php echo $message[0]; ?>
                </div>
              @endif
              <?php endif ?>

              <h3 class="mb-1">Pendaftaran</h3>
              <hr class="secondary border-secondary mx-0" style="border-width: 5px; width: 8%; margin-top: 2px; margin-bottom: 10px">

               <p align="center">Sudah punya akun? <a class="btn btn-primary" href="{{site_url('auth')}}"><i class="fa fa-external-link"></i> Masuk</a></p>
              <form method="post" action="{{site_url('auth/create_user')}}">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />

                <div class="form-group"> <label>Nama</label>
                  <?php echo form_input($first_name);?>
                </div>
                <div class="form-group"> <label>Email</label>
                  <?php echo form_input($email);?>
                </div>
                <div class="form-group"> <label>Nomor HP</label>
                  <?php echo form_input($phone);?>
                </div>
                <div class="form-group"> <label>Password</label>
                  <?php echo form_input($password);?>
                </div>
                <div class="form-group"> <label>Ulangi Password</label>
                  <?php echo form_input($password_confirm);?>
                </div>

                <button type="submit" class="btn mt-2 btn-secondary"><i class="fa fa-send"></i> Daftar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="{{base_url()}}assets/vendor/jquery/jquery.min.js"></script>
      <script src="{{base_url()}}assets/vendor/umd/popper.min.js"></script>
      <script src="{{base_url()}}assets/vendor/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
  </body>
</html>
