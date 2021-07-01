@extends('layouts.app')

@section('container')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Plantillas</li>
                        <li class="breadcrumb-item" aria-current="page">Plantilla de Ruletas</li>
                        <li class="breadcrumb-item" aria-current="page">Configuración de Ruletas</li>
                        <li class="breadcrumb-item active" aria-current="page">Editar Ruleta</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Editar Ruleta</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ url('/plantilla-de-ruletas/configurar-ruletas/'.$ruletas->id.'/actualizar-ruleta') }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('nombre') text-danger @enderror">
                                            Nombre de Ruleta
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ $ruletas->nombre }}" placeholder="Ejemplo: Ruleta de Animalitos">
                                            @if ($errors->has('nombre'))
                                                <small class="form-text text-danger">{{ $errors->first('nombre') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('url_imagen') text-danger @enderror">
                                            Imagen de Ruleta
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="file" name="url_imagen" class="form-control @error('url_imagen') is-invalid @enderror" value="{{ $ruletas->url_imagen }}">
                                            <img src="{{ $ruletas->url_imagen }}" class="img-fluid rounded mt-4" alt="Ruleta">
                                            {{-- <span class="help-block"><small>La imagen debe tener un tamaño de 600x600px.</small></span> --}}
                                            @if ($errors->has('url_imagen'))
                                                <small class="form-text text-danger">{{ $errors->first('url_imagen') }}</small>
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
