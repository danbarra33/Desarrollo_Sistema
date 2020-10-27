<!--

=========================================================
* Now UI Dashboard - v1.5.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="../assets/img/apple-icon.png"
    />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>CRÉDITOS Y VALES DEL NOROESTE</title>
    <meta
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no"
      name="viewport"
    />
    <!--     Fonts and icons     -->
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
      integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
      crossorigin="anonymous"
    />
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="{{url('/css/now-ui-dashboard.css?v=1.5.0')}}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
  </head>

  <body class="">
    <div class="wrapper">
      <div class="sidebar" data-color="dark-gray">
        <!--
      Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow | dark-gray "
  -->
        <div class="logo">
          <a href="http://www.creative-tim.com" class="simple-text logo-mini">
            CT
          </a>
          <a href="http://www.creative-tim.com" class="simple-text logo-normal">
            Creative Team
          </a>
        </div>
        <div class="sidebar-wrapper" id="sidebar-wrapper">
          <ul class="nav">
            <li>
              <a href="./dashboard.html">
                <i class="now-ui-icons design_app"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li>
              <a href="./notifications.html">
                <i class="now-ui-icons ui-1_bell-53"></i>
                <p>Notifications</p>
              </a>
            </li>
            <li>
              <a href="{{url('/users/perfil')}}">
                <i class="now-ui-icons users_single-02"></i>
                <p>Perfil Usuario</p>
              </a>
            </li>
            <li class="{{Route::getCurrentRoute()->getName() == 'clientesListado' ? 'active' : ''}}">
              <a href="{{url('/clientes')}}">
                <i class="now-ui-icons design_app"></i>
                <p>Clienes</p>
              </a>
            </li>
            <li class="{{Route::getCurrentRoute()->getName() == 'clientesAgregar' ? 'active' : ''}}">
              <a href="{{url('/clientes/agregar')}}">
                <i class="now-ui-icons design_app"></i>
                <p>Añadir Cleintes</p>
              </a>
            </li>
            <li>
              <a href="./tables.html">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p>Table List</p>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="main-panel" id="main-panel">
        <!-- Navbar -->
        <nav
          class="navbar navbar-expand-lg navbar-transparent bg-white navbar-absolute"
        >
          <div class="container-fluid">
            <div class="navbar-wrapper">
              <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </button>
              </div>
              <a class="navbar-brand" href="#pablo">Clientes</a>
            </div>
            <form>
              <div class="input-group no-border">
                <input
                  type="text"
                  value=""
                  class="form-control"
                  placeholder="Search..."
                />
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </nav>
        <!-- End Navbar -->
        <div class="panel-header panel-header-sm"></div>
        <div class="content" id="{{url('/client')}}">
          @yield('content')
        </div>
        <footer class="footer"{{url('/client')}}
          <div class="container-fluid text-light">
            <div class="copyright" id="copyright">
              &copy;
              <script>
                document
                  .getElementById("copyright")
                  .appendChild(
                    document.createTextNode(new Date().getFullYear())
                  );
              </script>
              , Hecho por
              <a href="https://fic.uas.edu.mx/" target="_blank"
                >Alumnos de la FIC</a
              >. Estudiando en la
              <a href="https://www.uas.edu.mx/" target="_blank">UAS</a>.
            </div>
          </div>
        </footer>
      </div>
    </div>

    <!--   Core JS Files   -->
    <script src="{{url('/js/core/jquery.min.js')}}"></script>
    <script src="{{url('/js/core/popper.min.js')}}"></script>
    <script src="{{url('/js/core/bootstrap.min.js')}}"></script>
    <script src="{{url('/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
    <!--  Google Maps Plugin    -->
 
    <!-- Chart JS -->
    <script src="{{url('/js/plugins/chartjs.min.js')}}"></script>
    <!--  Notifications Plugin    -->
    <script src="{{url('/client')}}"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{url('/js/now-ui-dashboard.min.js?v=1.5.0')}}" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->

  </body>
</html>
