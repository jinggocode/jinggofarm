@layout('_layout/admin/index')

@section('title')Data Saldo Kelompok Ternak @endsection

@section('content')
<div id="page-content">
    <!-- Blank Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-8" style="padding-top: 10px">
                <div class="header-section">
                    <h1>Data Saldo Kelompok Ternak</h1>
                </div>
            </div>
            <div class="col-sm-4" align="right" style="background-color: #E0E0E0">
                <div class="header-section">
                    Total Saldo<h1> <b>{{money($total_saldo->nominal)}}</b></h1>
                </div>
            </div>
        </div>

    </div>
    <!-- END Blank Header -->
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <a data-toggle="modal" data-target=".tarikDanaModal" class="btn btn-primary"><i class="fa fa-plus"></i> Penarikan Dana</a>
            <form class="form-inline" action="{{site_url('admin/'.$page.'/search')}}" method="get">
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
                        <th>Deskripsi</th>
                        <th>Jumlah Nominal</th>
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
                        <td>{{$row->deskripsi}}</td>
                        <td>{{money($row->nominal)}}</td>
                        <td>
                          {{($row->status==0)?'<span class="label label-primary">Pemasukan</span>':''}}
                          {{($row->status==1)?'<span class="label label-warning">Pengeluaran</span>':''}}
                        </td>
                        <td class="text-center">
                            <a href="{{site_url('admin/'.$page.'/view/'.$row->id)}}" data-toggle="tooltip" title="Lihat" class="btn btn-effect-ripple btn-sm btn-info"><i class="fa fa-eye"></i> Lihat</a>
                        </td>
                    </tr>
                    @endforeach
                <?php endif ?>
                </tbody>
            </table>
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
<div class="modal fade tarikDanaModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 class="modal-title"><strong>Penarikan Saldo</strong></h3>
      </div>
      <div class="modal-body">
          <form action="{{site_url('admin/cattle/ubah_status')}}" method="post">
            {{$csrf}}

            <div class="form-group">
              <label>Masukkan Jumlah Penarikan</label>
              <input type="text" class="form-control" name="jumlah_tarik">
            </div>
            <small>Jumlah yang dapat di tarik <b>Rp. 10.000.000</b></small>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-effect-ripple btn-primary">Tarik</button>
          <button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Close</button>
      </div>
          </form>
    </div>
  </div>
</div>

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
