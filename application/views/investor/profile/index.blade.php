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
            <a href="#" class="list-group-item list-group-item-action active">
              <i class="fa fa-user"></i> Profil
            </a>
            <a href="{{site_url('investor/profile/password')}}" class="list-group-item list-group-item-action"><i class="fa fa-key"></i> Ubah Password</a>
          </div>
       </div>

       <div class="col-lg-9 bg-white pb-5">
        <div class="py-3">
          <h3>Profil Pengguna</h3>
        </div>

        @if (!empty(validation_errors()))
        <div class="alert alert-danger" role="alert">
          <p>{{validation_errors()}}</p>
        </div>
        @endif

         <form action="{{site_url('investor/profile/update')}}" method="post">
           {{$csrf}}
           {{form_hidden('id', $user->id)}}
           <div class="form-group">
             <label for="first_name">Nama</label>
             <input value="{{$user->first_name}}" name="first_name" type="text" class="form-control" id="first_name" aria-describedby="emailHelp">
           </div>
           <div class="form-group">
             <label for="first_name">Email</label>
             <input value="{{$user->email}}" name="email" type="text" class="form-control" id="first_name">
           </div>
           <div class="form-group">
             <label for="first_name">Nomor Telepon</label>
             <input value="{{$user->phone}}" name="phone" type="text" class="form-control" id="first_name">
           </div>
           <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Ubah</button>
         </form>
       </div>
     </div>
  </div>
</div>
@endsection
