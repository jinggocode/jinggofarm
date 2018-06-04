@layout('_layout/investor/index')

@section('title'){{$data->kategori->nama}}@endsection

@section('content')
<div class="text-center opaque-overlay bg-secondary">
  <div class="container py-5">
    <div class="row">
      <div class="col-md-12 text-white">
        <h1 class="display-4 text-left">Investasi <b>{{$data->kategori->nama}}</b></h1>
        <h6 class="text-left">oleh <i class="fa fa-home"></i> <b onclick="window.location.href='{{site_url('groups/view')}}'" style="cursor: pointer;">Kelompok Ternak Sumber Lumintu</b></h6>
        <hr class="text-white border border-light mx-0 mb-4" style="width: 10%">
      </div>
    </div>
  </div>
</div>
<div class="" style="background-color: #E8EAF6">
  <div class="container">
    <div class="row">
      <div class="col-md-7 bg-white pt-3">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">

            @foreach ($data->fotos as $val)
            <div class="carousel-item {{($data->fotos[0] == $val)?'active':''}}">
              <img class="d-block w-100" src="{{base_url('uploads/cattle/img/'.$val->nama_foto)}}" alt="First slide"></a>
            </div>
            @endforeach

          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="row mt-4">
          <div class="col-md-12 mb-5">

            <!--MOBILE: Informasi Detail investasi -->
            <div class="d-block d-sm-none">
              <table class="table table-striped bg-white mt-3">
                <tbody>
                  <tr>
                    <td style="width: 50%">
                      <h5>Biaya Ternak</h5>
                    </td>
                    <td>{{money($data->biaya)}} ({{$data->jumlah_sapi}} ekor sapi)</td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Jumlah Paket <i data-toggle="tooltip" data-placement="top" title="Paket merupakan hasil pembagian dari biaya ternak sesuai yang telah kami tentukan" class="fa fa-question-circle" ></i></h5>
                    </td>
                    <td>{{$data->jumlah_unit}} Paket</td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Sisa Paket</h5>
                    </td>
                    <td>{{(($data->sisa_unit - $paket_dibeli) == '0')?'<span class="badge badge-danger">Paket Habis</span>':$data->sisa_unit - $paket_dibeli.' Paket'}} </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Biaya per Paket</h5>
                    </td>
                    <td><strong>{{money($data->biaya/$data->jumlah_unit)}}</strong></td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Jangka Waktu</h5>
                    </td>
                    <td>{{$data->lama_periode}} Tahun</td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Bagi Hasil Keuntungan</h5>
                    </td>
                    <td>Investor <b>{{$data->bghasil_investor}}%</b>,<br> Peternak <b>{{$data->bghasil_peternak}}%</b></td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Keterangan</h5>
                    </td>
                    <td>{{$data->keterangan}}</td>
                  </tr>
                </tbody>
              </table>
              <div class="pb-4 d-block d-sm-none">
                <a href="#startInvest" class="btn btn-primary btn-block"><i class="fa fa-money"></i> Mulai Investasi</a>
              </div>
            </div>
            <!--END MOBILE: Informasi Detail investasi -->

            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><b>Deskripsi</b></a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><b><i class="fa fa-line-chart"></i> Simulasi Keuntungan</b></a>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"><p class="mt-3" style="font-size: 20px">{{$data->deskripsi}}</p></div>
              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <form class="mt-3">
                  <div class="form-group">
                    <label for="unit">Masukkan Jumlah Paket (Modal) <i data-toggle="tooltip" data-placement="top" title="Paket merupakan hasil pembagian dari biaya ternak sesuai yang telah kami tentukan" class="fa fa-question-circle" ></i></label>
                    <select onchange="calculateSimulasi()" class="form-control" id="unit">
                      <option>Jumlah paket</option>
                      <?php
                      $biaya = $data->biaya / $data->jumlah_unit;
                      for ($i=1; $i <= $data->jumlah_unit; $i++) { ?>
                        <option value="{{$i}}">{{$i}} Paket - Biaya {{money($i*$biaya)}}</option>
                      <?php } ?>
                    </select>
                  </div>
                </form>
                <span id="total_perkiraan" class="text-white">{{$total_perkiraan->jumlah*$data->jumlah_sapi}}</span>

                <!-- result -->
                <div id="hasil" style="display:none;">
                  <table class="table table-bordered">
                    <tr>
                      <td colspan="2" class="bg-dark text-white"><b>Perkiraan Jumlah Profit Bersih</b></td>
                    </tr>
                    <tr>
                      <td>per 1 Tahun</td>
                      <td align="right"><b><span id="bersih_per_tahun"></span></b></td>
                    </tr>
                    <tr>
                      <td>Periode 4 Tahun</td>
                      <td align="right"><b><span id="bersih"></span></b></td>
                    </tr>
                  </table>

                  <table class="table table-striped">
                    <tr>
                      <td><b>Jumlah Modal</b></td>
                      <td><b><span id="modal"></span></b></td>
                    </tr>
                    <tr>
                      <td><b>Total</b></td>
                      <td><b><span id="total"></span></b></td>
                    </tr>
                    <tr>
                      <td><b>ROI (%)</b></td>
                      <td><b><span id="roi"></span> %</b></td>
                    </tr>
                  </table>

                  <h2>Detail Profit 4 Tahun</h2>
                  <table class="table table-striped">
                    <thead class="bg-primary text-white">
                      <th>Pendapatan</th>
                      <th>Sub Total</th>
                      <th>Keterangan</th>
                    </thead>
                    <tbody>
                      @foreach ($perkiraan_profit as $row)
                        <tr>
                          <td>{{$row->nama}}</td>
                          <td>{{money($row->jumlah)}}</td>
                          <td>{{$row->keterangan}}</td>
                        </tr>
                      @endforeach
                        <tr>
                          <td align="right"><b>TOTAL</b></td>
                          <td><b><span>{{money($total_perkiraan->jumlah*$data->jumlah_sapi)}}</span></b></td>
                          <td>{{$data->jumlah_sapi}} Ekor Sapi</td>
                        </tr>
                    </tbody>
                  </table>

                  <p><strong>Catatan</strong> <br>
                    <i>Simulasi dimaksud merupakan perkiraan minimal hasil pendapatan selama masa investasi. Simulasi ini berdasarkan kondisi yang berjalan saat ini</i></p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="col-md-5 my-1 bg-light">
        <div class="col-md-12">
          <!-- <div class="progress">
            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
          </div> -->
          
          <div class="alert alert-primary mt-3" role="alert">
              <h4><i class="fa fa-bullhorn"></i> <strong>Informasi Penting</strong></h4>
              <p>{{(isset($data->keterangan)?$data->keterangan:'-')}}</p>
          </div>
          <table class="table table-striped bg-white d-none d-sm-block">

            <tbody>
              <tr>
                <td style="width: 50%">
                  <h5>Biaya Ternak</h5>
                </td>
                <td>{{money($data->biaya)}} ({{$data->jumlah_sapi}} ekor sapi)</td>
              </tr>
              <tr>
                <td>
                  <h5>Jumlah Paket <i data-toggle="tooltip" data-placement="top" title="Paket merupakan hasil pembagian biaya ternak, Bertujuan agar dalam satu ternak dapat dimiliki beberapa investor" class="fa fa-question-circle" ></i></h5>
                </td>
                <td>{{$data->jumlah_unit}} Paket</td>
              </tr>
              <tr>
                <td>
                  <h5>Sisa Paket</h5>
                </td>
                <td>{{(($data->sisa_unit - $paket_dibeli) == '0')?'<span class="badge badge-danger">Paket Habis</span>':$data->sisa_unit - $paket_dibeli.' Paket'}} </td>
              </tr>
              <tr>
                <td>
                  <h5>Biaya per Paket</h5>
                </td>
                <td><strong>{{money($data->biaya/$data->jumlah_unit)}}</strong></td>
              </tr>
              <tr>
                <td>
                  <h5>Jangka Waktu</h5>
                </td>
                <td>{{$data->lama_periode}} Tahun</td>
              </tr>
              <tr>
                <td>
                  <h5>Bagi Hasil Keuntungan</h5>
                </td>
                <td>Investor <b>{{$data->bghasil_investor}}%</b>,<br> Peternak <b>{{$data->bghasil_peternak}}%</b></td>
              </tr>
              <tr>
                <td>
                  <h5>Keterangan</h5>
                </td>
                <td>{{$data->keterangan}}</td>
              </tr>
            </tbody>
          </table>

          @if($data->sisa_unit - $paket_dibeli |= '0')
            <div class="card border-secondary" id="startInvest">
              <div class="card-header bg-secondary text-white">Ayo Mulai Investasi! </div>
              <div class="card-body">
                <h5>Masukan Jumlah Paket Investasi</h5>
                <form action="{{site_url('investor/payment/process')}}" method="post">
                  {{$csrf}}
                  {{form_hidden('slug', $data->slug);}}

                  <div class="form-group">
                    <select name="unit" required="required" class="form-control">
                      <option value="">Masukan jumlah paket</option>
                      <?php
                      $biaya = $data->biaya / $data->jumlah_unit;
                      for ($i=1; $i <= $data->sisa_unit; $i++) { ?>
                      <option value="{{$i}}">{{$i}} Paket - Biaya {{money($i * $biaya)}}</option>
                      <?php } ?>
                    </select>
                  </div>
                  <p align="center">Pelajari <a href="">Syarat dan ketentuan</a> yang berlaku sebelum memulai Investasi!</p>
                  <input type="submit" class="btn btn-success btn-block" value="Beri Dana">
                </form>
              </div>
            </div>
            @endif

        <br>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type ="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
