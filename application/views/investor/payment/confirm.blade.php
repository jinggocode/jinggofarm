@layout('_layout/investor/index')

@section('title')Konfirmasi Bukti Transfer@endsection 
  
@section('content')  
<div class="text-center opaque-overlay bg-primary">
  <div class="container py-5">
    <div class="row">
      <div class="col-md-12 text-white">
        <h1 style="margin-bottom: -4px" class="text-left display-5"><i class="fa fa-money"></i>&nbsp;Konfirmasi Pembayaran</h1>
        <hr class="text-white border border-light mx-0" style="width: 20%"> </div>
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
        <?php } else { ?>
          <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
            <h4 class="alert-heading">Waktu pembayaran anda telah habis</h4>
            <p class="mb-0">Silahkan melakukan proses pencarian ternak lagi!</b></p>
          </div>
        <?php } ?>

        <div class="row">
          <div class="col-md-6">
            <div class="card"> 
              <div class="card-header bg-primary text-light border border-primary"><i class="fa fa-credit-card-alt"></i>&nbsp; Pilih Metode Pembayaran</div>
              <div class="card-body">
                <form class="" method="post" action="{{site_url('investor/payment/kirim_bukti')}}" enctype="multipart/form-data">
                  {{$csrf}}
                  {{form_hidden('kode_transaksi', $data->kode_transaksi)}}
                  
                  <div class="form-group">
                    <label for="nama_transfer">Atas Nama</label>
                    <input required="required" type="text" class="form-control" name="nama_transfer" id="nama_transfer" aria-describedby="emailHelp" placeholder="Nama Transfer"> 
                  </div>
                  <div class="form-group"> 
                    <label>Foto (*max 5mb)</label>
                    <input required="required" type="file" name="bukti_transfer" class="form-control"> 
                    <small id="bukti_transfer" class="form-text text-muted">Pastikan gambar jelas, tulisan dapat dibaca!</small>
                  </div>
              </div>
            </div> 
          </div>
          <div class="col-md-6">
            <p>Preview Upload Gambar</p>
            <img class="img-fluid image-preview d-block" >
            <p class="my-4">
              <button type="submit" class="btn btn-lg btn-block btn-success text-light" ><i class="fa fa-check-square-o"></i>&nbsp;Konfirmasi</button>
                </form>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
var articles = (function(){ 
    // bind events 
    $("[type='file']").on('change', eventPreviewGambar); 

    init(); 

    // Events  
    function eventPreviewGambar(event){
        readURL(event.target);
    } 

    function readURL(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.image-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

})();
</script>
@endsection