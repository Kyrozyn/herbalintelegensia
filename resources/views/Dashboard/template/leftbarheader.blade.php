<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{'/dashboard'}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-cart"></i><span class="hide-menu">Data Pemesanan </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('pemesanan.create')}}" aria-expanded="false"><i class="mdi mdi-rocket"></i><span class="hide-menu">Pemesanan Baru</span></a></li>
                        <li class="sidebar-item"><a href="{{route('pemesanan.index')}}" class="sidebar-link"><i class="mdi mdi-rocket"></i><span class="hide-menu">Lihat Semua Pemesanan</span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-rocket"></i><span class="hide-menu">Pengiriman </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false"><i class="mdi mdi-rocket"></i><span class="hide-menu">Buat Invoice & Rute</span></a></li>
                        <li class="sidebar-item"><a href="#" class="sidebar-link"><i class="mdi mdi-rocket"></i><span class="hide-menu">Lihat Invoice Pengiriman</span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-circle"></i><span class="hide-menu">Data Pelanggan </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{url('/pelanggan/tambah')}}" class="sidebar-link"><i class="mdi mdi-account-plus"></i><span class="hide-menu">Tambah Pelanggan</span></a></li>
                        <li class="sidebar-item"><a href="{{url('/pelanggan')}}" class="sidebar-link"><i class="mdi mdi-account"></i><span class="hide-menu">Lihat Semua Pelanggan</span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-box-shadow"></i><span class="hide-menu">Data Produk </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('produk.create')}}" aria-expanded="false"><i class="mdi mdi-plus-box"></i><span class="hide-menu">Tambah Produk</span></a></li>
                        <li class="sidebar-item"><a href="{{route('produk.index')}}" class="sidebar-link"><i class="mdi mdi-box-shadow"></i><span class="hide-menu">Lihat Semua Produk</span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-car"></i><span class="hide-menu">Data Kendaraan </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="#" class="sidebar-link"><i class="mdi mdi-car-connected"></i><span class="hide-menu">Tambah Kendaraan</span></a></li>
                        <li class="sidebar-item"><a href="#" class="sidebar-link"><i class="mdi mdi-car"></i><span class="hide-menu">Lihat Kendaraan</span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-location"></i><span class="hide-menu">Pengolahan Akun </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{url('/user/tambah')}}" class="sidebar-link"><i class="mdi mdi-account-plus"></i><span class="hide-menu">Tambah User</span></a></li>
                        <li class="sidebar-item"><a href="{{url('/user')}}" class="sidebar-link"><i class="mdi mdi-account"></i><span class="hide-menu">Lihat User</span></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
