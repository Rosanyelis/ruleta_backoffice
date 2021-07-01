@extends('layouts.app')
@push('styles')
    <link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/multiselect/multi-select.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('container')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Responsables</li>
                        <li class="breadcrumb-item active" aria-current="page">Asignar Plantillas a Responsable</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Asignar Plantillas a Responsable</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ url('/responsables/'.$id.'/plantilla-responsables/guardar-plantillas') }}">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('nombre') text-danger @enderror">
                                            Nombre de Plantilla Asignada
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" placeholder="Ejemplo: Plantilla Responsable - Ruleta Americana">
                                            @if ($errors->has('nombre'))
                                                <small class="form-text text-danger">{{ $errors->first('nombre') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('plantilla_ruleta') text-danger @enderror">
                                            Plantilla de Ruletas
                                        </label>
                                        <div class="col-lg-9">
                                            {!! Form::select('plantilla_ruleta', $data['plantilla_ruletas'], old('plantilla_ruleta'), 
                                                $errors->has('plantilla_ruleta') ?
                                                    ['id' => 'plantilla_ruleta', 'class' => 'form-control wide is-invalid', 'data-plugin' => 'customselect', 'data-placeholder'=>'Seleccione una Plantilla de Ruleta']:
                                                    ['id' => 'plantilla_ruleta', 'class' => 'form-control wide', 'data-plugin' => 'customselect', 'data-placeholder'=>'Seleccione una Plantilla de Ruleta']) !!}
                                            @if ($errors->has('plantilla_ruleta'))
                                                <small class="form-text text-danger">{{ $errors->first('plantilla_ruleta') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('plantilla_jugadas') text-danger @enderror">
                                            Plantilla de Jugadas
                                        </label>
                                        <div class="col-lg-9">
                                            {!! Form::select('plantilla_jugadas', $data['plantilla_jugadas'], old('plantilla_jugadas'), 
                                                $errors->has('plantilla_jugadas') ?
                                                    ['id' => 'plantilla_jugadas', 'class' => 'form-control wide is-invalid', 'data-plugin' => 'customselect', 'data-placeholder'=>'Seleccione una Plantilla de Jugada']:
                                                    ['id' => 'plantilla_jugadas', 'class' => 'form-control wide', 'data-plugin' => 'customselect', 'data-placeholder'=>'Seleccione una Plantilla de Jugada']) !!}
                                            @if ($errors->has('plantilla_jugadas'))
                                                <small class="form-text text-danger">{{ $errors->first('plantilla_jugadas') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('plantilla_horarios') text-danger @enderror">
                                            Plantilla de Horarios
                                        </label>
                                        <div class="col-lg-9">
                                            {!! Form::select('plantilla_horarios', $data['plantilla_horarios'], old('plantilla_horarios'), 
                                                $errors->has('plantilla_horarios') ?
                                                    ['id' => 'plantilla_horarios', 'class' => 'form-control wide is-invalid', 'data-plugin' => 'customselect', 'data-placeholder'=>'Seleccione una Plantilla de Horario']:
                                                    ['id' => 'plantilla_horarios', 'class' => 'form-control wide', 'data-plugin' => 'customselect', 'data-placeholder'=>'Seleccione una Plantilla de Horario']) !!}
                                            @if ($errors->has('plantilla_horarios'))
                                                <small class="form-text text-danger">{{ $errors->first('plantilla_horarios') }}</small>
                                            @endif
                                        </div>
                                    </div>
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
@push('scripts')
    <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/multiselect/jquery.multi-select.js') }}"></script>
    <script>
        ! function(o) {
            "use strict";
            function t() {}

            t.prototype.initCustomSelect = function() {
                o('[data-plugin="customselect"]').select2()
            }, t.prototype.initMultiSelect = function() {
                0 < o('[data-plugin="multiselect"]').length && o('[data-plugin="multiselect"]').multiSelect(o(this).data())
            }, t.prototype.init = function() {
                this.initCustomSelect(), this.initMultiSelect()
            }, o.Components = new t, o.Components.Constructor = t
        }(window.jQuery),
        function() {
            "use strict";
            window.jQuery.Components.init()
        }();
    </script>
@endpush