@layout('_layout/investor/index')

@section('title')Pembayaran Pemberian Modal Ternak@endsection 
  
@section('content')   
<div class="text-center opaque-overlay bg-secondary">
  <div class="container py-5">
    <div class="row">
      <div class="col-md-12 text-white">
        <h1 class="text-left display-5"><i class="fa fa-money"></i> Pembayaran</h1>
        <hr class="text-white border border-light mx-0" width="7%">
      </div>
    </div>
  </div>
</div>
<div class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <?php if($data->status == 0) { ?>
          <div class="alert alert-warning" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
            <h4 class="alert-heading">Segera Lakukan Pembayaran!</h4>
            <p class="mb-0">Batas Waktu sampai dengan <b>{{dateFormatBulan(3, $data->batas_bayar)}}</b></p>
          </div>
        <?php }  if($data->status == 2) { ?>
          <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
            <h4 class="alert-heading">Waktu pembayaran anda telah habis</h4>
            <p class="mb-2">Silahkan melakukan proses pencarian ternak lagi!</b><br></p>
            <a href="{{site_url('investor/cattle')}}" class="btn btn-primary">Cari Ternak</a>
          </div>
        <?php } ?>

        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header bg-primary text-light border border-primary"><i class="fa fa-credit-card-alt"></i> Pilih Metode Pembayaran</div>
              <div class="card-body">
                <form class="">
                  <div class="form-group mx-4">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked=""> <label class="form-check-label" for="exampleRadios1" style="padding-left:0.25rem">
                      <h5>
                        Transfer Bank
                      </h5>
                    </label> </div>
                  <p class="mx-5"> <b>Bank Mandiri</b>
                    <br>A/n : CV. Sumber Lumintu
                    <br>No. Rekening : 143-352211351-0 </p>
                  <!--<div class="form-group mx-4">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked=""> <label class="form-check-label" for="exampleRadios1" style="padding-left:0.25rem">
                      <h5>
                        Saldo
                      </h5>
                    </label> </div>
                  <p class="mx-5"> Jumlah Saldo : <b>Rp. 10.000.000</b> </p>-->
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-body"> 
                <h4 class="text-dark"><i class="fa fa-exclamation-circle"></i> {{$data->ternak->kategori->nama}}</h4>
                <table class="table">
                  <tbody>
                    <tr class="border"> 
                      <td class="text-light"><b style="font-size:20px" class="text-dark">{{$data->unit}} Unit</b></td>
                      <td><b style="font-size:30px" class="text-dark">{{money($data->total)}}</b></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <p class="my-4">
              <a  aria-disabled="{{($data->status == 2)?'true':'false'}}" class="btn btn-lg btn-block btn-success text-light {{($data->status == 2)?'disabled':''}}" href="{{site_url('investor/payment/confirm/'.$data->kode_transaksi)}}"><i class="fa fa-check-square-o"></i> Sudah Bayar </a>
              <a  aria-disabled="{{($data->status == 2)?'true':'false'}}" class="btn btn-lg btn-block btn-danger text-light {{($data->status == 2)?'disabled':''}}" href="{{site_url('investor/payment/cancel/'.$data->kode_transaksi)}}" onclick="return confirm('Apakah anda yakin?');"><i class="fa fa-times-circle"></i> Batalkan </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection