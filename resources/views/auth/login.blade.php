<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Iniciar Sesión - AGROVALLE HONDURAS</title>
    <link href="{{ asset('sb-admin/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="bg-dark">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header bg-success text-white text-center py-4">
                                    <h3 class="font-weight-light my-1">
                                        <i class="fas fa-seedling me-2"></i>AGROVALLE
                                    </h3>
                                    <small>Sistema Integral de Gestión - Honduras</small>
                                </div>
                                <div class="card-body p-4">
                                    <form action="{{ route('login.post') }}" method="POST">
                                        @csrf

                                        <!-- Correo Institucional -->
                                        <div class="form-floating mb-3">
                                            <input class="form-control @error('email') is-invalid @enderror" 
                                                   id="inputEmail" 
                                                   type="email" 
                                                   name="email" 
                                                   value="{{ old('email') }}" 
                                                   placeholder="usuario@agrovalle.hn" 
                                                   required autofocus />
                                            <label for="inputEmail">Correo Institucional (@agrovalle.hn)</label>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Contraseña -->
                                        <div class="form-floating mb-3">
                                            <input class="form-control @error('password') is-invalid @enderror" 
                                                   id="inputPassword" 
                                                   type="password" 
                                                   name="password" 
                                                   placeholder="Contraseña" 
                                                   required />
                                            <label for="inputPassword">Contraseña</label>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Recordar sesión -->
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" name="remember" />
                                            <label class="form-check-label" for="inputRememberPassword">Recordar mi sesión</label>
                                        </div>

                                        <div class="d-grid mt-4 mb-0">
                                            <button type="submit" class="btn btn-success btn-lg">
                                                <i class="fas fa-sign-in-alt me-2"></i>Ingresar al Sistema
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small text-muted">Acceso exclusivo personal autorizado</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Agrovalle Honduras 2026</div>
                        <div class="text-muted">Comayagua &bull; San Pedro Sula</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('sb-admin/js/scripts.js') }}"></script>
</body>
</html>