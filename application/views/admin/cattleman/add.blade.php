@layout('_layout/admin/index')

@section('title')Tambah Peternak@endsection

@section('content')
<div id="page-content">
    <!-- Blank Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1><a href="{{site_url('admin/cattle')}}"><i class="fa fa-arrow-left"></i></a> Tambah Peternak</h1>
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

                <form action="{{site_url('admin/'.$page.'/save')}}" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
                {{$csrf}}
                {{form_hidden('id_kt', 1);}}

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="nama">Nama</label>
                        <div class="col-md-4">
                            <input value="{{set_value('nama')}}" type="text" id="nama" name="nama" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="nama">Sebagai</label>
                        <div class="col-md-4">
                            <select name="id_kategori" id="id_kategori" class="form-control">
                                <option value="">-Pilih Kategori Peternak-</option>
                                @foreach ($category as $val)
                                    <option {{(set_value('id_kategori') == $val->id)?'selected':''}} value="{{$val->id}}">{{$val->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="umur">Umur</label>
                        <div class="col-md-2">
                            <input value="{{set_value('umur')}}" type="number" id="umur" name="umur" class="form-control">
                        </div>Tahun
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="lama_pengalaman">Pengalaman</label>
                        <div class="col-md-2">
                            <input value="{{set_value('lama_pengalaman')}}" type="number" id="lama_pengalaman" name="lama_pengalaman" class="form-control">
                        </div> Tahun
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="foto">Foto</label>
                        <div class="col-md-5">
                            <input type="file" name="foto" class="form-control">   <br>
                            <?php $img = isset($data->foto) ? set_news_picture($data->foto) : 'default.png';?>
                            <img width="300" height="1000" src="{{base_url('uploads/img/ternak/'.$img)}}" class="image-preview img-responsive" alt="">
                        </div>
                    </div>

                    <div class="form-group form-actions">
                        <div class="col-md-9 col-md-offset-3">
                            <button type="submit" class="btn btn-effect-ripple btn-primary" style="overflow: hidden; position: relative;"><i class="fa fa-send"></i> Tambah</button>
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
