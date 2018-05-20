@layout('_layout/admin/index')

@section('title')Data Transaksi Pemberian Modal@endsection

@section('content')
<div id="page-content">
    <!-- Blank Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Data Transaksi Pemberian Modal</h1>
                </div>
            </div>
        </div>

    </div>
    <!-- END Blank Header -->

    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-8" align="right">
            <a href="{{site_url('admin/'.$page.'/history')}}" class="btn btn-primary"><i class="fa fa-history"></i> Riwayat Transaksi</a>
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
                        <th>Nama Rekening</th>
                        <th style="width: 200px;">Bukti Transfer</th>
                        <th style="width: 160px;" class="text-center"><i class="fa fa-flash"></i></th>
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
                            <td>{{$row->nama_transfer}}</td>
                            <td>
                                <div class="gallery-image-container animation-fadeInQuick2" data-category="nature">
                                    <img width="200" src="{{site_url('uploads/bukti-transfer/'.$row->bukti_transfer)}}" alt="Image">
                                    <a href="{{site_url('uploads/bukti-transfer/'.$row->bukti_transfer)}}" class="gallery-image-options" data-toggle="lightbox-image" >
                                        <i class="fa fa-search-plus fa-3x text-light"></i>
                                    </a>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{site_url('admin/transaction/valid/'.$row->id)}}" data-toggle="tooltip" title="Valid" class="btn btn-effect-ripple btn-sm btn-success" onclick="return confirm('Apakah anda yakin?')"><i class="fa fa-check"></i></a>
                                <a href="#ubahStatusDialog" data-kode="{{$row->kode_transaksi}}" data-id="{{$row->id}}" data-toggle="modal" data-toggle="tooltip" title="Tidak Valid" class="open-ubahStatusDialog btn btn-effect-ripple btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
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

<div id="ubahStatusDialog" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="kodeTernak"><strong>Tidak Valid</strong></h3>
            </div>
            <div class="modal-body">
                <form action="{{site_url('admin/transaction/unvalid')}}" method="post">
                  {{$csrf}}
                  <input type="hidden" name="id" id="idTransaksi" value="">
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" required="" id="status" class="form-control">
                        <option value="">-Penyebab-</option>
                        <option value="4">Bukti tidak valid</option>
                        <option value="5">Pembayaran Kurang</option>
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
@endsection

@section('script')
    <script src="{{base_url('assets/admin/js/pages/uiTables.js')}}"></script>
    <script>
        $(function () {
                UiTables.init();
        });

        $(document).on("click", ".open-ubahStatusDialog", function () {
             var idTransaksi = $(this).data('id');
             var kodeTernak = $(this).data('kode');
             document.getElementById("kodeTernak").innerHTML = "<b>Pembatalan "+kodeTernak+"</b>";
             $(".modal-body #idTransaksi").val( idTransaksi );
        });
    </script>
@endsection
