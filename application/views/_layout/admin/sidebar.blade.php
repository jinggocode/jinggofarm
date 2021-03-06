<div id="sidebar-alt" tabindex="-1" aria-hidden="true">
    <!-- Toggle Alternative Sidebar Button (visible only in static layout) -->
    <a href="javascript:void(0)" id="sidebar-alt-close" onclick="App.sidebar('toggle-sidebar-alt');"><i class="fa fa-times"></i></a>

    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll-alt">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>

<div id="sidebar">
    <!-- Sidebar Brand -->
    <div id="sidebar-brand" class="themed-background">
        <a class="sidebar-title">
            <img src="{{base_url('assets/img/logo.png')}}" width="170" style="padding-top: 4px; padding-left: 20px" class="img-responsive" alt="">
        </a>
    </div>
    <!-- END Sidebar Brand -->

    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">

            <?php $page = $this->uri->segment(2); ?>
            <?php $sub_page = $this->uri->segment(3);  ?>

            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
                <li class="{{($page == "dashboard")?'active' : ''}}">
                    <a href="{{site_url('admin/dashboard')}}"><i class="gi gi-dashboard sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Beranda</span></a>
                </li>
                <li class="sidebar-separator">
                    <i class="fa fa-ellipsis-h"></i>
                </li>
                <li class="{{($page == "cattle" || $page == "cattleman")?'active' : ''}}">
                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-file-text-o sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Kelola Data</span></a>
                    <ul>
                        <li class="{{($page == "cattle")?'active' : ''}}">
                            <a href="{{site_url('admin/cattle')}}"><i class="fa fa-list sidebar-nav-icon"></i> Data Ternak</a>
                        </li>
                        <li class="{{($page == "cattleman")?'active' : ''}}">
                            <a href="{{site_url('admin/cattleman')}}"><i class="fa fa-user-secret sidebar-nav-icon"></i> Data Peternak</a>
                        </li>
                    </ul>
                </li>
                <li class="{{($page == "transaction")?'active' : ''}}">
                    <a href="{{site_url('admin/transaction')}}"><i class="gi gi-bank sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Kelola Transaksi</span></a>
                </li>
                <li class="{{($page == "reporter")?'active' : ''}}">
                    <a href="{{site_url('admin/reporter')}}"><i class="fa fa-file-text-o sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Pelaporan Ternak</span></a>
                </li>
                <li class="{{($page == "pullconfirm" || $page == "balance")?'active' : ''}}">
                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-money sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Kelola Keuangan</span></a>
                    <ul>
                        <li class="{{($page == "pullconfirm" && $sub_page == "")?'active' : ''}}">
                            <a href="{{site_url('admin/pullconfirm')}}">Konfirmasi Penarikan Saldo</a>
                        </li>
                        <li class="{{($page == "balance")?'active' : ''}}">
                            <a href="{{site_url('admin/balance')}}">Saldo Kelompok Ternak</a>
                        </li>
                    </ul>
                </li>
                <li class="{{($page == "report")?'active' : ''}}">
                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-file sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Laporan</span></a>
                    <ul>
                        <li class="{{($sub_page == "profit")?'active' : ''}}">
                            <a href="{{site_url('admin/report/profit')}}">Keuntungan</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-separator">
                    <i class="fa fa-ellipsis-h"></i>
                </li>
                <li class="{{($page == "investor")?'active' : ''}}">
                    <a href="{{site_url('admin/investor')}}"><i class="fa fa-users sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Kelola Data Investor</span></a>
                </li>
                <li class="{{($page == "user")?'active' : ''}}">
                    <a href="{{site_url('admin/user')}}"><i class="gi gi-user sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Kelola Data Pengguna</span></a>
                </li>
            </ul>
            <!-- END Sidebar Navigation -->

        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->

    <!-- Sidebar Extra Info -->
    <div id="sidebar-extra-info" class="sidebar-content sidebar-nav-mini-hide">
        <div class="text-center">
            by <a class="text-primary" href="http://vc.labkode.org" target="_blank">Jinggo.farm</a></small><br>
            <small>2018 &copy; <a href="http://goo.gl/RcsdAh" target="_blank">Beta v.0.1</a></small>
        </div>
    </div>
    <!-- END Sidebar Extra Info -->
</div>
