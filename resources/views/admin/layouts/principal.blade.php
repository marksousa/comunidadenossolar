<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

  <link href="{{ asset('css/nunito.css') }}" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('css/app.css')}}" rel="stylesheet">
  <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
  <link href="{{asset('css/admin-estilo.css')}}" rel="stylesheet">

  @yield('page-level-css')

  <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon" />

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin-home')}}">
        <div class="sidebar-brand-icon">
          {{-- <i class="fas fa-laugh-wink"></i> --}}
          <img src="{{ asset('img/logo.png') }}" alt="logomarca do nosso lar" width="60%">
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }}</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      {{-- <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{route('admin-home')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
      </li> --}}

      @can('usuarios-create')
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Formulários
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForms" aria-expanded="true" aria-controls="collapseForms">
          <i class="fas fa-fw fa-user"></i>
          <span>Usuários</span>
        </a>
        <div id="collapseForms" class="collapse" aria-labelledby="headingForms" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Recursos Trabalhador</h6>
            @can('usuarios-create')
            <a class="collapse-item" href="{{ route('UsuarioCreate') }}">Cadastrar Assistido</a>
            @endcan
            @can('usuarios-view')
            <a class="collapse-item" href="{{ route('UsuarioIndex') }}">Listar Assistidos</a>
            @endcan
            {{-- <a class="collapse-item" href="cards.html">Pesquisar Assistido</a> --}}
          </div>
        </div>
      </li>
      @endcan

      @can('admin-resources')

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Recursos Admin
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-users"></i>
          <span>Users</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Users do NL</h6>
            <a class="collapse-item" href="{{ route('UserIndex') }}">Users</a>
            {{-- <a class="collapse-items" href="cards.html">Cards</a> --}}
          </div>
        </div>
      </li>

      <!-- Nav Item - Papeis Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePapeis" aria-expanded="true" aria-controls="collapsePapeis">
          <i class="fas fa-user-lock"></i>
          <span>Papéis e Permissões</span>
        </a>
        <div id="collapsePapeis" class="collapse" aria-labelledby="headingPapeis" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            {{-- <h6 class="collapse-header">Segurança</h6> --}}
            <a class="collapse-item" href="{{ route('papeis.index') }}">Papéis</a>
            <a class="collapse-item" href="{{ route('permissoes.index') }}">Permissões</a>
          </div>
        </div>
      </li>
      @endcan

      @can('saude-resources')

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Pilar da Saúde
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Configurações</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Recursos Saúde:</h6>
            <a class="collapse-item" href="{{ route('especialidades.index') }}">Especialidades</a>
            <a class="collapse-item" href="{{ route('consultorios.index') }}">Consultórios</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
          </div>
        </div>
      </li>

      @endcan

      {{-- <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li> --}}

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          {{-- <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
          --}}

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            {{-- <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
            --}}

            {{-- <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>
            --}}

            {{-- <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://avatars.dicebear.com/api/avataaars/{{ rand(1,300) }}.svg" alt="">
            <div class="status-indicator bg-success"></div>
      </div>
      <div class="font-weight-bold">
        <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
        <div class="small text-gray-500">Emily Fowler · 58m</div>
      </div>
      </a>
      <a class="dropdown-item d-flex align-items-center" href="#">
        <div class="dropdown-list-image mr-3">
          <img class="rounded-circle" src="https://avatars.dicebear.com/api/avataaars/{{ rand(1,300) }}.svg" alt="">
          <div class="status-indicator"></div>
        </div>
        <div>
          <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
          <div class="small text-gray-500">Jae Chun · 1d</div>
        </div>
      </a>
      <a class="dropdown-item d-flex align-items-center" href="#">
        <div class="dropdown-list-image mr-3">
          <img class="rounded-circle" src="https://avatars.dicebear.com/api/avataaars/{{ rand(1,300) }}.svg" alt="">
          <div class="status-indicator bg-warning"></div>
        </div>
        <div>
          <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
          <div class="small text-gray-500">Morgan Alvarez · 2d</div>
        </div>
      </a>
      <a class="dropdown-item d-flex align-items-center" href="#">
        <div class="dropdown-list-image mr-3">
          <img class="rounded-circle" src="https://avatars.dicebear.com/api/avataaars/{{ rand(1,300) }}.svg" alt="">
          <div class="status-indicator bg-success"></div>
        </div>
        <div>
          <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
          <div class="small text-gray-500">Chicken the Dog · 2w</div>
        </div>
      </a>
      <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
    </div>
    </li>
    --}}

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
        @if(is_null(Auth::user()->avatar))
        <img class="img-profile rounded-circle" id="top-img-profile" src="https://ui-avatars.com/api/?size=160&rounded=true&name={{ Str::replaceFirst(' ','+', Auth::user()->name) }}" alt="avatar">
        @else
        <img class="img-profile rounded-circle" id="top-img-profile" src="{{ asset('storage')."/".Auth::user()->avatar }}" alt="avatar">
        @endif
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        @isset(Auth::user()->usuario_id)
        <a class="dropdown-item" href="{{ route('UsuarioShow', ['id' => Auth::user()->usuario_id]) }}">
          @else
          <a class="dropdown-item" href="{{ route('admin-home') }}">
            @endisset
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Perfil
          </a>

          {{-- <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a> --}}

          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Sair
          </a>
      </div>
    </li>

    </ul>

    </nav>
    <!-- End of Topbar -->

    @yield('conteudo')

  </div>
  <!-- End of Main Content -->

  <!-- Footer -->
  <footer class="sticky-footer footer navbar-fixed-bottom bg-white">
    <div class="pb-0">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright &copy; Tekyou Soluções {{ date("Y") }}</span>
        </div>
      </div>
    </div>
  </footer>
  <!-- End of Footer -->

  </div>
  <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Deseja sair?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Clique em "Sair" abaixo se deseja encerrar sua sessão atual.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-primary" type="submit">Sair</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

  @yield('page-level-scripts')

</body>

</html>