@extends('layouts.app')
@push('styles')
    <link href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('container')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cliente</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Perfil de Cliente</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @include('layouts.alert')
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4">Datos de Responsable</h5>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Nombres: {{ $responsable->persona->nombre }}</label> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Apellidos: {{ $responsable->persona->apellido }}</label> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>RIF: {{ $responsable->rif }}</label> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Sexo: {{ $responsable->persona->sexo }}</label> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Dirección: {{ $responsable->direccion }}</label> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4">Datos Personales</h5>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Nombres: </label> {{ $cliente->nombre }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Apellidos: </label> {{ $cliente->apellido }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Sexo: </label> {{ $cliente->sexo }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Sector: </label> {{ $cliente->sector }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Dirección: </label> {{ $cliente->direccion }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body"> 
                        <div class="row justify-content-between mb-3">
                            <div class="col-4">
                                <h5>Datos de Usuario</h5>
                            </div>
                            <div class="col-3">
                                <div class="text-right">
                                    @if (!$usuario)
                                    <a href="{{ url('/clientes/'.$id.'/asignar-usuario-a-cliente') }}" class="btn btn-secondary"><i class="uil uil-plus"></i> Asignar Usuario</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Usuario: </label> @if ($usuario) {{ $usuario->nombre }} @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Correo Electrónico: </label> @if ($usuario) {{ $usuario->email }} @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Rol de Usuario: </label> @if ($usuario) {{ $usuario->rol }} @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between mb-3">
                            <div class="col-4">
                                <h5>Taquillas</h5>
                            </div>
                            <div class="col-3">
                                <div class="text-right">
                                    <a href="{{ url('/clientes/'.$id.'/crear-taquilla') }}" class="btn btn-secondary"><i class="uil uil-plus"></i> Crear Taquilla</a>
                                </div>
                            </div>
                        </div>
                        <table id="basic-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th width="20px" >#</th>
                                    <th>Nombre y Apellido</th>
                                    <th>Teléfono</th>
                                    <th>Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($taquilleros as $resp)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $resp->nombre }} {{ $resp->apellido }}</td>
                                    <td>{{ $resp->telefono }}</td>
                                    <td>
                                        @if ($resp->estatus == true)
                                            <span class="badge badge-info">Activo</span>
                                        @else
                                            <span class="badge badge-danger">Inactivo</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>

            
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->

</div> <!-- content -->
@endsection
@push('scripts')
    <!-- datatable js -->
    <script src="{{ asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script >
        $(document).ready(function() {
        $("#basic-datatable").DataTable({
            language:{
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
                paginate:{
                    previous:"<i class='uil uil-angle-left'>",
                    next:"<i class='uil uil-angle-right'>"
                },
                drawCallback:function(){
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
                }
            }
        });
    });
    </script>
@endpush