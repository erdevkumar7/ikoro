<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Dashboard</title>
  <link rel="shortcut icon" href="{{url('/')}}/public/img/favicon-icin.png" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('resources/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('resources/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('resources/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('resources/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('resources/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('resources/plugins/daterangepicker/daterangepicker.css')}}"> 

   <link rel="stylesheet" href="{{url('/')}}/resources/css/style.css">

   <link rel="stylesheet" href="{{url('/')}}/resources/css/custom.css">

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">

   <link href="{{ asset('resources/css/notification-custom.css') }}" rel="stylesheet" />
   <link href="{{ asset('resources/css/raone/jquery-ui.min.css') }}" rel="stylesheet" />

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

   @yield('current_page_css')

   </head>

   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
         <input type="hidden" value="{{url('/')}}" id="baseUrl" name="baseUrl">
         <input type="hidden" value="{{ csrf_token() }}" id="csrfToken" name="csrfToken">
 
         <!-- Navbar Header -->

         @include('admin.layout.header')



         <!-- Main Sidebar Container -->         

         @include('admin.layout.sidebar')

         

         @yield('content')



         <!-- /.Footer -->

         @include('admin.layout.footer')

         

      </div>

      <!-- ./wrapper -->

   
  <script type="text/javascript" src="{{ asset('resources/js/raone/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('resources/js/raone/jquery-ui.min.js') }}"></script>
   <script>
   $.widget.bridge('uibutton', $.ui.button)
   </script>
   <!-- Bootstrap 4 -->
   <script src="{{ asset('resources/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

   <!-- bs-custom-file-input -->
   <script src="{{ asset('resources/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script> 
   <!-- jQuery Knob Chart -->
   <script src="{{ asset('resources/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
   <!-- daterangepicker -->
   <script src="{{ asset('resources/plugins/moment/moment.min.js')}}"></script>
   <script src="{{ asset('resources/plugins/daterangepicker/daterangepicker.js')}}"></script>
   <!-- Tempusdominus Bootstrap 4 -->
   <script src="{{ asset('resources/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

   <!-- overlayScrollbars -->
   <script src="{{ asset('resources/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
   <!-- AdminLTE App -->
   <script src="{{ asset('resources/dist/js/adminlte.js')}}"></script>
   <!-- AdminLTE for demo purposes -->
   <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
   <script src="{{ asset('resources/dist/js/pages/dashboard.js')}}"></script>

   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
   
   <script src="{{ asset('resources/js/notification-custom-script.js') }}"></script>
   <script src="https://malsup.github.io/jquery.form.js"></script>

   <script src="{{ asset('resources/js/raone/jquery.validate.min.js') }}"></script>
   <script src="{{ asset('resources/js/raone/jquery.form.js') }}"></script>

   <script src="{{ asset('resources/js/forms.js') }}"></script>
   <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places"></script>
   <script type="text/javascript">
     /*** add active class and stay opened when selected ***/
    var url = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
        if (this.href) {
            return this.href == url || url.href.indexOf(this.href) == 0;
        }
    }).addClass('active');

    // for the treeview
    $('ul.nav-treeview a').filter(function() {
        if (this.href) {
            return this.href == url || url.href.indexOf(this.href) == 0;
        }
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
       </script>
   <!-- <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places&callback=initialize" async defer></script> -->
   
   
   @yield('current_page_js')

   </body>

</html>