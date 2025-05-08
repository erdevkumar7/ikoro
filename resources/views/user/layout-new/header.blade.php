<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/') }}" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">   
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      @if(Auth::user())
      @endif



      <li class="nav-item dropdown">

        <a class="nav-link" data-toggle="dropdown" href="#">
          <?php if(Auth::user()){
              echo Auth::user()->name;
          }else{
              echo "Admin";
          } ?>
          <i class="right fas fa-angle-down"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
          <a href="javascript:;" class="dropdown-item">
              <i class="fas fa-user mr-2"></i>Profile
          </a>
        

          <div class="dropdown-divider"></div>

          <!--
          <a href="{{url('/admin/changePassword')}}" class="dropdown-item">
              <i class="fas fa-lock mr-2"></i> Change Password
          </a>
          -->
          <div class="dropdown-divider"></div>
          <?php
            if(Auth::user()){
              // echo Auth::user();
          ?>


          <!-- <a href="{{url('/admin/logout')}}" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a> -->

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>

          <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>





          <?php  
            }
          ?>   
        </div>

      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">