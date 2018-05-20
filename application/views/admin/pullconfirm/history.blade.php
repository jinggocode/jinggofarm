@layout('_layout/admin/index')

@section('title')Riwayat Konfirmasi Penarikan Saldo Investor@endsection

@section('content')
<div id="page-content"> 
    <!-- Blank Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Riwayat Konfirmasi Penarikan Saldo Investor</h1>
                </div>
            </div>  
        </div>  

    </div>
    <!-- END Blank Header -->

    <div class="row" style="padding-bottom: 10px">
        <div class="col-md-12">
            <a href="{{site_url('admin/'.$page)}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>  
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
                        <th>Nama User</th>
                        <th>Nama Rekening</th> 
                        <th>Nomor Rekening</th> 
                        <th>Nama Bank</th>
                        <th>Jumlah</th>    
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
                        <td>{{$row->user->first_name}}</td>
                        <td>Rahmat Ramadhan</td> 
                        <td>1234123123124</td>  
                        <td>Bank BRI</td>  
                        <td>{{money($row->nominal)}}</td>   
                        <td class="text-center">  
                            <a href="{{site_url('admin/'.$page.'/cancel/'.$row->id)}}" data-toggle="tooltip" title="Konfirmasi Transfer" class="btn btn-effect-ripple btn-sm btn-danger " onclick="return confirm('Apakah anda yakin?')"><i class="fa fa-times"></i> Batalkan</a>    
                        </td>
                    </tr>
                    @endforeach 
                <?php endif ?> 
                </tbody>
            </table>   
            <div class="col-md-12" align="right">
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