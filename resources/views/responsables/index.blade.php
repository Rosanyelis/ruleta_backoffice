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
                <h4 class="mb-1 mt-0">Listado de Responsables</h4>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                @include('layouts.alert')
                <div class="card">
                    <div class="card-body">
                        <div class="text-right mb-4">
                            <a href="{{ url('/responsables/nuevo-responsable') }}" class="btn btn-secondary"><i class="uil uil-plus"></i> Nuevo Responsable</a>
                        </div>
                        <example-component></example-component>
                        <table id="basic-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th width="20px" >#</th>
                                    <th>Nombre</th>
                                    <th>Rif</th>
                                    <th>Estatus</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($responsables as $resp)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $resp->nombre }} {{ $resp->apellido }}</td>
                                    <td>{{ $resp->rif }}</td>
                                    <td>
                                        @if ($resp->estatus == 1)
                                            <span class="badge badge-info">Activo</span>
                                        @else
                                            <span class="badge badge-danger">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/responsables/'.$resp->id.'/ver-perfil') }}">
                                            <i class="uil uil-eye text-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver perfil"></i>
                                        </a>
                                        &nbsp;&nbsp;
                                        <a href="{{ url('/responsables/'.$resp->id.'/editar') }}">
                                            <i class="uil uil-edit-alt" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar "></i>
                                        </a>
                                        &nbsp;&nbsp;
                                        <a href="javascript: void(0);" data-toggle="modal" data-target="#modal-error{{ $resp->id }}">
                                            <i class="uil uil-user-minus text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Desactivar"></i>
                                        </a>
                                    </td>
                                </tr>
                                {{-- Modal eliminar responsable --}}
                                <div class="modal fade" id="modal-error{{ $resp->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-errorLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-errorLabel">Error</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center" >
                                                <i class="uil-exclamation-triangle text-danger display-3"></i>
                                                <h4 class="text-danger mt-4">¿Está realmente seguro de completar ésta acción?</h4>
                                                <p>Tenga en cuenta que al realizar ésta acción, el usuario asignado al registro, será automaticamente desactivado, incluido todos los registros dependientes del mismo como: clientes, taquillas o cajas, no podrán acceder nuevamente al sistema ni a sus características.</p>
                                                <div class="mt-4">
                                                    <a href="#" class="btn btn-outline-primary width-md mr-3"  data-dismiss="modal"> Cancelar</a>
                                                    <a href="#" class="btn btn-secondary width-md"> Si, eliminar</a>
                                                </div>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
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