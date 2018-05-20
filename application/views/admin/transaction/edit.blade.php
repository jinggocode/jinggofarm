@layout('_layout/admin/index')

@section('title')Edit Data Ternak@endsection 

@section('content')
<div id="page-content">
    <!-- Blank Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1><a href="{{site_url('admin/cattle')}}"><i class="fa fa-arrow-left"></i></a> Edit Data Ternak</h1>
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
                {{form_hidden('id_kt', 1);}}
                {{form_hidden('id', $data->id);}}
                
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="nama">Nama Ternak</label>
                        <div class="col-md-4">
                            <input value="{{$data->nama}}" type="text" id="nama" name="nama" class="form-control"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="deskripsi">Deskripsi</label>
                        <div class="col-md-6">
                            <textarea id="deskripsi" name="deskripsi" class="form-control">{{$data->deskripsi}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="biaya">Biaya</label>
                        <div class="col-md-3">
                            <input value="{{$data->biaya}}" type="text" id="biaya" name="biaya" class="form-control"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="jumlah_unit">Jumlah Unit</label>
                        <div class="col-md-2">
                            <input value="{{$data->jumlah_unit}}" type="number" id="jumlah_unit" name="jumlah_unit" class="form-control"> 
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="lama_periode">Lama Periode</label>
                        <div class="col-md-2">
                            <input value="{{$data->lama_periode}}" type="number" id="lama_periode" name="lama_periode" class="form-control">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="foto">Foto</label>
                        <div class="col-md-5">
                            <input type="file" name="foto" class="form-control">   <br> 
                            <?php $img = isset($data->foto) ? $data->foto : 'default.png';?> 
                            <img width="300" height="1000" src="{{base_url('uploads/cattle/img/'.$img)}}" class="image-preview img-responsive" alt=""> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="file">File Pendukung</label>
                        <div class="col-md-5">
                            <input type="file" name="file" class="form-control">   
                        </div>
                    </div><hr>

                    <h3 style="padding-left: 40px">Pembagian Keuntungan (%)</h3>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="bghasil_peternak">Peternak</label>
                        <div class="col-md-2">
                            <input value="{{$data->bghasil_peternak}}" type="text" id="bghasil_peternak" name="bghasil_peternak" class="form-control">
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="bghasil_investor">Investor</label>
                        <div class="col-md-2">
                            <input value="{{$data->bghasil_investor}}" type="text" id="bghasil_investor" name="bghasil_investor" class="form-control">
                        </div>
                    </div> 

                    <div class="form-group form-actions">
                        <div class="col-md-9 col-md-offset-3">
                            <button type="submit" class="btn btn-effect-ripple btn-primary" style="overflow: hidden; position: relative;"><i class="fa fa-pencil"></i> Ubah</button>
                            <button type="reset" class="btn btn-effect-ripple btn-danger" style="overflow: hidden; position: relative;"><i class="fa fa-refresh"></i> Reset</button>
                            <a href="{{site_url($page)}}" class="btn btn-effect-ripple btn-warning" style="overflow: hidden; position: relative;"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Horizontal Form Block --> 
        </div> 
    </div>
</div>
@endsection 

@section('script')  
     <!-- ckeditor.js, load it only in the page you would like to use CKEditor (it's a heavy plugin to include it with the others!) -->
    <script src="{{base_url('assets/dashboard/')}}js/plugins/ckeditor/ckeditor.js"></script>

    <script src="{{base_url('assets/dashboard/')}}js/pages/formsComponents.js"></script> 
    <script type="text/javascript" src="{{base_url('assets/dashboard/js/plugins/datetime/jquery.datetimepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{base_url('assets/dashboard/js/plugins/datetime/jquery.datetimepicker.full.min.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            $("[type='date']").prop('type', 'text').datetimepicker();
        });
    </script>
    <script>$(function(){ FormsComponents.init(); });</script> 
    <script type="text/javascript">
    var articles = (function(){ 
        // bind events 
        $("[type='file']").on('change', eventPreviewGambar); 

        init(); 

        // Events  
        function eventPreviewGambar(event){
            readURL(event.target);
        } 

        function readURL(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

    })();
</script>
@endsection