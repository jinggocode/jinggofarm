@layout('_layout/index')

@section('title')Beranda @endsection

@section('style')
<style> 
#gallery .box {
    cursor: pointer;
    float: left;
    position: relative;
    overflow: hidden;
    -webkit-box-shadow: 1px 1px 1px 1px #ccc;
    -moz-box-shadow: 1px 1px 1px 1px #ccc;
    box-shadow: 1px 1px 1px 1px #ccc;
}

#gallery .box img {
    left: 0;
    -webkit-transition: all 300ms ease-out;
    -moz-transition: all 300ms ease-out;
    -o-transition: all 300ms ease-out;
    -ms-transition: all 300ms ease-out;
    transition: all 300ms ease-out;
}
#gallery .box img:hover {
    opacity: 0.7;
    filter: alpha(opacity=50); /* For IE8 and earlier */
}
#gallery .box .caption {
    background-color: rgba(0,0,0,0.8);
    position: absolute;
    color: #fff;
    z-index: 100;
    -webkit-transition: all 300ms ease-out;
    -moz-transition: all 300ms ease-out;
    -o-transition: all 300ms ease-out;
    -ms-transition: all 300ms ease-out;
    transition: all 300ms ease-out;
    left: 0;
}
#gallery .simple-caption {
    height: 30px;
    width: 100%;
    display: block;
    bottom: -30px;
    line-height: 25pt;
    text-align: center;
}
#gallery .box:hover .simple-caption {
    -moz-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    -webkit-transform: translateY(-100%);
    transform: translateY(-100%);
}
.full-width-div {
    position: absolute;
    width: 100%;
    left: 0;
}
.wt-1{
  font-weight: 800;
}
</style>
@endsection

@section('content')
<div class="py-5 gradient-overlay full bg-secondary">
  <div class="container py-5">
    <div class="row">
      <!--<div class="col-md-3 text-white">
        <img class="img-fluid d-block mx-auto mb-5" src="https://pingendo.github.io/templates/sections/assets/footer_logo2.png"> </div>-->
      <div class="col-md-12 text-center text-white align-self-center">
        <h1 class="mb-4 display-4 text-center">Ayo! Berinvestasi Online Sapi Perah</h1>
        <p class="mb-1" style="font-size: 18px">Jinggofarm menghubungkan anda dengan Peternak Sapi Perah secara langsung!
        </p>
      </div>
    </div>
  </div>
</div>

<div class="py-5 bg-light">
  <div class="container">
    <h1 class="text-center mb-5">Mengapa <span class="text-secondary">Sapi Perah?</span></h1>

      <div class="row mt-5">
        <div class="col-md-4 align-self-center text-center p-4">
          <img src="{{base_url('assets/img/mengapa.png')}}" class="responsive-img"  width="225" alt=""></i>
          <h3 class="my-3">Penghasil Susu</h3>
          <p class="">Sapi Perah dapat menghasilkan susu per hari</p>
        </div>
        <div class="col-md-4 align-self-center text-center p-4">
          <img src="{{base_url('assets/img/mengapa 2.png')}}" class="responsive-img"  width="225" alt=""></i>
          <h3 class="my-3">Beranak</h3>
          <p class="">Sapi Perah dapat memiliki anak yang dapat dijual ataupun dikembangbiakkan</p>
        </div>
        <div class="col-md-4 align-self-center text-center p-4">
          <img src="{{base_url('assets/img/mengapa 3.png')}}" class="responsive-img"  width="225" alt=""></i>
          <h3 class="my-3">Daging</h3>
          <p class="">Sapi Perah dapat dijual ketika sudah tidak produktif lagi yaitu berupa</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="bg-secondary" style="background-image: url({{base_url('assets/img/Originals/header.jpg')}});">
  <div class="py-5 text-center text-white " style="background: rgba(0, 78, 163, 0.9)">
    <div class="container">
      <div class="my-4">
        <h1 class="text-center text-white">4 Tahapan investasi di <b>Jinggofarm</b></h1>
        <hr class="text-center border border-white" style="" align="center" width="10%">
      </div>
      <div class="row">
        <div class="p-4 col-md-3">
          <img src="{{base_url('assets/img/home/1.png')}}" class="responsive-img img-fluid" alt="">
          <h2 class="my-3 wt-1">Beri Dana</h2>
          <p>Pilih Ternak pada menu <b>Pilihan Investasi, </b>lalu lakukan pembiayaan sesuai yang anda inginkan</p>
        </div>
        <div class="col-md-3 p-4">
          <img src="{{base_url('assets/img/home/2.png')}}" class="responsive-img img-fluid" alt="">
          <h2 class="my-3 wt-1">Beternak</h2>
          <p>Dalam proses beternak, anda dapat memonitoring perkembangannya melalui smartphone</p>
        </div>
        <div class="col-md-3 p-4">
          <img src="{{base_url('assets/img/home/3.png')}}" class="responsive-img img-fluid" alt="">
          <h2 class="my-3 wt-1">Bagi Hasil</h2>
          <p>Jinggofarm akan membagi setiap hasil ternak yang diperoleh sesuai dengan perjanjian awal investasi</p>
        </div>
        <div class="col-md-3 p-4">
          <img src="{{base_url('assets/img/home/4.png')}}" class="responsive-img img-fluid" alt="">
          <h2 class="my-3 wt-1">Ambil Dana</h2>
          <p>Ambil uang yang diperolah dari setiap investasi</p>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="text-dark py-3">
  <div class="container">
    <div class="row mb-3">
      <div class="col-md-12">
        <h1 class="text-center pt-5"><span class="text-secondary"><strong>Pilihan Investasi</strong></span> di Jinggofarm</h1>
        <hr class="text-center border border-dark" style="" align="center" width="10%">
      </div>
    </div>
    <div class="row">

      @foreach($ternak as $value)
        <div class="col-md-4 my-3 card-fit" onclick="window.location.href='{{site_url('cattle/view/'.$value->id.'/'.$value->slug)}}'" style="cursor: pointer;">
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

    <div class="row">
      <div class="col-md-12" align="center">
        <a href="{{site_url('cattle')}}" class="btn btn-primary text-center btn-lg my-4 text-white">Lihat Semua Investasi <i class="fa fa-arrow-right"></i></a>
      </div>
    </div>
  </div>
