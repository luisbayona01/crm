@extends('layouts.plantilla')
@section('title', 'Etiquetas')
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
                            <h6 class="m-0 font-weight-bold text-gray-900">Etiquetas</h6>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{route('etiquetas.create')}}"><button type="bottom" class="btn btn-primary">+ Crear etiqueta</button></a>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-gray-100">
                    <div class="table-responsive">
                        <table class="table table-bordered text-gray-900" id="dataTable" data-order='[[ 0, "asc" ]]' width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>Nombre</th>
                                    <th>Cantidad de Contactos</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($etiquetas as $etiqueta)
                                <tr>
                                    <td><a href="{{ route('home') }}?etiqueta={{ $etiqueta->id }}" class="text-gray-900">{{$etiqueta->nombre}}</a></td>
                                    <td class="text-center">
                                        {{ $etiqueta->num_contactos }}
                                    </td>
                                    <td>
                                        <a href="{{route('etiquetas.edit', $etiqueta)}}">Editar</a>
                                        &nbsp;&nbsp;
                                        <a class="text-danger" href="{{route('etiquetas.destroy', $etiqueta)}}">Eliminar</a>
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

@endsection