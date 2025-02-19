@extends('layouts.app')

@section('header-gestion')
<div class="container-fluid">
    <div class="topnav">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/home">
                        <i class="uil-home-alt me-2"></i> Inicio </a>
                    </li>
                    <li class="nav-item dropdown">
                        @can('vista-administrador')
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement" role="button">
                            <i class="uil-flask me-2"></i> Super Usuario <div class="arrow-down"></div>
                        </a>
                        @endcan

                        <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl"
                            aria-labelledby="topnav-uielement">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="text-left">
                                        <a href="/perfil/edit" class="dropdown-item">Perfil</a>
                                        <a href="/administrador" class="dropdown-item">Panel del Administrador</a>
                                        <a href="/roles" class="dropdown-item">Etiquetas</a>
                                        <a href="/users" class="dropdown-item">Usuarios</a>
                                        <a href="/gestionempresa" class="dropdown-item">Gestion de Empresas</a>
                                        <a href="/gestionsucursal" class="dropdown-item">Gestion de Sucursales</a>
                                        <a href="/gestionempleados" class="dropdown-item">Gestion de Empleados</a>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <a href="ui-lightbox" class="dropdown-item">Lightbox</a>
                                        <a href="ui-modals" class="dropdown-item">Modals</a>
                                        <a href="ui-rangeslider" class="dropdown-item">Range Slider</a>
                                        <a href="ui-session-timeout" class="dropdown-item">Session Timeout</a>
                                        <a href="ui-progressbars" class="dropdown-item">Progress Bars</a>
                                        <a href="ui-sweet-alert" class="dropdown-item">Sweet-Alert</a>
                                        <a href="ui-tabs-accordions" class="dropdown-item">Tabs & Accordions</a>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <a href="ui-typography" class="dropdown-item">Typography</a>
                                        <a href="ui-video" class="dropdown-item">Video</a>
                                        <a href="/estados" class="dropdown-item">Estados</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/perfil/edit">
                        <i class="uil-user-circle me-2"></i> Personalizar Perfil </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
@stop

@section('content')

<div class="container">
    <!-- end page title -->
    <div class="row mb-4">
        <div class="col-xl-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-center">
                        <div class="clearfix"></div>
                        <div>
                            <img src="../uploads/avatars/{{ auth()->user()->avatar }}" class="avatar-lg rounded-circle img-thumbnail">
                        </div>
                        <h5 class="mt-3 mb-1">{{ Auth::user()->name }}</h5>
                    </div>
                    <hr class="my-4">
                    <div class="text-muted">
                        <div class="table-responsive mt-4">
                            <div>
                                <p class="mb-1">Nombre :</p>
                                <h5 class="font-size-16">{{ Auth::user()->name }} {{ Auth::user()->apellido }}<h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Puesto :</p>
                                <h5 class="font-size-16">{{ Auth::user()->puesto_actual_id }}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">E-mail :</p>
                                <h5 class="font-size-16">{{ Auth::user()->email }}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Estado :</p>
                                <h5 class="font-size-16">

                                @if (Auth::user()->estatus == 0)
                                <span class="badge bg-danger rounded-pill"> Necesita Ayuda </span>
                                @elseif(Auth::user()->estatus == 1)
                                <span class="badge bg-warning rounded-pill"> Pendiente </span>
                                @elseif(Auth::user()->estatus == 2)
                                <span class="badge bg-info rounded-pill"> Evaluado </span>
                                @endif

                                </h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Sucursal :</p>
                                <h5 class="font-size-16">{{ Auth::user()->sucursal_id }}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Empresa :</p>
                                <h5 class="font-size-16">{{ Auth::user()->empresa_id }}</h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card mb-0">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#personalizar" role="tab">
                            <i class="uil uil-user-circle font-size-20"></i>
                            <span class="d-none d-sm-block">Personalizar</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#seguridad" role="tab">
                            <i class="uil uil-clipboard-notes font-size-20"></i>
                            <span class="d-none d-sm-block">Seguridad</span>
                        </a>
                    </li>
                </ul>
                <!-- tap panel -->
                <div class="tab-content p-4">
                    <div class="tab-pane active" id="personalizar" role="tabpanel">
                        <div>
                            <div>
                                <h5 class="font-size-16 mb-4">Perfil</h5>

                                <div class="text-center">
                                    <form enctype="multipart/form-data" action="./edit" method="POST">
                                        <img src="../uploads/avatars/{{ auth()->user()->avatar }}" width="200" height="200" class="rounded-circle"><br><br>
                                        <input type="file" name="avatar">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="pull-right btn btn-primary">Guardar foto</button>
                                    </form>
                                </div>
                                <br>
                                <form method="post" action="{{ route('perfil.update') }}" autocomplete="off">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col {{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('Nombre de la Persona*') }}</label>
                                            <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required autofocus>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col{{ $errors->has('apellido') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-apellido">{{ __('Apellido*') }}</label>
                                            <input type="text" name="apellido" id="input-apellido" class="form-control form-control-alternative{{ $errors->has('apellido') ? ' is-invalid' : '' }}" placeholder="{{ __('Apellido') }}" value="{{ old('apellido', auth()->user()->apellido) }}" required >
                                            @if ($errors->has('apellido'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('apellido') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-email">{{ __('Correo Electronico*') }}</label>
                                            <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required>
                                             @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div><br>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary"">{{ __('Guardar') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="seguridad" role="tabpanel">
                        <div>
                            <h5 class="font-size-16 mb-3">Cambio de Contraseña</h5>

                            <form method="post" action="{{ route('perfil.password') }}" autocomplete="off">
                                @csrf
                                @method('put')
                                @if (session('password_status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('password_status') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-current-password">{{ __('Antigua Contraseña:') }}</label>
                                        <input type="password" name="old_password" id="input-current-password" class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('*****') }}" value="" required>
                                        @if ($errors->has('old_password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('old_password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col{{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-password">{{ __('Nueva Contraseña:') }}</label>
                                        <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('*****') }}" value="" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-password-confirmation">{{ __('Confirmar Nueva Contraseña:') }}</label>
                                        <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('*****') }}" value="" required>
                                    </div>
                                </div><br>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">{{ __('Cambiar Contraseña') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- end row -->
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
