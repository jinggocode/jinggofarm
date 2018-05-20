@layout('_layout/investor/index')

@section('title')Ternak Saya @endsection

@section('style')
<style>
  .modal-backdrop {
       background-color: rgba(0, 0, 0, 0.6);!important;

  }
</style>
@endsection

@section('content')
<div class="text-center opaque-overlay bg-secondary">
  <div class="container py-4">
    <div class="row">
      <div class="col-md-12 text-white">
        <h1 class="display-5 mb-3 text-left">{{$data->ternak->kategori->nama}} [{{$data->ternak->kode_ternak}}]</h1>
        <h5 class="display-5 text-left">Jumlah <b>{{$data->jumlah}}</b> Paket</h5>
      </div>
    </div>
  </div>
</div>

<div class="py-4">
  <div class="container">
    <div class="mb-3"><a href="{{site_url('investor/mycattle')}}" class="btn btn-warning text-white"><i class="fa fa-chevron-left"></i> Kembali</a></div>

    <div class="row">
      <div class="col-md-4 col-lg-4">
        <table class="table table-striped">
          <tbody>
            <thead class="bg-primary text-white">
              <th colspan="2"><h4><i class="fa fa-info-circle"></i> Informasi</h4></th>
            </thead>
            <tr>
              <td style="width: 40%">
                <h5>Lama Periode</h5>
              </td>
              <td>{{$data->ternak->lama_periode}} Tahun</td>
            </tr>
            <tr>
              <td>
                <h5>Status</h5>
              </td>
              <td>
                  {{($data->ternak->status=='0')?'<span class="badge badge-warning">Cari Investor</span>':''}}
                  {{($data->ternak->status=='1')?'<span class="badge badge-info">Persiapan Ternak</span>':''}}
                  {{($data->ternak->status=='2')?'<span class="badge badge-primary">Masa Ternak</span>':''}}
                  {{($data->ternak->status=='3')?'<span class="badge badge-success">Ternak Selesai</span>':''}}
              </td>
            </tr>
            @if ($data->ternak->status == 2)
              <tr>
                <td>
                  <h5>Sisa Periode</h5>
                </td>
                <td>{{sisa_waktu($data->ternak->batas_periode)}}</td>
              </tr>
            @endif

            <thead class="bg-primary text-white">
              <th colspan="2"><h3><i class="fa fa-percent"></i> Jumlah Bagi Hasil</h3></th>
            </thead>
            <tr>
              <td><h5>Peternak</h5></td>
              <td>{{$data->ternak->bghasil_peternak}} %</td>
            </tr>
            <tr>
              <td><h5>Investor</h5></td>
              <td>{{$data->ternak->bghasil_investor}} %</td>
            </tr>

          </tbody>
        </table>
      </div>
      <div class="col-md-8 col-lg-8">

        <!-- TAMPILAN DESKTOP -->
        <div class="d-none d-xl-block d-lg-block d-xl-none">
          <table class="table table-striped">
            <thead class="bg-primary text-white">
              <th colspan="6"><h4><i class="fa fa-bar-chart"></i> Laporan Investasi</h4></th>
            </thead>
            <thead>
              <th colspan="6" class="text-center bg-secondary text-white">Perkembangan Ternak</th>
            </thead>
            <thead>
              <th>Jenis Laporan</th>
              <th colspan="2">Deskripsi</th>
              <th>Aksi</th>
            </thead>
            <tbody>
              <?php if(empty($data_laporan_perkembangan)): ?>
                  <tr>
                      <td colspan="6" align="center">Tidak ada Data</td>
                  </tr>
              <?php else: ?>
                  <?php $no = 1 ?>
                  @foreach($data_laporan_perkembangan as $row)
                  <tr>
                    <td>
                        {{($row->jenis_laporan==0)?'<span class="badge badge-primary">Perkembangan Ternak</span>':''}}
                        {{($row->jenis_laporan==1)?'<span class="badge badge-success">Penggunaan Dana</span>':''}}
                        {{($row->jenis_laporan==2)?'<span class="badge badge-warning">Penjualan Hasil</span>':''}}
                    </td>
                    <td colspan="2">{{$row->created_at}} <br> {{$row->deskripsi}}</td>
                    <td>
                      <a id="detail_laporan" data-id="{{$row->id}}" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-eye"></i> Selengkapnya</a>
                    </td>
                  </tr>
                  @endforeach
              <?php endif ?>

                  <tr>
                    <td colspan="6" class="text-right"><a onclick="faseDevelopment()" class="btn btn-outline-primary">Lihat Semuanya <i class="fa fa-arrow-right"></i></a></td>
                  </tr>
            </tbody>

            <!-- this is laporan keuangan -->
            <thead>
              <th colspan="6" class="text-center bg-secondary text-white">Keuangan</th>
            </thead>
            <thead>
              <th>Jenis Laporan</th>
              <th>Deskripsi</th>
              <th>Jumlah</th>
              <th>Aksi</th>
            </thead>
            <tbody>
              <?php if(empty($data_laporan_keuangan)): ?>
                  <tr>
                      <td colspan="6" align="center">Tidak ada Data</td>
                  </tr>
              <?php else: ?>
                  <?php $no = 1 ?>
                  @foreach($data_laporan_keuangan as $row)
                  <tr>
                    <td>
                        {{($row->jenis==0)?'<span class="badge badge-primary">Penjualan</span>':''}}
                        {{($row->jenis==1)?'<span class="badge badge-success">Penggunaan Dana</span>':''}}
                    </td>
                    <td>{{$row->created_at}} <br> {{$row->deskripsi}}</td>
                    <td>{{money($row->jumlah)}}</td>
                    <td>
                      <a id="detail_laporan_keuangan" data-id="{{$row->id}}" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#keuanganModal"><i class="fa fa-eye"></i> Lihat</a>
                    </td>
                  </tr>
                  @endforeach
              <?php endif ?>

                  <tr>
                    <td colspan="6" class="text-right"><a onclick="faseDevelopment()" class="btn btn-outline-primary">Lihat Semuanya <i class="fa fa-arrow-right"></i></a></td>
                  </tr>
            </tbody>
          </table>
        </div>

        <!-- INI TABEL RESPONSIVE -->
        <table class="table table-striped table-hover d-lg-none">
          <thead class="bg-primary text-white">
            <th colspan="6"><h4><i class="fa fa-bar-chart"></i> Laporan Investasi</h4></th>
          </thead>
          <tbody>
            <?php if(empty($data_laporan_perkembangan)): ?>
                <tr>
                    <td colspan="6" align="center">Tidak ada Data</td>
                </tr>
            <?php else: ?>
                <?php $no = 1 ?>
                @foreach($data_laporan_perkembangan as $row)
                <tr>
                  <td>
                      {{($row->jenis_laporan==0)?'<span class="badge badge-primary">Perkembangan Ternak</span>':''}}
                      {{($row->jenis_laporan==1)?'<span class="badge badge-success">Penggunaan Dana</span>':''}}
                      {{($row->jenis_laporan==2)?'<span class="badge badge-warning">Penjualan Hasil</span>':''}}
                     <br>
                     {{$row->created_at}} <br> <p>{{$row->deskripsi}} </p>
                    <a id="detail_laporan" data-id="{{$row->id}}" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-eye"></i> Selengkapnya</a>

                   </td>
                </tr>
                @endforeach
            <?php endif ?>
                  <tr>
                    <td colspan="6" class="text-right"><a class="btn btn-info" onclick="faseDevelopment()">Lihat Semuanya <i class="fa fa-arrow-right"></i></a></td>
                  </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Laporan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="detail-perkembangan">

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="keuanganModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Laporan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="detail-laporan">

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
$(document).on('click','#detail_laporan',function(){
    var id = $(this).data("id");
    console.log('halooo');

    $.LoadingOverlay("show");
    $('#detail-perkembangan').load("<?php echo site_url('investor/mycattle/detail_perkembangan/');?>"+id);
    $.LoadingOverlay("hide");
});

$(document).on('click','#detail_laporan_keuangan',function(){
    var id = $(this).data("id");

    $.LoadingOverlay("show");
    $('#detail-laporan').load("<?php echo site_url('investor/balance/detail_laporan/');?>"+id);
    $.LoadingOverlay("hide");
});
</script>
@endsection
