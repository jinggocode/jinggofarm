@layout('_layout/investor/index')

@section('title')Profil Pengguna @endsection

@section('content')
<div class="opaque-overlay bg-secondary">
  <div class="container py-4">
    <div class="row">
      <div class="col-md-3 col-lg-2 col-sm-4 text-white">
        <img src="{{base_url('assets/img/investor.png')}}" class="rounded-circle" width="140">
      </div>
      <div class="col-md-8 col-lg-8 col-sm-8 text-white py-4 mt-3">
        <h2>{{$user->first_name}}</h2>
        <hr class="text-white border border-light mx-0" style="width: 10%">
      </div>
    </div>
  </div>
</div>
<div class="" style="background-color: #E8EAF6">
  <div class="container">
     <div class="row">
       <div class="col-md-3 bg-light pt-3">
         <div class="list-group">
            <a href="{{site_url('investor/profile')}}" class="list-group-item list-group-item-action">
              <i class="fa fa-user"></i> Profil
            </a>
            <a href="#" class="list-group-item list-group-item-action active"><i class="fa fa-key"></i> Ubah Password</a>
          </div>
       </div>

       <div class="col-lg-9 bg-white pb-5">
        <div class="py-3">
          <h3>Ubah Password</h3>
        </div>

        @if (!empty(validation_errors()))
        <div class="alert alert-danger" role="alert">
          <p>{{validation_errors()}}</p>
        </div>
        @endif

         <form action="{{site_url('investor/profile/change_password')}}" method="post">
           {{$csrf}}
           {{form_hidden('id', $user->id)}}
           <div class="form-group">
             <label for="password">Password Baru</label>
             <input value="{{set_value('password')}}" name="password" type="password" class="form-control" id="password">
           </div>
           <div class="form-group">
             <label for="reenter_password">Ulangi Password</label>
             <input value="{{set_value('reenter_password')}}" name="reenter_password" type="password" class="form-control" id="reenter_password">
           </div>
           <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Ubah</button>
         </form>
       </div>
     </div>
  </div>
</div>
@endsection
