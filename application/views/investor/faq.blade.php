@layout('_layout/investor/index')

@section('title')FAQ@endsection

@section('style') 
@endsection

@section('content') 
<div class="text-center opaque-overlay bg-primary">
  <div class="container py-5">
    <div class="row">
      <div class="col-md-12 text-white">
        <h1 style="margin-bottom: -4px" class="text-left display-5"><i class="fa fa-question-circle"></i>&nbsp;Pertanyaan Yang Sering Diajukan</h1>
        <hr class="text-white border border-light mx-0" style="width: 10%"> </div>
    </div>
  </div>
</div>
<div class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <h2>Tentang Jinggo.Farm</h2>
      </div>
      <div class="col-md-9">
        <div id="accordion">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-primary btn-block text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Apa itu Jinggo.Farm?
                </button>
              </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                Aplikasi yang menghubungkan peternak dengan investor sebagai pemberi modal. Melalui aplikasi ini Investor dapat merasakan beternak tanpa harus memiliki lahan dan pengalaman beternak. Setiap informasi kondisi ternak akan terpantau secara langsung dan Investor dapat melihat kapan saja melalui aplikasi.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-primary btn-block text-left collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Bagaimana sistem kerja Jinggo.Farm?
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                Aplikasi ini pada dasarnya adalah Jual Beli hewan ternak. Dimana investor sebagai pemilik ternak dan peternak sebagai perawat ternak. Sehingga hasil keuntungan beternak akan dilakukan proses bagi hasil yang adil antara investor dan peternak.
              </div>
            </div>
          </div> 
          <div class="card">
            <div class="card-header" id="heading3">
              <h5 class="mb-0">
                <button class="btn btn-primary btn-block text-left collapsed" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapseTwo">
                  Bagaimana cara menjadi investor?
                </button>
              </h5>
            </div>
            <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordion">
              <div class="card-body">
                Sebagai investor anda diwajibkan memiliki akun Jinggo.Farm, bila belum memiliki akun anda bisa melakukan <a href="{{site_url('auth/register')}}">Pendaftaran</a> terlebih dahulu. Selanjutnya pilih ternak yang akan anda berikan dana, lakukan pembayaran, konfirmasi pembayaran, dan anda akan memiliki hewan ternak.
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </div>
</div>
@endsection 