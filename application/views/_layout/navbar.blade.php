<nav class="navbar fixed-top navbar-expand-md bg-secondary navbar-dark text-white" style="
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.15);">
  <a class="navbar-brand" href="{{site_url()}}"><b>  <img src="{{base_url('assets/img/logo.png')}}" width="200"></b></a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
    aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto"> </ul>
    <?php $page = $this->uri->segment(1); ?>
    <ul class="navbar-nav right">
      <li class="nav-item {{($page == '')?'activet':''}}">
        <a style="font-weight: 900;" class="nav-link {{($page == '')?'text-secondary':'text-light'}}" href="{{site_url()}}"><i class="fa d-inline fa-lg fa-home"></i> Beranda</a>
      </li>
      <li class="nav-item {{($page == 'cattle')?'activet':''}}">
        <a style="font-weight: 900;" class="nav-link {{($page == 'cattle')?'text-secondary':'text-light'}}" href="{{site_url('cattle')}}"><i class="fa d-inline fa-lg fa-list"></i> Pilihan Investasi</a>
      </li>
      <li class="nav-item {{($page == 'faq')?'activet':''}}">
        <a style="font-weight: 900;" class="nav-link {{($page == 'faq')?'text-secondary':'text-light'}}" href="{{site_url('faq')}}"><i class="fa d-inline fa-lg fa-question-circle"></i> Pertanyaan</a>
      </li>
    </ul>
    <div class="btn-group px-3">
      <form class="form-inline ">
        <a style="font-weight: 900;" href="{{site_url('auth/create_user')}}" class="btn btn-outline-light mr-2 bg-secondary">Daftar</a>
        <a style="font-weight: 900;" href="{{site_url('auth/login ')}}" class="btn btn-primary">Masuk</a>
      </form>
    </div>
  </div>
</nav> <br><br>
<div class="mb-3">

</div>
