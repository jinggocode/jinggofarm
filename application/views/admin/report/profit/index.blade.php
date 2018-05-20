@layout('_layout/admin/index')

@section('title')Laporan Keuntungan Kelompok Ternak@endsection

@section('content')
<div id="page-content">
    <!-- Blank Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Laporan Keuntungan Kelompok Ternak</h1>
                </div>
            </div>
        </div>

    </div>
    <!-- END Blank Header -->


    <div class="row">
        <div class="col-lg-6 col-md-6">
            <form class="form-inline" action="{{site_url('admin/'.$page.'/profit/index')}}" method="get">
              <div class="form-group">
                <select name="month" required="required" id="month" class="form-control">
                    <option value="">-- Bulan --</option>
                    <option {{(isset($search_data['month']) && $search_data['month'] == '01')?'selected':''}} value="01">Januari</option>
                    <option {{(isset($search_data['month']) && $search_data['month'] == '02')?'selected':''}} value="02">Februari</option>
                    <option {{(isset($search_data['month']) && $search_data['month'] == '03')?'selected':''}} value="03">Maret</option>
                    <option {{(isset($search_data['month']) && $search_data['month'] == '04')?'selected':''}} value="04">April</option>
                    <option {{(isset($search_data['month']) && $search_data['month'] == '05')?'selected':''}} value="05">Mei</option>
                    <option {{(isset($search_data['month']) && $search_data['month'] == '06')?'selected':''}} value="06">Juni</option>
                    <option {{(isset($search_data['month']) && $search_data['month'] == '07')?'selected':''}} value="07">Juli</option>
                    <option {{(isset($search_data['month']) && $search_data['month'] == '08')?'selected':''}} value="08">Agustus</option>
                </select>
              </div>
              <div class="form-group" style="margin-right: 10px">
                <select name="year" required="required" id="year" class="form-control">
                    <option value="">-- Tahun --</option>
                    <option {{(isset($search_data['year']) && $search_data['year'] == '2018')?'selected':''}} value="2018">2018</option>
                    <option {{(isset($search_data['year']) && $search_data['year'] == '2019')?'selected':''}} value="2018">2019</option>
                    <option {{(isset($search_data['year']) && $search_data['year'] == '2020')?'selected':''}} value="2018">2020</option>
                    <option {{(isset($search_data['year']) && $search_data['year'] == '2021')?'selected':''}} value="2018">2021</option>
                </select>
              </div>
              <button type="submit" name="action" value="submit" class="btn btn-info"><i class="fa fa-eye"></i> Lihat</button>
        </div>
        <div class="col-lg-6 col-md-6" align="right">
            </form>
        </div>
    </div>

<br>

  @if ($action == "")

  @else
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
            <table id="general-table" class="table table-striped table-borderless table-vcenter">
                <thead>
                    <tr>
                        <!-- <th style="width: 500px;">Judul</th>   -->
                        <th>No.</th>
                        <th>Waktu</th>
                        <th>Deskripsi</th>
                        <th>Jumlah</th>
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
                        <td>{{$no++}}.</td>
                        <td>{{dateFormatBulan(4, $row->created_at)}}</td>
                        <td>{{$row->deskripsi}}</td>
                        <td>{{money($row->nominal)}}</td>
                    </tr>
                    @endforeach
                <?php endif ?>
                    <tr>
                      <td colspan="3" align="right">TOTAL</td>
                      <td><b>{{money($total_profit->total)}}</b></td>
                    </tr>
                </tbody>
            </table> 

        </div>
        <!-- END Table Styles Content -->
    </div>
    <!-- END Table Styles Block -->

  @endif
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
