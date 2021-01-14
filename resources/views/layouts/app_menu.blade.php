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
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>CRÉDITOS Y VALES DEL NOROESTE</title>
    <meta
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no"
      name="viewport"
    />

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!--     Fonts and icons     -->
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200"
      rel="stylesheet"
    />
    @if(env('APP_DEBUG') == true)
    <script src="https://kit.fontawesome.com/fe1e44a2e8.js" crossorigin="anonymous"></script>
    @else
    <script src="https://kit.fontawesome.com/f883511efc.js" crossorigin="anonymous"></script>
    @endif
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="{{url('/css/now-ui-dashboard.css?v=1.5.0')}}" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js"></script>
    @if(env('APP_DEBUG') == true)
      <!-- development version, includes helpful console warnings -->
      <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    @else
      <!-- production version, optimized for size and speed -->
      <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    @endif

  </head>

  <body class="">
    <div class="wrapper">
      <div class="sidebar" data-color="dark-gray">
        <!--
      Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow | dark-gray "
  -->
        <div class="logo">
          <div class="simple-text logo-normal">
            Menú
          </div>
        </div>
        <div class="sidebar-wrapper" id="sidebar-wrapper">
          <ul class="nav">
            <li class="{{Route::getCurrentRoute()->getName() == 'home' ? 'active' : ''}}">
              <a href="{{url('/home')}}">
                <i class="fas fa-box"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="{{strpos(Route::getCurrentRoute()->getName(), 'prestamos') !== false ? 'active' : ''}}">
              <a href="{{url('/prestamos')}}">
              <i class="fas fa-hand-holding-usd"></i>
                <p>Prestamos</p>
              </a>
            </li>
            <li class="{{strpos(Route::getCurrentRoute()->getName(), 'pagoslistado') !== false ? 'active' : ''}}">
              <a href="{{url('/pagos/listado')}}">
              <i class="fas fa-donate"></i>
                <p>Pagos</p>
              </a>
            </li>      
            <li class="{{strpos(Route::getCurrentRoute()->getName(), 'clientes') !== false ? 'active' : ''}}">
              <a href="{{url('/clientes')}}">
                <i class="fas fa-users"></i>
                <p>Clientes</p>
              </a>
            </li>
            <li class="{{strpos(Route::getCurrentRoute()->getName(), 'buro') !== false ? 'active' : ''}}">
              <a href="{{url('/pagos/tipos')}}">
              <i class="far fa-credit-card"></i>
                <p>Buró de crédito</p>
              </a>
            </li>
            <li class="{{strpos(Route::getCurrentRoute()->getName(), 'avales') !== false ? 'active' : ''}}">
              <a href="{{url('/avales')}}">
                <i class="fas fa-piggy-bank"></i>
                <p>Avales</p>
              </a>
            </li>
            <li class="{{strpos(Route::getCurrentRoute()->getName(), 'empleados') !== false ? 'active' : ''}}">
              <a href="{{url('/empleados')}}">
                <i class="fas fa-people-carry"></i>
                <p>Empleados</p>
              </a>
            </li>
            <li class="{{strpos(Route::getCurrentRoute()->getName(), 'sucursales') !== false ? 'active' : ''}}">
              <a href="{{url('/sucursales')}}">
                <i class="fas fa-hotel"></i>
                <p>Sucursales</p>
              </a>
            </li>  
            <meta charset="utf-8" />
            <li class="{{strpos(Route::getCurrentRoute()->getName(), 'indexTiposPagos') !== false ? 'active' : ''}}">
              <a href="{{url('/pagos/tipos')}}">
                <i class="fas fa-money-bill-wave"></i>
                <p>Métodos de Pago</p>
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
              @if(strpos(Route::getCurrentRoute()->getName(), 'clientes') !== false)
              <a class="navbar-brand" href="{{url('/clientes')}}">Clientes</a>
              @elseif(Route::getCurrentRoute()->getName() == 'home')      
                <a class="navbar-brand" href="{{url('/home')}}">Dashboard</a>
              @endif
            </div>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-user fa-2x"></i>
                  <p>
                    <span class="d-lg-none d-md-block"> {{ Auth::user()->name }}</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{url('/users/perfil')}}">Perfil</a>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                      Salir
                  </a>
                </div>
              </li>
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </div>
        </nav>
        <!-- End Navbar -->
        <div class="panel-header panel-header-sm"></div>
        <div class="content">
          @yield('content')
        </div>
        <footer class="footer">
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
    <script src="{{url('/js/core/popper.min.js')}}"></script>
    <script src="{{url('/js/core/bootstrap.min.js')}}"></script>
    <script src="{{url('/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{url('/js/notify.js')}}"></script>

    <!--  Google Maps Plugin    -->
 
    <!-- Chart JS -->
    <script src="{{url('/js/plugins/chartjs.min.js')}}"></script>
    <!--  Notifications Plugin    -->
    <script src="{{url('/client')}}"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{url('/js/now-ui-dashboard.min.js?v=1.5.0')}}" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->


  </body>
</html>