function calculateSimulasi()
{
  unit            = document.getElementById("unit").value;
  total_perkiraan = document.getElementById("total_perkiraan").innerHTML;

  if (unit != "Jumlah paket") {
      document.getElementById('hasil').style.display = "block";
  } else {
      document.getElementById('hasil').style.display = "none";
  }

  modal            = (<?php echo $data->biaya / $data->jumlah_unit; ?>) * unit;
  profit_per_paket = total_perkiraan / <?php echo $data->jumlah_unit; ?>;
  bersih           = (profit_per_paket * unit) - modal;
  roi              = (bersih / modal) * 100;
  bersih_per_tahun = bersih / 4;
  total            = bersih + modal;

  // document.getElementById("profit").innerHTML = toRp(profit);
  // document.getElementById("roi").innerHTML = roi;
  document.getElementById("bersih").innerHTML = toRp(bersih);
  document.getElementById("modal").innerHTML  = toRp(modal);
  document.getElementById("total").innerHTML  = toRp(total);
  document.getElementById("bersih_per_tahun").innerHTML = toRp(bersih_per_tahun);
  document.getElementById("roi").innerHTML    = Math.round(roi*100)/100;
}
function toRp(a,b,c,d,e){e=function(f){return f.split('').reverse().join('')};b=e(parseInt(a,10).toString());for(c=0,d='';c<b.length;c++){d+=b[c];if((c+1)%3===0&&c!==(b.length-1)){d+='.';}}return'Rp.\t'+e(d)}

</script>
@endsection
