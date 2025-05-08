<style>
    img.brand-image.img-circle.elevation-3 {
        float: left;
        line-height: .8;
        margin-left: .8rem;
        margin-right: .5rem;
        margin-top: -3px;
        width: 40px !important;
        max-height: 40px !important;
        height: 40px !important;
        object-fit: cover !important;
    }
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('user.dashboard') }}" class="brand-link">

        <img src="{{ asset('backend/admin/images/unnamed-removebg-preview.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">

        <span class="brand-text font-weight-light">{{ ucfirst(auth()->user()->name) }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('user.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.booking') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>My Bookings</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('user.wallet') }}" class="nav-link">
                        <i class="nav-icon fa fa-wallet"></i>
                        <p>
                            My Wallet
                        </p>
                    </a>
                </li>             

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
