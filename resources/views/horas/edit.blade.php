@extends('layouts.app')
@push('styles')
    <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
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
                        <li class="breadcrumb-item" aria-current="page">Configuración de Horas</li>
                        <li class="breadcrumb-item active" aria-current="page">Editar Hora</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Editar Hora</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ url('/plantilla-de-horarios/configurar-horas/'.$horas->id.'/actualizar-hora') }}" >
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label 
                                            @error('hora') text-danger @enderror">
                                            Hora
                                        </label>
                                        <div class="col-lg-9">
                                            <input id="basic-timepicker" type="text" name="hora" class="form-control @error('hora') is-invalid @enderror" value="{{ $horas->hora }}" placeholder="Ejemplo: 14:30:00">
                                            @if ($errors->has('hora'))
                                                <small class="form-text text-danger">{{ $errors->first('hora') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" align-self-center float-right">
                                <a href="{{ url('/plantilla-de-horarios/configurar-horas') }}" class="btn btn-light">Regresar</a>
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
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script>
        ! function(o) {
            "use strict";

            function t() {}
            t.prototype.initFlatpickr = function() {
                o("#basic-timepicker").flatpickr({
                    enableTime: !0,
                    noCalendar: !0,
                    dateFormat: "H:i"
                })
            }, t.prototype.init = function() {
                this.initFlatpickr()
            }, o.Components = new t, o.Components.Constructor = t
        }(window.jQuery),
        function() {
            "use strict";
            window.jQuery.Components.init()
        }();
    </script>
@endpush