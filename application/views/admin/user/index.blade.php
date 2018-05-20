@layout('_layout/admin/index')

@section('title')Data Admin dan Operator @endsection

@section('content')
<div id="page-content">
    <!-- Blank Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Data Admin dan Operator</h1>
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
                        <th>Nama</th>
                        <th>Email</th>
                        <th style="width: 150px;">Hak Akses</th>
                        <th style="width: 200px;" class="text-center"><i class="fa fa-flash"></i></th>
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
                        <td>{{$row->first_name}}</td>
                        <td>{{$row->email}}</td>
                        <td>{{($row->group_id == '1')?'<span class="label label-primary">Admin</span>':'<span class="label label-info">Operator</span>'}} </td>
                        <td class="text-center">
                            <a href="{{site_url('admin/'.$page.'/edit/'.$row->id)}}" data-toggle="tooltip" title="Edit" class="btn btn-effect-ripple btn-sm btn-success"><i class="fa fa-pencil"></i> Edit</a>
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
