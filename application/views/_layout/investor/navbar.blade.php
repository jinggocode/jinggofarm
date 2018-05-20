<nav class="navbar fixed-top navbar-expand-md bg-secondary navbar-dark" style="
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.15);">
  <a class="navbar-brand" href="{{site_url('investor/home')}}"><b>  <img src="{{base_url('assets/img/logo.png')}}" width="160"></b></a>
  <button class="btn btn-primary btn-lg bg-white text-secondary d-block d-md-none dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-lg fa-user"></i> </button>

  <div class="dropdown-menu btn-block border-dark">
    <a class="dropdown-item" href="{{site_url('investor/profile')}}">Lihat Profil</a> <hr>
    <a class="dropdown-item" href="{{site_url('auth/logout')}}"><i class="fa fa-reply-all"></i> Logout</a>
  </div>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto"> </ul>
    <?php $page = $this->uri->segment(2); ?>
    <ul class="navbar-nav right">
      <li class="nav-item {{($page == 'home' || $page == 'cattle')?'activet':''}}">
        <a class="nav-link {{($page == 'home' || $page == 'cattle')?'text-secondary':'text-light'}}" href="{{site_url('investor/home')}}"><i class="fa d-inline fa-lg fa-home"></i> Beranda</a>
      </li>
      <li class="nav-item {{($page == 'mycattle')?'activet':''}}">
        <a class="nav-link {{($page == 'mycattle')?'text-secondary':'text-light'}}" href="{{site_url('investor/mycattle')}}"><i class="fa d-inline fa-lg fa-th-large"></i> Ternakku</a>
      </li>
      <li class="nav-item {{($page == 'transaction' || $page == 'payment')?'activet':''}}">
        <a class="nav-link {{($page == 'transaction' || $page == 'payment')?'text-secondary':'text-light'}}" href="{{site_url('investor/transaction')}}"><i class="fa d-inline fa-lg fa-file-text-o"></i> Transaksi</a>
      </li>
      <li class="nav-item {{($page == 'balance')?'activet':''}}">
        <a class="nav-link {{($page == 'balance')?'text-secondary':'text-light'}}" href="{{site_url('investor/balance')}}"><i class="fa d-inline fa-lg fa-money"></i> Saldo</a>
      </li>
    </ul>
    <div class="btn-group px-3">
      <?php
      $user = $this->ion_auth->user()->row();
      ?>
      <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><i class="fa d-inline fa-lg fa-user-circle-o"></i>&nbsp; {{$user->first_name}} </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="{{site_url('investor/profile')}}">Lihat Profil</a> <hr>
        <a class="dropdown-item" href="{{site_url('auth/logout')}}"><i class="fa fa-reply-all"></i> Logout</a>
      </div>
    </div>
  </div>
</nav><br>
<div  style="margin-bottom: 38px">

</div>
