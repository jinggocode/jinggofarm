@layout('_layout/admin/index')

@section('title')Data Ternak@endsection

@section('content')
<div id="page-content">
    <!-- Blank Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Data Ternak</h1>
                </div>
            </div>
        </div>

    </div>
    <!-- END Blank Header -->

    <div class="row" style="padding-bottom: 10px">
        <div class="col-md-12" align="right">
            <a href="{{site_url('admin/'.$page.'/add')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data Baru</a>
            <a href="{{site_url('admin/'.$page.'/archived')}}" class="btn btn-warning"><i class="fa fa-trash"></i> Arsip Data</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <form class="form-inline" action="{{site_url('admin/'.$page.'/search')}}" method="get">
              <div class="form-group">
                <select name="filter" required="required" id="filter" class="form-control">
                    <option value="">Cari Berdasarkan</option>
                    <option {{(isset($search_data['filter'])&& $search_data['filter'] == 'kode_ternak')?'selected':''}} value="kode_ternak">Kode Ternak</option>
                    <option {{(isset($search_data['filter'])&& $search_data['filter'] == 'nama')?'selected':''}} value="nama">Nama Ternak</option>
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
                    <option {{(isset($search_data['sort'])&& $search_data['sort'] == '3')?'selected':''}} value="3">Stok Sedikit</option>
                    <option {{(isset($search_data['sort'])&& $search_data['sort'] == '4')?'selected':''}} value="4">Stok Banyak</option>
                </select>
              </div>
            </div>
            </form>
        </div>
    </div>
<br>
    <!-- Table Styles Block -->
    <div class="block">

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
                        <!-- <th style="width: 500px;">Judul</th>   -->
                        <th>Kode Ternak</th>
                        <th>Kategori Ternak</th>
                        <th>Jumlah Unit</th>
                        <th>Status</th>
                        <th style="width: 300px;" class="text-center"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                <?php if(empty($data)): ?>
                    <tr>
                        <td colspan="6" align="center">Tidak ada Data</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1 ?>
                    @foreach($data as $row)
                    <tr>
                        <td>{{$row->kode_ternak}}</td>
                        <td>{{$row->kategori->nama}}</td>
                        <td>{{$row->jumlah_unit}}</td>
                        <td>
                          {{($row->status==0)?'<span class="label label-warning">Mencari Dana</span>':''}}
                          {{($row->status==1)?'<span class="label label-primary">Persiapan Ternak</span>':''}}
                          {{($row->status==2)?'<span class="label label-info">Masa Ternak</span>':''}}
                          {{($row->status==3)?'<span class="label label-success">Ternak Selesai</span>':''}}
                        </td>
                        <td class="text-center">
                            <a href="{{site_url('admin/'.$page.'/view/'.$row->id)}}" data-toggle="tooltip" title="Lihat" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-eye"></i> Lihat</a>
                            <a href="{{site_url('admin/'.$page.'/edit/'.$row->id)}}" data-toggle="tooltip" title="Edit" class="btn btn-effect-ripple btn-sm btn-success"><i class="fa fa-pencil"></i> Edit Data</a>
                            <a href="#ubahStatusDialog" data-kode="{{$row->kode_ternak}}" data-id="{{$row->id}}" data-toggle="modal" title="Edit" class="open-ubahStatusDialog btn btn-effect-ripple btn-sm btn-warning"><i class="fa fa-pencil-square-o"></i> Edit Status</a>

                            <a href="{{site_url('admin/'.$page.'/delete/'.$row->id)}}" data-toggle="tooltip" title="Hapus" class="btn btn-effect-ripple btn-sm btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="fa fa-trash-o"></i></a>
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

<!-- Small Modal -->
<div id="ubahStatusDialog" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="kodeTernak"><strong>Ubah Status</strong></h3>
            </div>
            <div class="modal-body">
                <form action="{{site_url('admin/cattle/ubah_status')}}" method="post">
                  {{$csrf}}
                  <input type="hidden" name="id" id="idTernak" value="">
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" required="" id="status" class="form-control">
                        <option></option>
                        <option value="1">Persiapan Ternak</option>
                        <option value="2">Masa Ternak</option>
                        <option value="3">Ternak Selesai</option>
                    </select>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-effect-ripple btn-primary">Ubah</button>
                <button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Close</button>
            </div>
                </form>
        </div>
    </div>
</div>
<!-- END Small Modal -->
@endsection

@section('script')
    <script>
        $(document).on("click", ".open-ubahStatusDialog", function () {
             var idTernak = $(this).data('id');
             var kodeTernak = $(this).data('kode');
             document.getElementById("kodeTernak").innerHTML = "<b>Ubah Status "+kodeTernak+"</b>";
             $(".modal-body #idTernak").val( idTernak );
        });
    </script>
@endsection
