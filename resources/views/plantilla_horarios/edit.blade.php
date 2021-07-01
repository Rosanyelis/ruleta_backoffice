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
                        <li class="breadcrumb-item" aria-current="page">Plantillas</li>
                        <li class="breadcrumb-item" aria-current="page">Plantilla de Horarios</li>
                        <li class="breadcrumb-item active" aria-current="page">Editar Plantilla de Horarios</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Editar Plantilla de Horarios</h4>
            </div>
        </div>
       
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ url('/plantilla-de-horarios/'.$plantilla->id.'/actualizar-plantilla-de-horarios') }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('nombre') text-danger @enderror">
                                            Nombre de Plantilla
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ $plantilla->nombre }}" placeholder="Ejemplo: Plantilla de Jugadas de Ruleta">
                                            @if ($errors->has('nombre'))
                                                <small class="form-text text-danger">{{ $errors->first('nombre') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">
                                            Horas
                                        </label>
                                        <div class="col-lg-9">
                                            {!! Form::select('hora[]', $data['horas'], $data['plantilla_horario_hora'], 
                                                $errors->has('hora') ?
                                                    ['id' => 'hora', 'class' => 'form-control wide is-invalid', 'data-plugin' => 'customselect', 'multiple'=>'multiple']:
                                                    ['id' => 'hora', 'class' => 'form-control wide', 'data-plugin' => 'customselect', 'multiple'=>'multiple']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" align-self-center float-right">
                                <a href="{{ url('/plantilla-de-jugadas') }}" class="btn btn-light">Regresar</a>
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