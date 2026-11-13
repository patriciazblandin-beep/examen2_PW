<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Sistema Integral de Gestión - Agrovalle Honduras" />
        <meta name="author" content="Patricia Zelaya" />
        <title>@yield('titulo', 'Dashboard') - AGROVALLE HONDURAS</title>
        
        <!-- CSS de Datatables y SB Admin -->
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{ asset('sb-admin/css/styles.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <style>
            body {
                padding-top: 56px;
            }
            #layoutSidenav_nav {
                position: fixed;
                top: 56px;
                left: 0;
                width: 225px;
                height: calc(100vh - 56px);
                z-index: 1038;
            }
            #layoutSidenav_content {
                padding-left: 225px; 
                width: 100%;
                box-sizing: border-box;
            }
            @media (max-width: 992px) {
                #layoutSidenav_content {
                    padding-left: 0; 
                }
            }
          .sb-topnav.navbar,
            .sb-sidenav-dark {
                background-color: #B7D2B6 !important;
                color: #1f2937 !important;
            }

            .sb-sidenav-dark .sb-sidenav-menu-heading {
                color: #374151 !important;
                font-weight: bold;
            }
            .sb-sidenav-dark .sb-sidenav-menu .nav-link {
                color: #1f2937 !important;
            }
            .sb-sidenav-dark .sb-sidenav-menu .nav-link:hover {
                color: #111827 !important;
                background-color: rgba(0, 0, 0, 0.08) !important;
            }

            .sb-sidenav-dark .sb-sidenav-footer {
                background-color: rgba(0, 0, 0, 0.08) !important;
                color: #1f2937 !important;
            }

            .sb-topnav .navbar-brand,
            .sb-topnav .nav-link,
            .sb-topnav .btn-link {
                color: #1f2937 !important;
            }
            .sb-topnav .navbar-brand:hover,
            .sb-topnav .nav-link:hover {
                color: #111827 !important;
            }
            
            

        </style>
    </head>
    <body class="sb-nav-fixed">
        <!-- NAVBAR SUPERIOR -->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3 font-weight-bold" href="#">
                <i class="fas fa-seedling me-2 text-success"></i>AGROVALLE
            </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
                <i class="fas fa-bars"></i>
            </button>
            
            <!-- Navbar Search -->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Buscar..." aria-label="Buscar..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            
            <!-- Menú de Usuario Autenticado -->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fa-fw"></i> Administrador
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Configuración</a></li>
                        <li><a class="dropdown-item" href="#!">Registro de Actividad</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                        
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Cerrar Sesión</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav">
            <!-- SIDEBAR LATERAL -->
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Principal</div>
                            
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt text-warning"></i></div>
                                Dashboard Gerencial
                            </a>

                            <div class="sb-sidenav-menu-heading">Módulos del Sistema</div>
                            
                            <!-- Enlace Activo Dinámico para Insumos -->
                            <a class="nav-link {{ request()->routeIs('insumos.*') ? 'active' : '' }}" href="{{ route('insumos.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-boxes-stacked text-info"></i></div>
                                Catálogo de Insumos
                            </a>

                            <!-- Enlace Activo Dinámico para Proveedores -->
                            <a class="nav-link {{ request()->routeIs('proveedores.*') ? 'active' : '' }}" href="{{ route('proveedores.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-truck-field text-success"></i></div>
                                Proveedores Agrícolas
                            </a>

                            <!-- Enlace Activo Dinámico para Empleados -->
                            <a class="nav-link {{ request()->routeIs('empleados.*') ? 'active' : '' }}" href="{{ route('empleados.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-users-gear text-danger"></i></div>
                                Personal y Nómina
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Conectado como:</div>
                        Administrador / Agrovalle
                    </div>
                </nav>
            </div>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 mt-4">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                            </div>
                        @endif

                        @yield('contenido')
                    </div>
                </main>

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Agrovalle Honduras 2026</div>
                            <div>
                                <a href="#">Política de Privacidad</a>
                                &middot;
                                <a href="#">Términos y Condiciones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- Scripts JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('sb-admin/js/scripts.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('sb-admin/js/datatables-simple-demo.js') }}"></script>
    </body>
</html>