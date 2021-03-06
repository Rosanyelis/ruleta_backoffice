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
                        <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Listado de Usuarios</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @include('layouts.alert')
                <div class="card">
                    <div class="card-body">
                        {{-- <div class="text-right mb-4">
                            <a href="{{ url('/usuarios/nuevo-usuario') }}" class="btn btn-secondary"><i class="uil uil-plus pt-4"></i> Nuevo Usuario</a>
                        </div> --}}
                        <table id="basic-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th width="20px" >#</th>
                                    <th>Usuario</th>
                                    <th>Correo</th>
                                    <th>Rol</th>
                                    <th>Estatus</th>
                                    <th width="20px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->nombre }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->rol == 'Administrador')
                                        <span class="badge badge-info">Administrador</span>
                                        @elseif ($user->rol == 'Cliente')
                                        <span class="badge badge-warning">Cliente</span>
                                        @elseif ($user->rol == 'Taquillero')
                                        <span class="badge badge-danger">Taquillero</span>
                                        @elseif ($user->rol == 'Responsable')
                                        <span class="badge badge-success">Responsable</span>
                                        @elseif ($user->rol == 'Desarrollador')
                                        <span class="badge badge-primary">Desarrollador</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->estatus == true)
                                            <span class="badge badge-info">Activo</span>
                                        @else
                                            <span class="badge badge-danger">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/usuarios/'.$user->id.'/editar-usuario') }}"><i class="uil uil-edit-alt"></i></a>
                                        <a href=""><i class="uil uil-trash text-danger"></i></a>
                                        {{-- <a href=""><i class="uil uil-edit-alt"></i></a> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->
    </div> <!-- container-fluid -->
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