<?php
if (!$this->ion_auth->logged_in())
{
  // redirect them to the login page
  redirect('auth/login', 'refresh');
}

$user = $this->ion_auth->user()->row();

if ($user->group_id == 2){
    redirect('auth/logout', 'refresh');
} else if ($user->group_id == 3){
    redirect('auth/logout', 'refresh');
}
?>
<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>@yield('title') | Jinggofarm</title>

        <meta name="description" content="AppUI is a Web App Bootstrap Admin Template created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->

        <!-- Favicon-->
        <link rel="shortcut icon" href="{{base_url('assets/img/favicon.png')}}">

        <link rel="apple-touch-icon" href="{{base_url('assets/admin/img/icon57.png')}}" sizes="57x57">
        <link rel="apple-touch-icon" href="{{base_url('assets/admin/img/icon72.png')}}" sizes="72x72">
        <link rel="apple-touch-icon" href="{{base_url('assets/admin/img/icon76.png')}}" sizes="76x76">
        <link rel="apple-touch-icon" href="{{base_url('assets/admin/img/icon114.png')}}" sizes="114x114">
        <link rel="apple-touch-icon" href="{{base_url('assets/admin/img/icon120.png')}}" sizes="120x120">
        <link rel="apple-touch-icon" href="{{base_url('assets/admin/img/icon144.png')}}" sizes="144x144">
        <link rel="apple-touch-icon" href="{{base_url('assets/admin/img/icon152.png')}}" sizes="152x152">
        <link rel="apple-touch-icon" href="{{base_url('assets/admin/img/icon180.png')}}" sizes="180x180">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="{{base_url('assets/admin/css/bootstrap.min.css')}}">

        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="{{base_url('assets/admin/css/plugins.css')}}">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="{{base_url('assets/admin/css/main.css')}}">

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->
        <link rel="stylesheet" href="{{base_url('assets/admin/css/themes/social.css')}}">

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="{{base_url('assets/admin/css/themes.css')}}">

        <!-- Sweet Alert-->
        <script src="{{base_url()}}assets/vendor/sweetalert/sweetalert.min.js"></script>

        <!-- CSS specific page -->
        @yield('style')
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) -->
        <script src="{{base_url('assets/admin/js/vendor/modernizr-3.3.1.min.js')}}"></script>
    </head>
    <body>
        <!-- Page Wrapper -->
        <!-- In the PHP version you can set the following options from inc/config file -->
        <!--
            Available classes:

            'page-loading'      enables page preloader
        -->
        <div id="page-wrapper" class="page-loading">
            <!-- Preloader -->
            <!-- Preloader functionality (initialized in js/app.js) - pageLoading() -->
            <!-- Used only if page preloader enabled from inc/config (PHP version) or the class 'page-loading' is added in #page-wrapper element (HTML version) -->
            <div class="preloader">
                <div class="inner">
                    <!-- Animation spinner for all modern browsers -->
                    <div class="preloader-spinner themed-background hidden-lt-ie10"></div>

                    <!-- Text for IE9 -->
                    <h3 class="text-primary visible-lt-ie10"><strong>Loading..</strong></h3>
                </div>
            </div>
            <!-- END Preloader -->

            <!-- Page Container -->
            <!-- In the PHP version you can set the following options from inc/config file -->
            <!--
                Available #page-container classes:

                'sidebar-light'                                 for a light main sidebar (You can add it along with any other class)

                'sidebar-visible-lg-mini'                       main sidebar condensed - Mini Navigation (> 991px)
                'sidebar-visible-lg-full'                       main sidebar full - Full Navigation (> 991px)

                'sidebar-alt-visible-lg'                        alternative sidebar visible by default (> 991px) (You can add it along with any other class)

                'header-fixed-top'                              has to be added only if the class 'navbar-fixed-top' was added on header.navbar
                'header-fixed-bottom'                           has to be added only if the class 'navbar-fixed-bottom' was added on header.navbar

                'fixed-width'                                   for a fixed width layout (can only be used with a static header/main sidebar layout)

                'enable-cookies'                                enables cookies for remembering active color theme when changed from the sidebar links (You can add it along with any other class)
            -->
            <div id="page-container" class="header-fixed-top sidebar-visible-lg-full">
                <!-- Main Sidebar and sidebar alternative -->
                @include('_layout/admin/sidebar')
                <!-- END Main Sidebar -->

                <!-- Main Container -->
                <div id="main-container">
                    <!-- Header -->
                    <!-- In the PHP version you can set the following options from inc/config file -->
                    <!--
                        Available header.navbar classes:

                        'navbar-default'            for the default light header
                        'navbar-inverse'            for an alternative dark header

                        'navbar-fixed-top'          for a top fixed header (fixed main sidebar with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar())
                            'header-fixed-top'      has to be added on #page-container only if the class 'navbar-fixed-top' was added

                        'navbar-fixed-bottom'       for a bottom fixed header (fixed main sidebar with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar()))
                            'header-fixed-bottom'   has to be added on #page-container only if the class 'navbar-fixed-bottom' was added
                    -->
                    @include('_layout/admin/header')
                    <!-- END Header -->

                    <?php $message = $this->session->userdata('message'); ?>
                    @if($message)
                        <div class="col-md-12">
                            <div style="margin-top: 80px;" class="alert alert-{{ $message[1] }} alert-dismissable" id="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><strong><i class="fa fa-info-circle"></i> Info</strong></h4>
                                <p>{{ $message[0] }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Page content -->
                    @yield('content')
                    <!-- END Page Content -->
                </div>
                <!-- END Main Container -->
            </div>
            <!-- END Page Container -->
        </div>
        <!-- END Page Wrapper -->

        @yield('modal')

        <!-- jQuery, Bootstrap, jQuery plugins and Custom JS code -->
        <script src="{{base_url('assets/admin/js/vendor/jquery-2.2.4.min.js')}}"></script>
        <!-- <script src="https://d19m59y37dris4.cloudfront.net/hub/1-3-0/vendor/jquery/jquery.min.js"></script> -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
        <script src="{{base_url('assets/admin/js/vendor/bootstrap.min.js')}}"></script>
        <script src="{{base_url('assets/admin/js/plugins-2.js')}}"></script>
        <script src="{{base_url('assets/admin/js/app.js')}}"></script>

        <script src="{{base_url('assets/vendor/jquery-loading/')}}dist/loadingoverlay.min.js"></script>

        <script>
          $("#alert").fadeTo(4000, 500).slideUp(500, function(){
              $("#alert").slideUp(300);
          });
          function showAlert() {
              $("#alert").addClass("in");
          }
          window.setTimeout(function () {
              showAlert();
          }, 3000);
        </script>
        <!-- Load and execute javascript code used only in this page -->
        @yield('script')
    </body>
</html>
