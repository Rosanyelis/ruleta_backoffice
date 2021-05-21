@extends('layouts.app')
@section('container')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="#">Combinaciones</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar Combinación</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Editar Combinación</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <form class="form-horizontal" method="POST" action="{{ url('/combinaciones/'.$data->id.'/actualizar-combinacion') }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('nombre') text-danger @enderror">
                                            Nombre de Jugada
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ $data->nombre }}">
                                            @if ($errors->has('nombre'))
                                                <small class="form-text text-danger">{{ $errors->first('nombre') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('tipo') text-danger @enderror">
                                            Tipo de Jugada
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="tipo" class="form-control @error('tipo') is-invalid @enderror" value="{{ $data->tipo }}">
                                            @if ($errors->has('tipo'))
                                                <small class="form-text text-danger">{{ $errors->first('tipo') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                        @error('pago') text-danger @enderror">
                                            Paga
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="pago" class="form-control @error('pago') is-invalid @enderror" value="{{ $data->pago }}">
                                            @if ($errors->has('pago'))
                                                <small class="form-text text-danger">{{ $errors->first('pago') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" align-self-center float-right">
                                <a href="{{ url('combinaciones') }}" class="btn btn-light btn-rounded">Regresar</a>
                                <button type="submit" class="btn btn-secondary btn-rounded">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection