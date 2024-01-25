@extends('layouts.plantilla')
@section('title', 'Asesoras')
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
                            <h6 class="m-0 font-weight-bold text-gray-900">Asesoras</h6>
                        </div>
                        <div class="col-sm-6 text-right">
                            @role('admin')
                            <a href="{{route('asesoras.create')}}"><button type="bottom" class="btn btn-primary">+ Agregar Asesora</button></a>
                            @endrole
                        </div>
                    </div>
                </div>
                <div class="card-body bg-gray-100">
                    <div class="table-responsive">
                        <table class="table table-bordered text-gray-900" id="dataTable" data-order='[[ 1, "asc" ]]' width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>Nombre</th>
                                    <th>Iniciales</th>
                                    @role('admin')<th>Acción</th>@endrole
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($asesoras as $asesora)
                                <tr>
                                    <td>{{$asesora->nombre}}</td>
                                    <td class="text-center">{{$asesora->iniciales}}</td>
                                    @role('admin')
                                    <td>
                                        <a href="{{route('asesoras.edit', $asesora)}}">Editar</a>
                                        &nbsp;&nbsp;
                                        <a class="text-danger" href="{{route('asesoras.destroy', $asesora)}}">Eliminar</a>
                                    </td>
                                    @endrole
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