</div>
<div class="py-5"  style="background-color: #E8EAF6">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center display-4 my-4">Mengapa Investasi di Jinggofarm</h1>
        <p class="text-center">Jangan ragu untuk mulai Investasi!</p>
      </div>
    </div>
    <div class="row">
      <div class="py-5 col-md-6">
        <div class="row">
          <div class="text-center col-4">
            <img src="{{base_url('assets/img/mengapa/menguntungkan.png')}}" class="responsive-img"  width="90" alt=""></i>
          </div>
          <div class="col-8">
            <h5 class="mb-3 text-primary"><b>Menguntungkan</b></h5>
            <p class="my-1">Sapi Perah setiap hari menghasilkan susu lebih dari 15 Liter per hari. Nikmati profit harian dari penjualan susu</p>
          </div>
        </div>
      </div>
      <div class="py-5 col-md-6">
        <div class="row">
          <div class="text-center col-4">
            <img src="{{base_url('assets/img/mengapa/aman.png')}}" class="responsive-img"  width="90" alt="">
          </div>
          <div class="col-8">
            <h5 class="mb-3 text-primary"><b>Investasi Mudah dan Aman</b></h5>
            <p class="my-1">Jinggofarm dibuat untuk mempermudah proses Investasi dan dengan keamanan yang terjamin</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="py-5 col-md-6">
        <div class="row">
          <div class="text-center col-4">
            <img src="{{base_url('assets/img/mengapa/realtime.png')}}" class="responsive-img"  width="90" alt=""></i>
          </div>
          <div class="col-8">
            <h5 class="mb-3 text-primary"><b>Real Time Monitoring</b></h5>
            <p class="my-1">Pantau perkembangan ternak investasi secara langsung melalui kamera CCTV 24 jam, serta akan dikirimkan data seperti penggunaan dana dan perkembangan ternak per minggu</p>
          </div>
        </div>
      </div>
      <div class="py-5 col-md-6">
        <div class="row">
          <div class="text-center col-4">
            <img src="{{base_url('assets/img/mengapa/sosial.png')}}" class="responsive-img"  width="90" alt=""></i>
          </div>
          <div class="col-8">
            <h5 class="mb-3 text-primary"><b>Investasi berdampak Sosial</b></h5>
            <p class="my-1">Investasi anda akan dapat mensejahterakan masyarakat desa yang bekerja sebagai petani. Membantu dalam menciptakan lapangan pekerjaan sehingga perekonomian akan berkembang</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div>
  <div class="container-fluid">
    <div class="row" id="gallery">
      <div class="p-0 col-md-4 col-6 box">
        <a class="progressive replace" href="{{base_url('assets/img/gallery/gambar-1.JPG')}}"  >
          <img src="{{base_url('assets/img/gallery/gambar-1.JPG')}}" class="img-fluid preview">
        </a>
        <span class="caption simple-caption">
          <p>Kunjungan Bupati Banyuwangi</p>
        </span>
      </div>
      <div class="col-md-4 col-6 p-0 box">
        <a class="progressive replace" href="{{base_url('assets/img/gallery/gambar-2.jpg')}}">
          <img src="{{base_url('assets/img/gallery/gambar-2.jpg')}}" class="img-fluid preview">
        </a>
        <span class="caption simple-caption">
          <p>Suasana Kelompok Ternak</p>
        </span>
      </div>
      <div class="col-md-4 col-6 p-0 box">
        <a class="progressive replace" href="{{base_url('assets/img/gallery/gambar-3.jpeg')}}"  >
          <img src="{{base_url('assets/img/gallery/gambar-3.jpeg')}}" class="img-fluid preview">
        </a>
        <span class="caption simple-caption">
          <p>Kelompok Ternak Sumber Lumintu</p>
        </span>
      </div>
      <div class="col-md-4 col-6 p-0 box">
        <a class="progressive replace" href="{{base_url('assets/img/gallery/gambar-4.jpg')}}"  >
          <img src="{{base_url('assets/img/gallery/gambar-4.jpg')}}" class="img-fluid preview">
        </a>
        <span class="caption simple-caption">
          <p>Hasil Olahan Susu</p>
        </span>
      </div>
      <div class="col-md-4 col-6 p-0 box">
        <a class="progressive replace" href="{{base_url('assets/img/gallery/gambar-5.JPG')}}"  >
          <img src="{{base_url('assets/img/gallery/gambar-5.JPG')}}" class="img-fluid preview">
        </a>
        <span class="caption simple-caption">
          <p>Kunjungan Dinas Peternakan</p>
        </span>
      </div>
      <div class="col-md-4 col-6 p-0 box">
        <a class="progressive replace" href="{{base_url('assets/img/gallery/gambar-6.jpeg')}}"  >
          <img src="{{base_url('assets/img/gallery/gambar-6.jpeg')}}" class="img-fluid preview">
        </a>
        <span class="caption simple-caption">
          <p>Sapi Fresian Holstein (FH)</p>
        </span>
      </div>
    </div>
  </div>
</div>
@endsection
