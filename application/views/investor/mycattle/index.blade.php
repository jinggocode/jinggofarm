@layout('_layout/investor/index')

@section('title')Ternak Saya@endsection

@section('content')
<div class="text-center opaque-overlay bg-primary">
  <div class="container py-5">
    <div class="row">
      <div class="col-md-12 text-white">
        <h3 style="margin-bottom: -4px" class="text-left display-5">
          <img src="{{base_url('assets/img/icon/kandang.png')}}" width="60" class="img-fluid pb-3" alt="">&nbsp;Ternak Saya</h3>
      </div>
    </div>
  </div>
</div>
<div class="py-5">
  <div class="container">
    <!--<form class="">
      <div class="form-group row"> <label for="inputPassword2" class="sr-only">Password</label>
        <div class="col-md-4 col-sm-9 col-9">
          <input type="password" class="form-control" id="inputPassword2" placeholder="Berdasarkan Nama" style="width: 100%;"> </div>
        <div class="col-sm-3 col-md-3 col-3">
          <button type="submit" class="btn btn-primary mb-2">Cari</button>
        </div>
      </div>
    </form> -->
    <div class="row">
      <div class="col-md-12">

        <!-- TAMPILAN DESKTOP -->
        <div class="d-none d-lg-block d-xl-block">
          <table class="table table-responsive table-striped table-hover">
            <thead class="text-light bg-primary">
              <tr>
                <th style="width: 5%">#</th>
                <th style="width: 40%">Nama Ternak</th>
                <th style="width: 25%">Jumlah Paket</th>
                <th style="width: 15%">Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if(empty($data)): ?>
                  <tr>
                      <td colspan="6" align="center">Tidak ada Data</td>
                  </tr>
              <?php else: $start= $start+1;?>
                  @foreach($data as $row)
                  <tr>
                    <td>{{$start++}}</td>
                    <td><b>{{$row->ternak->kategori->nama}} [{{$row->ternak->kode_ternak}}]</b></td>
                    <td>{{$row->jumlah}}</td>
                    <td>
                      {{($row->ternak->status=='0')?'<span class="badge badge-warning">Cari Investor</span>':''}}
                      {{($row->ternak->status=='1')?'<span class="badge badge-info">Persiapan Ternak</span>':''}}
                      {{($row->ternak->status=='2')?'<span class="badge badge-primary">Masa Ternak</span>':''}}
                      {{($row->ternak->status=='3')?'<span class="badge badge-success">Ternak Selesai</span>':''}}
                    </td>
                    <td>
                      <a href="{{site_url('investor/mycattle/view/'.$row->ternak->id.'/'.$row->ternak->slug)}}" class="btn text-light btn-sm btn-secondary"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</a>
                    </td>
                  </tr>
                  @endforeach
              <?php endif ?>

            </tbody>
          </table>
        </div>

        <!-- INI TABEL RESPONSIVE -->
        <table class="table table-responsive table-striped table-hover table-hover d-lg-none">
          <thead class="text-light bg-primary">
            <tr>
              <th style="width: 5%">#</th>
              <th style="width: 40%;"">Deskripsi</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if(empty($data)): ?>
                <tr>
                    <td colspan="6" align="center">Tidak ada Data</td>
                </tr>
            <?php else: $start= 1;?>
                @foreach($data as $row)
                <tr>
                  <td>{{$start++}}</td>
                  <td>
                    <b>{{$row->ternak->kategori->nama}}</b><br>
                    Jumlah Paket : {{$row->jumlah}} <br>
                    {{($row->ternak->status=='0')?'<span class="badge badge-warning">Cari Investor</span>':''}}
                    {{($row->ternak->status=='1')?'<span class="badge badge-info">Persiapan Ternak</span>':''}}
                    {{($row->ternak->status=='2')?'<span class="badge badge-primary">Masa Ternak</span>':''}}
                    {{($row->ternak->status=='3')?'<span class="badge badge-success">Ternak Selesai</span>':''}}
                  </td>
                  <td class="text-center">
                    <a href="{{site_url('investor/mycattle/view/'.$row->ternak->id.'/'.$row->ternak->slug)}}" class="btn text-light btn-sm btn-secondary"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</a>
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
