@layout('_layout/admin/index')

@section('title')Edit Laporan Keuangan@endsection 

@section('content')
<div id="page-content">
    <!-- Blank Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1><a href="{{site_url('admin/'.$page.'/view/'.$this->uri->segment(4))}}"><i class="fa fa-arrow-left"></i></a> Edit Laporan Keuangan <b>{{$data->ternak->nama.' '.$data->ternak->kode_ternak}}</b></h1>
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

                <form action="{{site_url('admin/'.$page.'/update_finance_report/'.$this->uri->segment(4))}}" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
                {{$csrf}}  
                {{form_hidden('id_ternak', $data->ternak->id);}}
                
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="jenis">Jenis Keuangan</label>
                        <div class="col-md-4">
                            <select name="jenis" id="jenis" class="form-control">
                                <option></option>
                                <option {{($data->jenis == '0')?'selected':''}} value="0">Hasil Penjualan</option>
                                <option {{($data->jenis == '1')?'selected':''}} value="1">Penggunaan Dana</option> 
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="jumlah">Jumlah Uang</label>
                        <div class="col-md-4">
                            <input type="text" id="jumlah" name="jumlah" class="form-control" value="{{rupiah($data->jumlah)}}" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="deskripsi">Deskripsi</label>
                        <div class="col-md-6">
                            <textarea id="deskripsi" name="deskripsi" class="form-control">{{$data->deskripsi}}</textarea>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="tanggal">Tanggal</label>
                        <div class="col-md-6">
                            <input type="text" id="tanggal" name="tanggal" class="form-control input-datepicker" data-date-format="yyyy-mm-dd" value="{{$data->tanggal}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="foto">Foto</label>
                        <div class="col-md-5">
                            <input type="file" name="foto" class="form-control">   <br> 
                            <?php $img = isset($data->foto) ? $data->foto : 'default.png';?> 
                            <img width="300" height="1000" src="{{base_url('uploads/reporter/'.$img)}}" class="image-preview img-responsive" alt=""> 
                        </div>
                    </div>  

                    <div class="form-group form-actions">
                        <div class="col-md-9 col-md-offset-3">
                            <button onclick="return confirm('Perikasi kembali, Apakah anda yakin?')" type="submit" class="btn btn-effect-ripple btn-primary" style="overflow: hidden; position: relative;"><i class="fa fa-check-square-o"></i>  Simpan</button>
                            <button type="reset" class="btn btn-effect-ripple btn-danger" style="overflow: hidden; position: relative;"><i class="fa fa-refresh"></i> Reset</button>
                            <a href="{{site_url('admin/'.$page.'/view/'.$this->uri->segment(4))}}" class="btn btn-effect-ripple btn-warning" style="overflow: hidden; position: relative;"><i class="fa fa-chevron-left"></i> Kembali</a>
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