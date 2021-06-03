@extends('layouts.app')

@section('container')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="#">Clientes</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Taquillas</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Crear Taquilla</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ url('/clientes/'.$id.'/guardar-taquilla') }}">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('nombre') text-danger @enderror">
                                            Nombres
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" placeholder="Ejemplo: Andrea Josefina">
                                            @if ($errors->has('nombre'))
                                                <small class="form-text text-danger">{{ $errors->first('nombre') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('apellido') text-danger @enderror">
                                            Apellidos
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="apellido" class="form-control @error('apellido') is-invalid @enderror" value="{{ old('apellido') }}" placeholder="Ejemplo: Doe Heinz">
                                            @if ($errors->has('apellido'))
                                                <small class="form-text text-danger">{{ $errors->first('apellido') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('sexo') text-danger @enderror">
                                            Sexo
                                        </label>
                                        <div class="col-lg-9">
                                            <select name="sexo" class="form-control @error('sexo') is-invalid @enderror">
                                                <option >Seleccione el sexo</option>
                                                <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                                <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                            </select>
                                            @if ($errors->has('sexo'))
                                                <small class="form-text text-danger">{{ $errors->first('sexo') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('codigo') text-danger @enderror">
                                            Código de Taquilla
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="codigo" class="form-control @error('codigo') is-invalid @enderror" value="{{ old('codigo') }}" placeholder="Ejemplo: JonTaq-001">
                                            @if ($errors->has('codigo'))
                                                <small class="form-text text-danger">{{ $errors->first('codigo') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('direccion') text-danger @enderror">
                                            Dirección
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion') }}" placeholder="Ejemplo: Venezuela, estado Sucre, ciudad de Carúpano, sector Centro, calle las Margaritas.">
                                            @if ($errors->has('direccion'))
                                                <small class="form-text text-danger">{{ $errors->first('direccion') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('telefono') text-danger @enderror">
                                            Teléfono
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}" placeholder="Ejemplo: 04141234567">
                                            @if ($errors->has('telefono'))
                                                <small class="form-text text-danger">{{ $errors->first('telefono') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" align-self-center float-right">
                                <a href="{{ url('clientes') }}" class="btn btn-light">Regresar</a>
                                <button type="submit" class="btn btn-secondary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- end row-->
    </div> <!-- container-fluid -->
@endsection
