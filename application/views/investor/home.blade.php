@layout('_layout/investor/index')

@section('title')Beranda @endsection

@section('content')
<div class="py-5 bg-secondary">
  <div class="container py-1">
      <div class="row text-center">
        <!--<div class="col-md-3 text-white">
          <img class="img-fluid d-block mx-auto mb-5" src="https://pingendo.github.io/templates/sections/assets/footer_logo2.png"> </div>-->
        <div class="col-md-12 text-white align-self-center">
          <img src="{{base_url('assets/img/icon/cow.png')}}" width="90" class="img-fluid" alt="">
          <h4 class="mb-1 display-2 text-light" style=" line-height: 1.45; font-size: 30px">Selamat Datang <span class=" text-light">{{$nama_user}}</span> di Jinggofarm!</h4>
          <hr class="text-white border border-light" align="center" style="width: 10%">
        </div>
      </div>
  </div>
</div> 

<div class="py-4">
  <div class="container">
    @if (isset($transaksi))
      <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Selesaikan Transaksi anda sebelum <b>{{dateFormatBulan(3, $transaksi->batas_bayar)}}</b></h4>
        <p>Investasi {{$transaksi->ternak->kategori->nama}} <b>{{money($transaksi->total)}}</b></p>
        <hr>
        <p class="mb-0">
          <a href="{{site_url('investor/payment/view/'.$transaksi->kode_transaksi)}}" class="btn btn-primary">Lihat Selengkapnya</a>
          <a onclick="alert()" href="{{site_url('investor/payment/cancel/'.$transaksi->kode_transaksi)}}" class="btn btn-warning">Batalkan</a>
        </p>
      </div>
    @endif

    <div class="row">
      <div class="col-md-8">
        <div class="row mb-5">
          <div class="col-md-5">
            <div class="card border-secondary mb-3">
              <div class="card-body text-secondary text-center">
                <h5 class="card-title text-center">Jumlah Investasi</h5>
                <p align="center" class="card-text badge badge-secondary" style="font-size: 30px;"><b>{{$jumlah_ternak}}</b></p>
              </div>
              <div class="card-footer text-center">
                <a href="{{site_url('investor/mycattle')}}" class="btn btn-outline-secondary btn-block btn-block">Lihat</a>
              </div>
            </div>
          </div>
          <div class="col-md-7">
            <div class="card border-secondary mb-3">
              <div class="card-body text-secondary text-center">
                <h5 class="card-title text-center">Profit</h5>
                <p class="card-text text-center badge badge-secondary" style="font-size: 30px;"><b>{{money($saldo)}}</b></p>
              </div>
              <div class="card-footer text-center">
                <a href="{{site_url('investor/balance')}}" class="btn btn-outline-secondary btn-block btn-block">Lihat</a>
              </div>
            </div>
          </div>
        </div>

        <h2 class="">Pilihan Investasi Terbaik untuk Anda!</h2>
        <hr class="text-secondary border border-dark mx-0" style="width: 10%">

        <div class="row mb-5">

          @foreach($ternak as $value)
          <div class="col-md-6 my-3 card-fit" onclick="window.location.href='{{site_url('investor/cattle/view/'.$value->id.'/'.$value->slug)}}'" style="cursor: pointer;">
            <div class="card-deck">
              <div class="card-hover card border-secondary">
                <a class="progressive replace" href="{{base_url('uploads/cattle/img/'.$value->foto->nama_foto)}}" data-srcset="{{base_url('uploads/cattle/img/'.$value->foto->nama_foto)}} 800w, {{base_url('uploads/cattle/img/'.$value->foto->nama_foto)}} 1200w" data-sizes="100vw">
                  <img class="card-img-top preview" src="{{base_url('uploads/cattle/img/'.$value->foto->nama_foto)}}" alt="Card image cap">
                </a>
                <div class="card-body text-dark">
                  <h5 class="card-title" style="font-weight: 900">
                    <b>{{$value->kategori->nama}} ({{$value->jumlah_sapi}} Ekor)</b> <br>
                    {{($value->status == 0)?'<span class="badge badge-success mt-2 mb-2"><i class="fa fa-check"></i> Tersedia</span>':''}}
                    {{($value->sisa_unit == 0)?'<span class="badge badge-danger mt-2 mb-2"><i class="fa fa-times"></i> Paket Habis</span>':''}}
                  </h5>

                  <table class="table table-sm">
                    <tr>
                      <td>Jangka Waktu</td>
                      <td><b>{{$value->lama_periode}} Tahun</b></td>
                    </tr>
                    <tr>
                      <td>Jumlah Paket <i data-toggle="tooltip" data-placement="top" title="Paket merupakan hasil pembagian dari biaya ternak sesuai yang telah kami tentukan" class="fa fa-question-circle" ></i></td>
                      <td><b>{{$value->jumlah_unit}}</b></td>
                    </tr>
                    @if ($value->sisa_unit |= 0)
                      <tr>
                        <td>Sisa Paket</td>
                        <td><b>{{$value->sisa_unit}}</b></td>
                      </tr>
                    @endif
                    <tr>
                      <td>Biaya /Paket</td>
                      <td><b>{{money($value->biaya / $value->jumlah_unit)}}</b></td>
                    </tr>
                  </table>
                </div>

                <div class="card-footer">
                  <a href="{{site_url('cattle/view/'.$value->id.'/'.$value->slug)}}" class="card-link btn btn-block btn-secondary"><i class="fa fa-eye"></i> Lihat Selengkapnya</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            Informasi
          </div>
          <div class="card-body">
            <blockquote class="blockquote mb-0">
              @if ($info_akun == '0')
                <div class="alert alert-danger" role="alert">
                  <h3 align="center"><strong>Penting!</strong></h3>
                  Segera lakukan aktifasi akun anda, dengan cara cek email anda!
                </div>
              @else
                <p align="center">-tidak ada Informasi-</p>
              @endif

            </blockquote>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection 
 
