@layout('_layout/investor/index')

@section('title')Riwayat Transaksi@endsection 
  
@section('content')  
<div class="text-center opaque-overlay bg-primary">
  <div class="container py-5">
    <div class="row">
      <div class="col-md-12 text-white">
        <h1 style="margin-bottom: -4px" class="text-left display-5"><i class="fa fa-th-large"></i>&nbsp;Riwayat Transaksi</h1>
        <hr class="text-white border border-light mx-0" style="width: 20%"> 
      </div>
    </div>
  </div>
</div>
<div class="py-5">
  <div class="container">
    <form class="">
      <div class="form-group row"> <label for="inputPassword2" class="sr-only">Password</label>
        <div class="col-md-4 col-sm-9 col-9">
          <input type="password" class="form-control" id="inputPassword2" placeholder="Berdasarkan Nama" style="width: 100%;"> </div>
        <div class="col-sm-3 col-md-3 col-3">
          <button type="submit" class="btn btn-primary mb-2">Cari</button>
        </div>
      </div>
    </form> 
    <div class="row"> </div>
    <div class="row">
      <div class="col-md-12">

        <table class="table table-responsive table-hover d-none d-lg-block d-xl-block">
          <thead class="text-light bg-primary">
            <tr> 
              <th style="width: 20%">Kode Transaksi</th>
              <th style="width: 30%">Nama Ternak</th>
              <th style="width: 15%">Jumlah Unit</th>
              <th style="width: 20%">Total Bayar</th>
              <th style="width: 25%">Status</th>
              <th class="w-25">Aksi</th>
            </tr>
          </thead>
          <tbody> 
            <?php if(empty($data)): ?>
                <tr>
                    <td colspan="6" align="center">Tidak ada Data</td>
                </tr>
            <?php else: ?>
                @foreach($data as $row) 
                <tr> 
                  <td>{{$row->kode_transaksi}}</td>
                  <td><b>{{$row->ternak->nama}}</b></td>
                  <td>{{$row->unit}}</td>
                  <td>{{money($row->total)}}</td>
                  <td> 
                      {{($row->status==0)?'<span class="badge badge-warning">Belum Konfirmasi</span>':''}} 
                      {{($row->status==1)?'<span class="badge badge-primary">Menunggu Validasi</span>':''}} 
                      {{($row->status==2)?'<span class="badge badge-danger">Pembayaran Gagal</span>':''}}
                      {{($row->status==3)?'<span class="badge badge-success">Pembayaran Valid</span>':''}}
                      {{($row->status==4)?'<span class="badge badge-info">Bukti Tidak Valid</span>':''}}
                      {{($row->status==5)?'<span class="badge badge-default bg-light text-dark">Pembayaran kurang</span>':''}}
                  </td>
                  <td>
                    <a href="{{site_url('investor/payment/view/'.$row->kode_transaksi)}}" class="btn text-light btn-sm btn-secondary"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</a>
                  </td>
                </tr> 
                @endforeach 
            <?php endif ?> 
          </tbody>
        </table>

        <table class="table table-responsive table-striped table-hover table-hover d-lg-none">
          <thead class="text-light bg-primary">
            <tr> 
              <th style="width: 20%">Deskripsi</th>  
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody> 
            <?php if(empty($data)): ?>
                <tr>
                    <td colspan="6" align="center">Tidak ada Data</td>
                </tr>
            <?php else: ?>
                @foreach($data as $row) 
                <tr> 
                  <td>
                    {{$row->kode_transaksi}} <br>
                    {{$row->ternak->nama}} <br>
                    Jumlah {{$row->unit}} Paket<br>
                    {{money($row->total)}} <br>
                      {{($row->status==0)?'<span class="badge badge-warning">Belum Konfirmasi</span>':''}} 
                      {{($row->status==1)?'<span class="badge badge-primary">Menunggu Validasi</span>':''}} 
                      {{($row->status==2)?'<span class="badge badge-danger">Pembayaran Gagal</span>':''}}
                      {{($row->status==3)?'<span class="badge badge-success">Pembayaran Valid</span>':''}}
                  </td>
                  <td class="text-center">
                    <a href="{{site_url('investor/payment/view/'.$row->kode_transaksi)}}" class="btn text-light btn-sm btn-secondary"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</a>
                  </td>
                </tr> 
                @endforeach 
            <?php endif ?> 
          </tbody>
        </table>

        {{$pagination}} 
      </div>
    </div> 
  </div>
</div>
@endsection