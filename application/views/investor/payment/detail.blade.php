@layout('_layout/investor/index')

@section('title')Detail Pembayaran {{$data->kode_transaksi}}@endsection 
  
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

        <?php if($data->status == 1) { ?>
          <div class="alert alert-primary" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
            <h4 class="alert-heading">Pembayaran anda pada tahap validasi admin</h4>
            <p class="mb-0">Mohon menunggu :)</p>
          </div>
        <?php } else if($data->status == 3) { ?>
          <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
            <h4 class="alert-heading mb-3">Pembayaran anda Valid, silahkan cek daftar ternak anda!</h4> 
            <a href="{{site_url('investor/mycattle')}}" class="btn btn-primary">Ternak Saya</a>
          </div> 
        <?php } else if($data->status == 4) { ?>
          <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
            <h4 class="alert-heading">Pembayaran anda tidak Valid, dikarenakan bukti transfer yang anda kirim tidak sesuai</h4>
            <p class="mb-3">Silahkan hubungi kami bila ini salah</b></p>
            <a href="{{site_url()}}" class="btn btn-primary">Hubungi Kami</a>
          </div> 
        <?php } else if($data->status == 5) { ?>
          <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
            <h4 class="alert-heading">Pembayaran anda kurang, silahkan lakukan transfer kembali susuai jumlah yang kurang. Jika telah melakukan transfer, segera hubungi admin. Terima Kasih</h4>
            <p class="mb-3">Silahkan hubungi kami bila ini salah</b></p>
            <a href="{{site_url('investor/contact')}}" class="btn btn-primary">Hubungi Kami</a>
          </div>
        <?php } ?>

        <div class="row">
          <div class="col-md-6">

            <table class="table table-striped">
              <tbody>
                <tr>
                  <td style="width: 40%">
                    <h5>Metode Pembayaran</h5>
                  </td>
                  <td>Transfer Bank</td>
                </tr> 
                <tr>
                  <td style="width: 40%">
                    <h5>Nama Rekening</h5>
                  </td>
                  <td>{{$data->nama_transfer}}</td>
                </tr> 
                <tr>
                  <td>
                    <h5>Nama Ternak</h5>
                  </td>
                  <td>{{$data->ternak->kategori->nama}}</td>
                </tr>
                <tr>
                  <td>
                    <h5>Jumlah Paket</h5>
                  </td>
                  <td>{{$data->unit}}</td>
                </tr>
                <tr>
                  <td>
                    <h5>Jumlah Bayar</h5>
                  </td>
                  <td>{{money($data->total)}}</td>
                </tr> 
              </tbody>
            </table>  

          </div>
          <div class="col-md-6"> 
            <p>Bukti Transfer yang anda kirim</p>
            <img class="img-fluid" src="{{base_url('uploads/bukti-transfer/'.$data->bukti_transfer)}}" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection