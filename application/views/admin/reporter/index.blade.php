@layout('_layout/admin/index')

@section('title')Data Pelaporan Ternak@endsection

@section('content')
<div id="page-content">
    <!-- Blank Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Pelaporan Ternak</h1>
                </div>
            </div> 
        </div>  

    </div>
    <!-- END Blank Header -->

    <div class="row">
        <div class="col-md-8">

            <form action="{{site_url('admin/reporter/search')}}" method="get" class="form-inline">
                <div class="form-group">
                    <label class="sr-only" for="keyword">Kode Ternak</label>
                    <input type="text" id="keyword" autofocus="autofocus" name="keyword" class="form-control" placeholder="Kode Ternak">
                </div> 
                <div class="form-group">
                    <button type="submit" class="btn btn-effect-ripple btn-primary">Cari</button> 
                </div>
            </form>

        </div>
    </div>
<br>
    <!-- Table Styles Block -->
    <div class="block">
        <!-- Table Styles Title -->
        <div class="block-title clearfix"> 
            <h2><span class="hidden-xs">Pilih</span> Ternak</h2>
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
                        <!-- <th style="width: 500px;">Judul</th>   -->
                        <th style="width: 10px;">No.</th>
                        <th style="width: 80px;">Kode Ternak</th>
                        <th style="width: 80px;">Nama Ternak</th>   
                        <th style="width: 160px;" class="text-center"><i class="fa fa-flash"></i></th>
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
                        <td>{{$row->kode_ternak}}</td> 
                        <td>{{$row->kategori->nama}}</td>      
                        <td class="text-center">  
                            <a href="{{site_url('admin/'.$page.'/view/'.$row->id)}}" data-toggle="tooltip" title="Lihat" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-eye"></i> Lihat</a>
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