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

    <div class="row">
        <div class="col-md-8">
            <a href="{{site_url('admin/'.$page.'/add')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
            <a href="#modal-fade" class="btn btn-success" data-toggle="modal"><i class="fa fa-search"></i> Pencarian Data</a>
            @if (isset($filter))
                <a href="{{site_url('admin/'.$page.'/refresh')}}" class="btn btn-warning"><i class="fa fa-trash-o"></i> Hapus Pencarian</a>
            @endif
        </div>
    </div>
<br>
    <!-- Table Styles Block -->
    <div class="block">
        <!-- Table Styles Title -->
        <div class="block-title clearfix"> 
            <h2><span class="hidden-xs">Table</span> Data</h2>
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
                        <th>No.</th>
                        <th>Nama Ternak</th>
                        <th>Jumlah Unit</th>  
                        <th>Biaya</th>
                        <th>Status</th>   
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
                        <td>{{$row->nama}}</td> 
                        <td>{{$row->jumlah_unit}}</td> 
                        <td>{{money($row->biaya)}}</td> 
                        <td><span class="label label-primary">{{($row->status == 0)?'Cari Modal':'Modal Terpenuhi'}}</span></td>   
                        <td class="text-center"> 
                            <a href="{{site_url('admin/'.$page.'/view/'.$row->id)}}" data-toggle="tooltip" title="Lihat" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-eye"></i> Lihat</a>
                            <a href="{{site_url('admin/'.$page.'/edit/'.$row->id)}}" data-toggle="tooltip" title="Edit" class="btn btn-effect-ripple btn-sm btn-success"><i class="fa fa-pencil"></i></a>
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
@endsection

@section('script')  
    <script src="{{base_url('assets/dashboard/js/pages/uiTables.js')}}"></script>
    <script>$(function () {
                UiTables.init();
            });
    </script> 
@endsection