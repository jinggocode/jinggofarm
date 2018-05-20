@layout('_layout/admin/index')

@section('title'){{$data->nama}}@endsection 

@section('content')
<div id="page-content">
    <!-- Blank Header -->
    <div class="content-header">

        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1><a href="{{site_url('admin/cattle')}}"><i class="fa fa-arrow-left"></i></a> {{$data->kode_ternak}} | {{$data->kategori->nama}}</h1>
                </div>
            </div> 
        </div>  

    </div>
    <!-- END Blank Header -->
  
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <!-- Horizontal Form Block -->
            <div class="widget">  
                <img src="{{base_url('uploads/cattle/img/'.$data->foto)}}" class="img-responsive" alt="">  
                <table class="table table-striped ">
                    <tr>
                        <td style="width: 40%">Nama Ternak</td>
                        <td><b>{{$data->nama}}</b></td>
                    </tr>
                    <tr>
                        <td style="width: 40%">Biaya</td>
                        <td><b>{{money($data->biaya)}}</b></td>
                    </tr>
                    <tr>
                        <td>Jumlah Paket</td>
                        <td><b>{{$data->jumlah_unit}}</b></td>
                    </tr>
                    <tr>
                        <td>Lama Periode</td>
                        <td><b>{{$data->lama_periode}} Tahun</b></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center bg-primary"><b>Jumlah Bagi hasil</b></td> 
                    </tr>
                    <tr>
                        <td>Peternak</td>
                        <td><b>{{$data->bghasil_peternak}}%</b></td>
                    </tr>
                    <tr>
                        <td>Investor</td>
                        <td><b>{{$data->bghasil_investor}}%</b></td>
                    </tr>
                </table>       

            </div>
            <!-- END Horizontal Form Block --> 
        </div> 

        <div class="col-md-8 col-lg-5">
            <div class="block"> 

                <!-- Animation and Auto Slide Carousel Content -->
                <div class="block-content-full">
                    <div id="animation-carousel" class="carousel slide remove-margin" data-ride="carousel" data-interval="1500">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            
                            @foreach ($foto as $value) 
                            <div class="item {{($foto['0'] == $value)?'active':''}}">
                                <img src="{{base_url('uploads/cattle/img/'.$value->nama_foto)}}" alt="image">
                            </div> 
                            @endforeach

                        </div>
                        <!-- END Wrapper for slides -->

                        <!-- Controls -->
                        <a class="left carousel-control" href="#animation-carousel" data-slide="prev">
                            <span><i class="fa fa-chevron-left"></i></span>
                        </a>
                        <a class="right carousel-control" href="#animation-carousel" data-slide="next">
                            <span><i class="fa fa-chevron-right"></i></span>
                        </a>
                        <!-- END Controls -->
                    </div>
                </div>
                <!-- END Animation and Auto Slide Carousel Content -->
            </div> 
        </div>

        <div class="col-md-12 col-lg-4"> 

            <div class="block full">
                <!-- Block Tabs Title -->
                <div class="block-title">
                    <div class="block-options pull-right">
                        <a href="javascript:void(0)" class="btn btn-effect-ripple btn-default" data-toggle="tooltip" title="Settings"><i class="fa fa-cog"></i></a>
                    </div>
                    <ul class="nav nav-tabs" data-toggle="tabs"> 
                        <li class="active"><a href="#profile-followers">Investor</a></li>
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

                                <?php if(empty($data_investor)): ?>
                                    <tr>
                                        <td colspan="6" align="center">Tidak ada Data</td>
                                    </tr>
                                <?php else: ?>
                                    <?php $no = 1 ?>
                                    @foreach($data_investor as $row) 
                                    <tr class="animation-fadeInQuick2">
                                        <td class="text-center" style="width: 100px;"><img src="{{base_url('assets/admin/img/placeholders/avatars/avatar1.jpg')}}" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar"></td>
                                        <td>
                                            <h4><strong>{{$row->user->first_name}}</strong></h4>
                                            <i class="fa fa-fw fa-genderless text-danger"></i> {{$row->jumlah}} Paket 
                                        </td>
                                        <td class="text-right" style="width: 20%;"> 
                                            <a href="{{site_url('admin/user/view/'.$row->id_user)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Lihat Profil"><i class="fa fa-eye"></i></a>
                                        </td>
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