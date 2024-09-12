<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>HealthSync</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('assets/img/logo.jpg')}}" rel="icon">
  <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <!-- font-awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
  

  <!-- Script Formulaire à étape -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@latest/dist/apexcharts.css">
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>

  <style>
    .form-section {
      display: none;
    }

    .form-section.current {
      display: inline;
    }

    .parsley-errors-list {
      color: red;
    }

  </style>
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a class="logo d-flex align-items-center">
        <img src="{{ asset('assets/img/logo.jpg') }}" alt="Logo">
        <span class="d-none d-lg-block">HealthSync</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav d-flex align-items-center ms-auto">

      

      @if (Auth::user()->type_compte == 'Traitant' )
        <a class="nav-link nav-icon" href="{{route('Service_Infantile.demande_modification.index')}}">
          <span class="d-none d-md-block ps-2 fs-6">Nouvelle demande</span>
        </a>
      @endif

      @if (Auth::user()->type_compte == 'admin' && Auth::user()->demandeModif != null)
        <a class="nav-link nav-icon" href="{{route('register')}}">
          <span class="d-none d-md-block ps-2 fs-6">Créer un compte</span>
        </a>
      @endif
        
      <ul class="d-flex align-items-center mb-0 list-unstyled">
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
          </a><!-- End Profile Image Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('profile.edit')}}">
                <i class="bi bi-person"></i>
                <span>Mon Profile</span>
              </a>
            </li>
            

            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="dropdown-item d-flex align-items-center">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Se déconnecter</span>
                </button>
              </form>
            </li>
          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
      </ul>
    </nav><!-- End Icons Navigation -->
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link collapsed {{ Route::currentRouteName() == 'Service_Infantile.list_child' ? 'active' : '' }}" href="{{ route('Service_Infantile.list_child') }}">
        <i class="fa fa-house-medical"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed {{ Route::currentRouteName() == 'Service_Infantile.child.index' || Route::currentRouteName() == 'Service_Infantile.child.create' ? 'active' : '' }}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="fa fa-user"></i><span>Patient</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse {{ Route::currentRouteName() == 'Service_Infantile.child.index' || Route::currentRouteName() == 'Service_Infantile.child.create' ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
        <li>
          <a class="{{ Route::currentRouteName() == 'Service_Infantile.child.index' ? 'active' : '' }}" href="{{ route('Service_Infantile.child.index') }}">
            <i class="bi bi-circle"></i><span>Liste des Patients</span>
          </a>
        </li>
        <li>
          <a class="{{ Route::currentRouteName() == 'Service_Infantile.child.create' ? 'active' : '' }}" href="{{ route('Service_Infantile.child.create') }}">
            <i class="bi bi-circle"></i><span>Enregistrer un patient</span>
          </a>
        </li>
      </ul>
    </li><!-- End Patient Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed {{ Route::currentRouteName() == 'Service_Infantile.consultation.index' ? 'active' : '' }}" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="fa fa-notes-medical"></i><span>Consultation</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse {{ Route::currentRouteName() == 'Service_Infantile.consultation.index' ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
        <li>
          <a class="{{ Route::currentRouteName() == 'Service_Infantile.consultation.index' ? 'active' : '' }}" href="{{ route('Service_Infantile.consultation.index') }}">
            <i class="bi bi-circle"></i><span>Vos patients</span>
          </a>
        </li>
      </ul>
    </li><!-- End Consultation Nav -->

    <!-- Traitement Nav -->
    <li class="nav-item">
      <a class="nav-link collapsed {{ Route::currentRouteName() == 'Service_Infantile.suivie.index' ? 'active' : '' }}" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="fa fa-kit-medical"></i><span>Infirmerie</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="tables-nav" class="nav-content collapse {{ Route::currentRouteName() == 'Service_Infantile.suivie.index' ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
        <li>
          <a class="{{ Route::currentRouteName() == 'Service_Infantile.suivie.index' ? 'active' : '' }}" href="{{ route('Service_Infantile.suivie.index') }}">
            <i class="bi bi-circle"></i><span>Suivie à faire</span>
          </a>
        </li>
        <li>
          <a href="tables-data.html">
            <i class="bi bi-circle"></i><span>Data Tables</span>
          </a>
        </li>
      </ul>
    </li><!-- End Traitement Nav -->
  </ul>
</aside><!-- End Sidebar-->



  @yield('content')

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>HealthSync</span></strong>. Tous droit Réservé
    </div>
  </footer><!-- End Footer -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- <script src="{{asset('assets/vendor/chart.js/chart.umd.js')}}"></script> --> 
  <!-- <script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script> --> 
  <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
  <script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('assets/js/main.js')}}"></script>

</body>

</html>
