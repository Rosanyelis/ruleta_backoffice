@extends('layouts.app')

@section('container')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Responsables</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Crear Responsables</h4>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ url('/responsables/'.$responsable->id.'/actualizar-responsable') }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('nombre') text-danger @enderror">
                                            Nombres
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ $responsable->persona->nombre }}" placeholder="Ejemplo: Andrea Josefina">
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
                                            <input type="text" name="apellido" class="form-control @error('apellido') is-invalid @enderror" value="{{ $responsable->persona->apellido }}" placeholder="Ejemplo: Doe Heinz">
                                            @if ($errors->has('apellido'))
                                                <small class="form-text text-danger">{{ $errors->first('apellido') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('rif') text-danger @enderror">
                                            Rif
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="rif" class="form-control @error('rif') is-invalid @enderror" value="{{ $responsable->rif }}" placeholder="Ejemplo: V123456789 / J123456789">
                                            @if ($errors->has('rif'))
                                                <small class="form-text text-danger">{{ $errors->first('rif') }}</small>
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
                                                <option value="Femenino" {{ $responsable->persona->sexo == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                                <option value="Masculino" {{ $responsable->persona->sexo == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                            </select>
                                            @if ($errors->has('sexo'))
                                                <small class="form-text text-danger">{{ $errors->first('sexo') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('direccion') text-danger @enderror">
                                            Dirección
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ $responsable->direccion }}" placeholder="Ejemplo: Venezuela, estado Sucre, ciudad de Carúpano, sector Centro, calle las Margaritas.">
                                            @if ($errors->has('direccion'))
                                                <small class="form-text text-danger">{{ $errors->first('direccion') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <input type="hidden" name="persona_id" value="{{ $responsable->persona_id }}">
                                </div>
                            </div>
                            <div class=" align-self-center float-right">
                                <a href="{{ url('responsables') }}" class="btn btn-light">Regresar</a>
                                <button type="submit" class="btn btn-secondary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- end row-->
    </div> <!-- container-fluid -->
@endsection
