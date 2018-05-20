@layout('_layout/admin/index')

@section('title'){{$data->first_name}}@endsection

@section('content')
<div id="page-content">
    <!-- Blank Header -->
    <div class="content-header">

        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1><a href="{{site_url('admin/investor')}}"><i class="fa fa-arrow-left"></i></a> {{$data->first_name}}</h1>
                </div>
            </div>
        </div>

    </div>
    <!-- END Blank Header -->

    <div class="row">
        <div class="col-md-4 col-lg-3">
            <!-- Horizontal Form Block -->
            <div class="widget">
                <img src="{{base_url('assets/img/investor.png')}}" class="img-responsive" alt="">
                <table class="table table-striped ">
                    <tr>
                        <td style="width: 40%">Nama</td>
                        <td><b>{{$data->first_name}}</b></td>
                    </tr>
                    <tr>
                        <td style="width: 40%">Email</td>
                        <td><b>{{$data->phone}}</b></td>
                    </tr>
                    <tr>
                        <td>Nomor Telepon</td>
                        <td><b>{{$data->email}}</b></td>
                    </tr>
                </table>

            </div>
            <!-- END Horizontal Form Block -->
        </div>

        <div class="col-md-12 col-lg-9">

            <div class="block full">
                <!-- Block Tabs Title -->
                <div class="block-title"> 
                    <ul class="nav nav-tabs" data-toggle="tabs">
                        <li class="active"><a href="#profile-followers">Daftar Investasi</a></li>
                    </ul>
                </div>
                <!-- END Block Tabs Title -->

                <!-- Tabs Content -->
                <div class="tab-content">

                    <!-- Followers -->
                    <div class="tab-pane active" id="profile-followers">
                        <div class="block-content-full">
                            <table class="table table-striped table-borderless table-vcenter remove-margin-bottom">
                                <thead>
                                  <th>No.</th>
                                  <th>Kode / Nama Ternak</th>
                                  <th>Jumlah</th>
                                </thead>
                                <tbody>

                                <?php if(empty($investasi)): ?>
                                    <tr>
                                        <td colspan="6" align="center">Tidak ada Data</td>
                                    </tr>
                                <?php else: ?>
                                    <?php $no = 1 ?>
                                    @foreach($investasi as $row)
                                    <tr>
                                      <td>{{$no++}}</td>
                                      <td>{{$row->ternak->kode_ternak}} / {{$row->ternak->kategori->nama}}</td>
                                      <td>{{$row->unit}}</td>
                                    </tr>
                                    @endforeach
                                <?php endif ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Followers -->
                </div>
                <!-- END Tabs Content -->
            </div>
        </div>
    </div>
</div>
@endsection
