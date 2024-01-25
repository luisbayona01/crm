@extends('layouts.plantilla')
@section('content')
    <!-- Content Row 1 -->
    <div class="row">
        <!-- User name Card Example -->
        <div class="col-xl-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-gray-100">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="m-0 font-weight-bold text-gray-900">Publicaciones</h6>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{route('publicacions.create')}}"><button type="bottom" class="btn btn-primary">+ Crear Publicación</button></a>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-gray-100">
                    <div class="table-responsive">
                        <table class="table text-gray-900" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center cursor-pointer">
                                    <th>Fecha</th>
                                    <th>Usuario</th>
                                    <th>Descripción</th>
                                    <th class="d-none d-sm-table-cell">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($publicacions as $publicacion)
                                    <tr class="tr-etiquetas">
                                        <td>{{$publicacion->updated_at->format('d-m-y H:i')}}</td>
                                        <th>
                                            <a class="text-gray-900" href="{{route('usuarios.show', $publicacion->user)}}">
                                                {{ $publicacion->user ? $publicacion->user->name : '.' }}
                                            </a>
                                        </th>
                                        <td class="text-truncate" style="max-width:400px;">
                                            <a href="{{route('publicacions.show', $publicacion)}}" class="text-gray-900">
                                                {{$publicacion->descripcion}}
                                            </a>
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            <a href="{{route('publicacions.edit', $publicacion)}}">Editar</a>
                                            &nbsp;&nbsp;
                                            @role('admin')
                                                <a class="text-danger" href="{{route('publicacions.destroy', $publicacion)}}">Eliminar</a>
                                            @endrole
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- Jquey -->
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializa DataTables y desactiva la ordenación
            $('#dataTable').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection