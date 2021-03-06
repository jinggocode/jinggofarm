@layout('_layout/admin/index')

@section('title')Peternak {{$data->nama}}@endsection 

@section('content')
<div id="page-content">
    <!-- Blank Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1><a href="{{site_url('admin/'.$page)}}"><i class="fa fa-arrow-left"></i></a> {{$data->nama}}</h1>
                </div>
            </div> 
        </div>  

    </div>
    <!-- END Blank Header -->
  
    <div class="row">
        <div class="col-md-12 col-lg-5">
            <!-- Horizontal Form Block -->
            <div class="widget">  
                <img src="{{base_url('uploads/cattleman/img/'.$data->foto)}}" class="img-responsive" alt="">  
                <table class="table ">
                    <tr>
                        <td style="width: 40%">Alamat</td>
                        <td><b>{{$data->alamat}}</b></td>
                    </tr>
                    <tr>
                        <td>Umur</td>
                        <td><b>{{$data->umur}} Tahun</b></td>
                    </tr>
                    <tr>
                        <td>Pengalaman</td>
                        <td><b>{{$data->lama_pengalaman}} Tahun</b></td>
                    </tr> 
                </table>       

            </div>
            <!-- END Horizontal Form Block --> 
        </div> 

        <div class="col-md-7 col-lg-7">
            <div class="block full">
                <!-- Block Tabs Title -->
                <div class="block-title">
                    <div class="block-options pull-right">
                        <a href="javascript:void(0)" class="btn btn-effect-ripple btn-default" data-toggle="tooltip" title="Settings"><i class="fa fa-cog"></i></a>
                    </div>
                    <ul class="nav nav-tabs" data-toggle="tabs"> 
                        <li class="active"><a href="#profile-followers">Ternak yang dirawat</a></li>
                    </ul>
                </div>
                <!-- END Block Tabs Title -->

                <!-- Tabs Content -->
                <div class="tab-content"> 

                    <!-- Followers -->
                    <div class="tab-pane active" id="profile-followers">
                        <div class="block-content-full">
                            <table class="table table-striped table-borderless table-vcenter remove-margin-bottom">
                                <tbody>
                                    <tr class="animation-fadeInQuick2">
                                        <td class="text-center" style="width: 100px;"><img src="{{base_url('assets/admin/img/placeholders/avatars/avatar1.jpg')}}" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar"></td>
                                        <td>
                                            <h4><strong>Sapi Perah FH TR-001</strong></h4>
                                            <i class="fa fa-fw fa-user text-danger"></i> Wiraswasta<br>
                                            <i class="fa fa-fw fa-map-marker text-info"></i> Jember, Jawa Timur
                                        </td>
                                        <td class="text-right" style="width: 20%;"> 
                                            <a href="javascript:void(0)" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Lihat Ternak"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr> 
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