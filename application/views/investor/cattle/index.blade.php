@layout('_layout/investor/index')

@section('title')Nama Ternak@endsection 
  
@section('content')  
<div class="text-center opaque-overlay" style="background-image: url(&quot;https://i.imgur.com/OJIcIns.jpg&quot;);">
    <div class="container py-5"> 
      <div class="row">
        <div class="col-md-12 text-white">
          <h1 class="display-4 mb-4 text-left"><b>Daftar Ternak Investasi</b></h1>
        </div>
      </div>
    </div>
  </div> 
  <div class="text-dark py-3">
    <div class="container"> 
      <div class="row">
        
        @foreach($ternak as $value)  
        <div class="col-md-4 my-3">
          <a href="{{site_url('investor/cattle/view/'.$value->slug)}}">
          <div class="card-deck">
            <div class="card card-hover border-secondary">
              <a class="progressive replace" href="{{base_url('uploads/cattle/img/'.$value->foto)}}" data-srcset="{{base_url('uploads/cattle/img/'.$value->foto)}} 800w, {{base_url('uploads/cattle/img/'.$value->foto)}} 1200w" data-sizes="100vw">
                <img class="card-img-top preview" src="{{base_url('uploads/cattle/img/'.$value->foto)}}" alt="Card image cap">
              </a>
              <div class="card-body text-dark">
                <h5 class="card-title">{{$value->nama}}</h5>
                <p class="card-text p-y-1 w-100 py-2">Profit {{$value->ekspektasi_profit_min}}-{{$value->ekspektasi_profit_max}}%
                <br>Periode {{$value->lama_periode}} Tahun</p>
              </div>
              <div class="card-footer">
                <a href="{{site_url('investor/cattle/view/'.$value->slug)}}" class="card-link btn btn-block btn-secondary"><i class="fa fa-eye"></i> Lihat Detail</a>
              </div>
            </div>
          </div>  
        </div>  
        @endforeach
        
      </div>
    </div> 
  </div> 
@endsection