@layout('_layout/admin/index')

@section('title')Edit Data Investor @endsection

@section('content')
<div id="page-content">
    <!-- Blank Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1><a href="{{site_url('admin/investor')}}"><i class="fa fa-arrow-left"></i></a> Edit Data Investor</h1>
                </div>
            </div>
        </div>

    </div>
    <!-- END Blank Header -->

<br>
    <div class="row">
        <div class="col-sm-6 col-lg-12">
            <!-- Form Alert -->
            @if (!empty(validation_errors()))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><strong>Peringatan</strong></h4>
                <p>{{validation_errors()}}</p>
            </div>
            @endif
            <!-- END Form Alert -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form Block -->
            <div class="block">

                <form action="{{site_url('admin/'.$page.'/update')}}" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
                {{$csrf}}
                {{form_hidden('id', $data->id);}}

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="first_name">Nama</label>
                        <div class="col-md-4">
                            <input value="{{$data->first_name}}" type="text" id="first_name" name="first_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="email">Email</label>
                        <div class="col-md-4">
                            <input value="{{$data->email}}" type="text" id="email" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="phone">Nomor Telepon</label>
                        <div class="col-md-4">
                            <input value="{{$data->phone}}" type="text" id="phone" name="phone" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="password">Password</label>
                        <div class="col-md-4">
                            <input type="password" id="password" name="password" class="form-control" placeholder="isi bila ingin mengganti!">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="reenter_password">Password</label>
                        <div class="col-md-4">
                            <input type="password" id="reenter_password" name="reenter_password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-md-9 col-md-offset-3">
                            <button type="submit" class="btn btn-effect-ripple btn-primary" style="overflow: hidden; position: relative;"><i class="fa fa-pencil"></i> Ubah</button> 
                            <a href="{{site_url('admin/'.$page)}}" class="btn btn-effect-ripple btn-warning" style="overflow: hidden; position: relative;"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Horizontal Form Block -->
        </div>
    </div>
</div>
@endsection
