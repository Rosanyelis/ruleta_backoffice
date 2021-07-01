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
                        <li class="breadcrumb-item" aria-current="page">Plantillas</li>
                        <li class="breadcrumb-item" aria-current="page">Plantilla de Jugadas</li>
                        <li class="breadcrumb-item active" aria-current="page">Configuración de Jugadas</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Listado de Jugadas</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @include('layouts.alert')
                <div class="card">
                    <div class="card-body">
                        <div class="text-right mb-4">
                            <a href="{{ url('/plantilla-de-jugadas') }}" class="btn btn-light mr-2"><i class="uil uil-corner-up-left pt-4"></i> Regresar</a>
                            <a href="{{ url('/plantilla-de-jugadas/configurar-jugadas/nueva-jugada') }}" class="btn btn-secondary mr-2"><i class="uil uil-plus pt-4"></i> Nueva Jugada</a>
                        </div>
                        <table id="basic-datatable" class="table dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th width="20px" >#</th>
                                    <th>Nombre</th>
                                    <th width="20px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jugadas as $ju)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ju->nombre }}</td>
                                    <td>
                                        <a href="{{ url('/plantilla-de-jugadas/configurar-jugadas/'.$ju->id.'/ver-jugada') }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver Jugada"><i class="uil uil-eye"></i></a>

                                        <a href="{{ url('/plantilla-de-jugadas/configurar-jugadas/'.$ju->id.'/editar-jugada') }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar Jugada"><i class="uil uil-edit-alt"></i></a>
                                         
                                        <a href="javascript: void(0);" data-toggle="modal" data-target="#modal-error{{ $ju->id }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar Jugada"><i class="uil uil-trash text-danger"></i></a>
                                    </td>
                                </tr>
                                {{-- Modal eliminar jugada --}}
                                <div class="modal fade" id="modal-error{{ $ju->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-errorLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                {{-- <h5 class="modal-title" id="modal-errorLabel"></h5> --}}
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center" >
                                                <form method="POST" action="{{ url('/plantilla-de-jugadas/configurar-jugadas/'.$ju->id.'/eliminar-jugada') }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <i class="uil-exclamation-triangle text-danger display-3"></i>
                                                    <h4 class="text-danger mt-4">¿Está seguro de completar eliminar el registro?</h4>
                                                    {{-- <p>.</p> --}}
                                                    <div class="mt-4">
                                                        <button type="button" class="btn btn-outline-primary width-md mr-3"  data-dismiss="modal"> Cancelar</button>
                                                        <button type="submit" class="btn btn-secondary width-md"> Si, eliminar</button>
                                                    </div>
                                                </form>
                                                
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body -->
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