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
                        <li class="breadcrumb-item active" aria-current="page">Ver Ruleta</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Ver Ruleta</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">
                                            Nombre de Ruleta
                                        </label>
                                        <div class="col-lg-9">
                                            {{ $ruletas->nombre }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">
                                            Imagen de Ruleta
                                        </label>
                                        <div class="col-lg-9">
                                            <img src="{{ $ruletas->url_imagen }}" class="img-fluid rounded" alt="Ruleta">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" align-self-center float-right">
                                <a href="{{ url('/plantilla-de-ruletas/configurar-ruletas') }}" class="btn btn-light">Regresar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- end row-->
    </div> <!-- container-fluid -->
@endsection
