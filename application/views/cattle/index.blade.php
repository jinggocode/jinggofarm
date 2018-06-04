@layout('_layout/index')

@section('title')Pilihan Investasi @endsection

@section('style')
<style>
.bg{
  background-image: url({{base_url('assets/img/bg-list.jpg')}});
}
</style>
@endsection

@section('content')
<div class="bg">
  <div class="text-center opaque-overlay" style="background: rgba(0, 78, 163, 0.8)">
    <div class="container py-5 mt-3">
      <div class="row">
        <div class="col-md-12 text-white">
          <h1 class="display-4 mb-4 text-center"><b>Daftar Investasi di <b>Jinggofarm</b></b></h1>
          <hr class="text-white border border-light" align="center" style="width: 10%">
        </div>
      </div>
    </div>
  </div>
</div>
  <div class="text-dark py-3">
    <div class="container">
      <div class="row">

        @foreach($ternak as $value)
          <div class="col-md-4 my-3 card-fit" onclick="window.location.href='{{site_url('cattle/view/'.$value->id.'/'.$value->slug)}}'" style="cursor: pointer;">
            <div class="card-deck">
              <div class="card card-hover border-secondary">
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
                      <td>Lama Investasi</td>
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
                  <a href="{{site_url('cattle/view/'.$value->id.'/'.$value->slug)}}" class="card-link btn btn-block btn-success"><i class="fa fa-eye"></i> Lihat Selengkapnya</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach

      </div>
    </div>
  </div>
@endsection
