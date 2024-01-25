@extends('layouts.plantilla')
@section('content')
<div class="row">
    <!-- User name Card Example -->
    <div class="col-xl-12">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-gray-100">
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="m-0 font-weight-bold text-gray-900">Versiones</h6>
                    </div>
                    <div class="col-sm-6 text-right">
                        @role('admin')
                        <a href="{{route('versions.create')}}"><button type="bottom" class="btn btn-primary">+ Agregar versión</button></a>
                        @endrole
                    </div>
                </div>
            </div>
            <div class="card-body bg-gray-100">
                <div class="table-responsive">
                    <table class="table table-bordered text-gray-900" id="dataTable" data-order='[[ 0, "desc" ]]' width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>Versión</th>
                                <th>Comentario</th>
                                <th>Actualización</th>
                                @role('admin')<th>Acción</th>@endrole
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($versions as $version)
                            <tr>
                                <td>
                                    <a href="{{route('versions.destroy', $version)}}" class="text-gray-900">{{$version->version}}</a>
                                </td>
                                <td class="text-center">{{$version->comentario}}</td>
                                <td class="text-truncate d-none d-sm-table-cell" style="max-width:2px;">{{$version->updated_at->format('d-m-y H:i')}}</td>
                                @role('admin')
                                <td>
                                    <a href="{{route('versions.edit', $version)}}">Editar</a>
                                    &nbsp;&nbsp;
                                    <a class="text-danger" href="{{route('versions.destroy', $version)}}">Eliminar</a>
                                    
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
<br>
@endsection