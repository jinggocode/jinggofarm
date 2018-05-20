@layout('_layout/investor/index')

@section('title')Riwayat Penarikan Saldo@endsection 
  
@section('content')  
<div class="opaque-overlay bg-secondary">
  <div class="container py-5">
    <div class="row">
      <div class="col-md-8 text-white py-5">
        <h1 style="margin-bottom: -4px" class="text-left display-5"><i class="fa fa-history"></i>&nbsp;Riwayat Penarikan Saldo</h1>
        <hr class="text-white border border-light mx-0" style="width: 20%"> 
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body text-center">
            <span style="font-weight: 500">Saldo yang bisa diambil:</span><h1>{{money(($saldo_ambil == NULL)?'0':$saldo_ambil)}}</h1> saldo ditahan sebesar {{money(($saldo_tahan == NULL)?'0':$saldo_tahan)}} <br> <a href="">Informasi lebih lanjut</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="py-3">
  <div class="container"> 
    <div class="pb-4">
      <div class="row">
        <div class="col-md-6 text-left">
          <a class="btn btn-warning text-white" href="{{site_url('investor/balance')}}"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-md-6 text-right">
          <a class="btn btn-secondary text-white" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fa fa-bookmark-o"></i> Penarikan Dana</a>
        </div>
      </div> 
    </div> 
    <div class="row">
      <div class="col-md-12">
        <table class="table table-responsive table-striped">
          <thead class="text-light bg-primary">
            <tr>
              <th style="width: 5%">#</th>
              <th style="width: 40%">Deskripsi</th>
              <th style="width: 20%">Nominal</th>
              <th style="width: 20%">Status</th> 
            </tr>
          </thead>
          <tbody>
            <?php if(empty($data)): ?>
                <tr>
                    <td colspan="6" align="center">Tidak ada Data</td>
                </tr>
            <?php else: ?>
                <?php $start += 1 ?>
                @foreach($data as $row) 
                <tr>
                  <td>{{$start++}}.</td>
                  <td>
                    {{$row->deskripsi}}<br>
                    <b>{{dateFormatBulan(3, $row->created_at)}}</b>
                  </td>
                  <td>{{money($row->nominal)}}</td> 
                  <td>
                    {{($row->status_terima == '0')?'<span class="badge badge-warning">Proses transfer</span>':''}}
                    {{($row->status_terima == '1')?'<span class="badge badge-primary">Telah di transfer</span>':''}}
                  </td>  
                </tr>   
                @endforeach 
            <?php endif ?> 
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div align="right">
          {{$pagination}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('modal')
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Penarikan Dana</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{site_url('investor/balance/pulls')}}" method="post">
          {{$csrf}}
          <div class="form-group">
            <label for="jumlah_tarik">Masukan Jumlah Uang (Rp.)</label>
            <input id="jumlah_tarik" name="jumlah_tarik" type="text" class="form-control" id="jumlah_tarik" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
            <small class="form-text text-muted">Jumlah Saldo yang dapat di tarik <br><b>{{money(($saldo_ambil == NULL)?'0':$saldo_ambil)}}</b></small>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        <button type="submit" class="btn btn-primary">Tarik Dana</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{base_url('assets/admin/')}}js/money.js"></script>
<script>
$(document).ready(function(){ 
    $("form").submit(function(e){
        var jumlah_tarik_asli = $('#jumlah_tarik').val();
        var jumlah_tarik = jumlah_tarik_asli.replace(/\./g,'');
        var tarik = parseInt(jumlah_tarik);
        var saldo_ambil = parseInt('<?php echo $saldo_ambil; ?>');
        console.log(tarik);
        if (tarik >= saldo_ambil) {
            e.preventDefault();
            alert('Maaf, jumlah yang anda tarik kurang dari saldo yang bisa diambil!');
        } else {
          if (confirm("Apakah anda yakin Akan menarik dana sebesar Rp. "+tarik) == true) {
            return true;
          } else {
            e.preventDefault();
          } 
        }
    });
});
</script>
@endsection