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
                        <li class="breadcrumb-item active" aria-current="page">Responsables</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Perfil de Responsables</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @include('layouts.alert')
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4">Datos Personales</h5>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Nombres: </label> {{ $responsable->nombre }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Apellidos: </label> {{ $responsable->apellido }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>RIF: </label> {{ $responsable->rif }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Sexo: </label> {{ $responsable->sexo }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Dirección: </label> {{ $responsable->direccion }}
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
                                    <a href="{{ url('/responsables/'.$id.'/asignar-usuario-a-responsable') }}" class="btn btn-secondary"><i class="uil uil-plus"></i> Asignar Usuario</a>
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
                                <h5>Clientes</h5>
                            </div>
                            <div class="col-3">
                                <div class="text-right">
                                    <a href="{{ url('/clientes/'.$id.'/crear-taquilla') }}" class="btn btn-secondary"><i class="uil uil-plus"></i> Nuevo Cliente</a>
                                </div>
                            </div>
                        </div>
                        <table id="basic-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th width="20px" >#</th>
                                    <th>Nombre y Apellido</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $resp)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $resp->nombre }} {{ $resp->apellido }}</td>
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
    <script src="{{ asset('assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
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