@section('modal')
<div class="modal hide fade" id="infoNotif">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Haloo.. Selamat Datang!</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          Segera aktifkan Notifikasi untuk mendapatkan informasi terkini mengenai investasi anda di Jinggofarm!
          <div align="center" class="py-3">
            <button onclick="return getMsg()" type="submit" name="button" class="btn btn-primary" style="cursor: pointer;"><i class="fa fa-bell"></i> Aktifkan Notifikasi</button>
          </div>
          Setelah itu klik <b>Ijinkan</b> / <b>Allow</b>
          <div class="row pt-3">
            <div class="col-md-6">
              <h5>Smartphone</h5>
              <img src="{{base_url('assets/img/notifikasi/hp.JPG')}}" class="img-fluid" alt="">
            </div>
            <div class="col-md-6">
              <h5>Komputer</h5>
              <img src="{{base_url('assets/img/notifikasi/computer.JPG')}}" class="img-fluid" alt="">
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection 


@section('script')
<script>
  function alert() {
    swal({
      title: "Apakah anda yakin?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
  }
</script>
<script src="https://www.gstatic.com/firebasejs/4.13.0/firebase.js"></script>
  <script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyCmJHPz1COzm1tGUiztzTSQI7KDv8ixoOQ",
    authDomain: "jinggofarm-123.firebaseapp.com",
    databaseURL: "https://jinggofarm-123.firebaseio.com",
    projectId: "jinggofarm-123",
    storageBucket: "jinggofarm-123.appspot.com",
    messagingSenderId: "200273499431"
  };
  firebase.initializeApp(config);

  const messaging = firebase.messaging();

  function getMsg() {
    messaging.requestPermission().then(function() {
      return messaging.getToken();
    })
    .then(function(token) {

      $(document).ready(function(){
        $.ajaxSetup({
            data: {
                csrf_test_name: $.cookie('csrf_cookie_name')
            }
        });

        $.ajax({
            type:'POST',
            url:'<?php echo site_url('investor/home/store_token'); ?>',
            data:{token : token},
            success:function(data){
              $('#infoNotif').modal('hide');
              swal("Berhasil!", "Notifikasi Berhasil di Aktifkan", "success");
            }
        });
      });
    })
    .catch(function(err) {
      console.log('Unable to get permission to notify.', err);
    });

    messaging.onMessage(function(payload){
      console.log('onMessage',payload);
    })
  }
  </script>
  <script type="text/javascript">
      $(window).on('load',function(){
        console.log(Notification.permission);
        
        if (Notification.permission == "default") {
          $('#infoNotif').modal('show');
        }
      });
  </script>
@endsection
