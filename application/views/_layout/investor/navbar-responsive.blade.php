<div class="container">
  <?php $page = $this->uri->segment(2); ?>
  <div class="row bg-primary">
    <div class="col-3 col-sm-3 nopadding"><a class="btn btn-primary btn-block {{($page == 'home' || $page == 'cattle')?'active':''}}" href="{{site_url('investor/home')}}"><i class="fa fa-lg fa-home"></i><br><span style="font-size: 12px">Beranda</span></a></div>
    <div class="col-3 col-sm-3 nopadding"><a class="btn btn-primary btn-block {{($page == 'mycattle')?'active':''}}" href="{{site_url('investor/mycattle')}}"><i class="fa fa-th-large"></i><br><span style="font-size: 12px">Ternakku</span></a></div>
    <div class="col-3 col-sm-3 nopadding"><a class="btn btn-primary btn-block {{($page == 'transaction' || $page == 'payment')?'active':''}}" href="{{site_url('investor/transaction')}}"><i class="fa fa-lg fa-file-text-o"></i><br><span style="font-size: 12px">Transaksi</span></a></div>
    <div class="col-3 col-sm-3 nopadding"><a class="btn btn-primary btn-block {{($page == 'balance')?'active':''}}" href="{{site_url('investor/balance')}}"><i class="fa fa-lg fa-money"></i><br><span style="font-size: 12px">Saldo</span></a></div>
  </div>
</div>