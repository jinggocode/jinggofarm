@layout('_layout/admin/index')

@section('title')Data Transaksi Pemberian Modal@endsection

@section('content')
<div id="page-content">
    <!-- Blank Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1><a href="{{site_url('admin/'.$page)}}"><i class="fa fa-arrow-left"></i></a> Riwayat Data Transaksi Pemberian Modal</h1>
                </div>
            </div>
        </div>

    </div>
    <!-- END Blank Header -->


    <div class="row">
        <div class="col-lg-6 col-md-6">
            <form class="form-inline" action="{{site_url('admin/'.$page.'/search')}}" method="get">
              <div class="form-group">
                <select name="filter" required="required" id="filter" class="form-control">
                    <option value="">Cari Berdasarkan</option>
                    <option {{(isset($search_data['filter'])&& $search_data['filter'] == 'first_name')?'selected':''}} value="first_name">Nama</option>
                    <option {{(isset($search_data['filter'])&& $search_data['filter'] == 'email')?'selected':''}} value="email">Email</option>
                </select>
              </div>
              <div class="form-group">
                <input type="text" value="{{(isset($search_data['keyword']))?$search_data['keyword']:''}}" name="keyword" class="form-control" id="keyword" placeholder="Kata Kunci" style="margin-right: 10px">
              </div>
              <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Cari</button>
        </div>
        <div class="col-lg-6 col-md-6" align="right">
            <div class="form-inline">
              <div class="form-group">
                <select name="sort" id="sort" class="form-control" onchange="this.form.submit();">
                    <option value="">Urutkan Berdasarkan</option>
                    <option {{(isset($search_data['sort'])&& $search_data['sort'] == '1')?'selected':''}} value="1">Data Terbaru</option>
                    <option {{(isset($search_data['sort'])&& $search_data['sort'] == '2')?'selected':''}} value="2">Data Lama</option>
                </select>
              </div>
            </div>
            </form>
        </div>
    </div>
<br>
    <!-- Table Styles Block -->
    <div class="block">
        <!-- Table Styles Title -->
        <div class="block-title clearfix">
            <h2>Transaksi Masuk</h2>
        </div>
        <!-- END Table Styles Title -->

        <!-- Table Styles Content -->
        <div class="table-responsive">
            <!--
            Available Table Classes:
                'table'             - basic table
                'table-bordered'    - table with full borders
                'table-borderless'  - table with no borders
                'table-striped'     - striped table
                'table-condensed'   - table with smaller top and bottom cell padding
                'table-hover'       - rows highlighted on mouse hover
                'table-vcenter'     - middle align content vertically
            -->
            <table id="general-table" class="table table-striped table-borderless table-vcenter table-hover">
                <thead>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Jumlah Tanggungan</th>
                        <th>Ternak</th>
                        <th>Jumlah Paket</th>
                        <th style="width: 160px;" class="text-center">Status</th>
                        <th>Aksi</th>
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
                            <td>{{money($row->total)}}</td>
                            <td>{{$row->ternak->kategori->nama}}</td>
                            <td>{{$row->unit}}</td>
                            <td class="text-center">
                                {{($row->status == 0)?'<span class="label label-info">Belum Mengirim Bukti</span>':''}}
                                {{($row->status == 1)?'<span class="label label-primary">Proses Validasi</span>':''}}
                                {{($row->status == 2)?'<span class="label label-danger">Transaksi Gagal</span>':''}}
                                {{($row->status == 3)?'<span class="label label-success">Transaksi Valid</span>':''}}
                                {{($row->status == 4)?'<span class="label label-warning">Transaksi Tidak Valid</span>':''}}
                                {{($row->status == 5)?'<span class="label label-default">Pembayaran Kurang</span>':''}}
                            </td>
                            <td>
                                <a href="{{site_url('admin/transaction/unconfirm/'.$row->id)}}" data-toggle="tooltip" title="Batalkan" class="btn btn-effect-ripple btn-sm btn-warning" onclick="return confirm('Apakah anda yakin?')"><i class="fa fa-mail-reply-all"></i></a>
                            </td>
                        </tr>
                    @endforeach
                <?php endif ?>
                </tbody>
            </table>
            <div class="col-md-4">
                <h4>
                    <span class="label label-info">Jumlah Data : {{$total_rows}}</span>
                    @if (isset($filter))
                        <span class="label label-warning">Jumlah Cari : {{$total_cari}}</span>
                    @endif
                </h4><br>
            </div>
            <div class="col-md-8" align="right">
                {{$pagination}}
            </div>

        </div>
        <!-- END Table Styles Content -->
    </div>
    <!-- END Table Styles Block -->
</div>
@endsection

@section('modal')
<!-- Modal Pencarian -->
<div id="modal-fade" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><strong><i class="fa fa-search"></i> Pencarian Data</strong></h3>
            </div>
            <div class="modal-body">
                <form action="{{site_url($page.'/search')}}" method="post" class="form-bordered">
                {{$csrf}}
                    <div class="form-group">
                        <label for="nama_pasar">Nama Pasar</label>
                        <input value="{{ (isset($filter['nama_pasar'])) ? $filter['nama_pasar'] : '' }}" type="text" id="nama_pasar" name="nama_pasar" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-effect-ripple btn-primary" value="Cari">
                <button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- END Modal Pencarian -->
@endsection

@section('script')
    <script src="{{base_url('assets/dashboard/js/pages/uiTables.js')}}"></script>
    <script>$(function () {
                UiTables.init();
            });
    </script>
@endsection
