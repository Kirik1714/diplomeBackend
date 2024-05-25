<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css')}}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }} ">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
 
  <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <p class="animation__shake">
        BoriMed
    </p>
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

    <!-- Right navbar links -->
  
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href=" {{route('main.index')}}" class="brand-link">
      <span class="brand-text font-weight-light">BoriMed</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
   

    
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
   
       
          <li class="nav-item">
            <a href="{{route('pharmacy.index')}}" class="nav-link">
           <i class="nav-icon fas fa-plus-square"></i>
              <p>
              Аптеки
              </p>
            </a>
          </li>
       
          
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-solid fa-tablets"></i>
              <p>
               Лекарства
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{route('medicine.list.index')}}" class="nav-link">
                <i class="nav-icon fas fa-solid fa-list"></i>
              <p>
               Список 
              </p>
                </a>
              <li class="nav-item">
                <a href="{{route('medicine.form.index')}}" class="nav-link">
                <i class="nav-icon fas fa-solid fa-flask"></i> 
              <p>
               Формы 
              </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('medicine.classification.index')}}" class="nav-link">
                <i class="nav-icon fas  fa-solid fa-circle"></i> 
              <p>
               Классификация 
              </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('medicine.supplier.index')}}" class="nav-link">
                 <i class="nav-icon fas  fa-solid fa-warehouse"></i>
              <p>
               Поставщики 
              </p>
                </a>
                <li class="nav-item">
                <a href="{{route('medicine.status.index')}}" class="nav-link">
                 <i class="nav-icon fas far fa-check-circle"></i>
              <p>
               Статус 
              </p>
                </a>
              </li>
            </ul>
          </li>
          
      
          <li class="nav-item">
            <a href="{{route('user.index')}}" class="nav-link">
           <i class="nav-icon fas fa-user"></i>
              <p>
              Пользователи
              </p>
            </a>
          </li>
    
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020-{{now()->year}} <a href="">BackendDrugs for diploma project </a>.</strong>
    Все права защищены Kirill Shatilo
 
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@yield('scripts')

<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.js')}}"></script>

<script src="{{asset('adminlte/plugins/chart.js/Chart.min.js')}}"></script>


<script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{asset('bootstrap/js/bootstrap.js') }}"></script>
<script>
   
      $('.form').select2();
      $('.classification').select2()
      $('.supplier').select2();
      $('.status').select2();
      $('.medicine').select2();
      $('.availability').select2();


   



       

</script>
</body>
</html>
