@extends('layouts.app')

@section('container')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Configuración</li>
                        <li class="breadcrumb-item" aria-current="page">Usuarios</li>
                        <li class="breadcrumb-item active" aria-current="page">Crear Usuario</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Crear Usuario</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('nombre') text-danger @enderror">
                                            Nombre de Usuario
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" placeholder="Ejemplo: UserResponsable">
                                            @if ($errors->has('nombre'))
                                                <small class="form-text text-danger">{{ $errors->first('nombre') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('password') text-danger @enderror">
                                            Rol
                                        </label>
                                        <div class="col-lg-9">
                                            <select name="rol" class="form-control @error('rol') is-invalid @enderror">
                                                <option >Seleccione el rol</option>
                                                <option value="Administrador" {{ old('rol') == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                                                <option value="Gerente" {{ old('rol') == 'Gerente' ? 'selected' : '' }}>Gerente</option>
                                                <option value="Responsable" {{ old('rol') == 'Responsable' ? 'selected' : '' }}>Responsable</option>
                                                <option value="Cliente" {{ old('rol') == 'Cliente' ? 'selected' : '' }}>Cliente</option>
                                                <option value="Taquilla" {{ old('rol') == 'Taquilla' ? 'selected' : '' }}>Taquilla</option>
                                            </select>
                                            @if ($errors->has('rol'))
                                                <small class="form-text text-danger">{{ $errors->first('rol') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('email') text-danger @enderror">
                                            Correo Electrónico
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Ejemplo: example@example.com">
                                            @if ($errors->has('email'))
                                                <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('password') text-danger @enderror">
                                            Contraseña
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="********">
                                            @if ($errors->has('password'))
                                                <small class="form-text text-danger">{{ $errors->first('password') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" align-self-center float-right">
                                <a href="{{ url('/plantilla-de-ruletas/configurar-ruletas') }}" class="btn btn-light">Regresar</a>
                                <button type="submit" class="btn btn-secondary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- end row-->
    </div> <!-- container-fluid -->
@endsection
