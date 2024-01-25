@extends('layouts.plantilla')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-gray-100">
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="m-0 font-weight-bold text-gray-900">Etiquetas</h6>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{route('contactos.index')}}"><button type="bottom" class="btn btn-primary">Todos los contactos</button></a>
                        &nbsp;
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
                                <th class="d-none d-sm-table-cell">Cantidad de Contactos</th>
                                <th class="d-none d-sm-table-cell">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($etiquetas as $etiqueta)
                                <tr class="tr-etiquetas">
                                    <td>
                                        <button type="button" class="btn btn-link text-left text-gray-900" data-toggle="collapse" data-target="#subetiqueta-{{$etiqueta->id}}" aria-expanded="false" aria-controls="subetiqueta-{{$etiqueta->id}}">{{$etiqueta->nombre}}</button>
                                    </td>
                                    <td class="text-center d-none d-sm-table-cell">
                                        <a href="{{ route('contactos.index') }}?etiqueta={{ $etiqueta->id }}" class="text-gray-900">{{ $etiqueta->num_contactos }} / ver contactos</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        <a href="{{route('etiquetas.edit', $etiqueta)}}">Editar</a>
                                        &nbsp;&nbsp;
                                        <a class="text-danger" href="{{route('etiquetas.destroy', $etiqueta)}}">Eliminar</a>
                                    </td>
                                </tr>
                                {{-- SUB ETIQUETAS --}}
                                <tr class="collapse" id="subetiqueta-{{$etiqueta->id}}">
                                    <td style="padding: 0px;line-height: 0;">
                                        <table class="table text-gray-900 table-borderless" style="margin-bottom: 0rem;">
                                            <thead>
                                                @foreach($subetiquetas->where('etiqueta_id', $etiqueta->id)->sortBy('nombre') as $subetiqueta)
                                                <tr>
                                                    <th class="text-gray-900">
                                                        <a href="{{ route('contactos.index') }}?subetiqueta={{ $subetiqueta->id }}" class="text-gray-900">
                                                            {{$subetiqueta->nombre}}
                                                        </a>
                                                    </th>
                                                    <th class="text-gray-900">
                                                        <a href="{{ route('contactos.index') }}?subetiqueta={{ $subetiqueta->id }}" class="text-gray-900">{{ $subetiqueta->contactos->count() }} / ver</a>
                                                    </th>
                                                    <th class="d-none d-sm-table-cell">
                                                        <a href="{{route('subetiquetas.edit', $subetiqueta)}}" class="text-gray-900">Editar</a>
                                                        &nbsp;&nbsp;
                                                    </th>
                                                </tr>
                                                @endforeach
                                            </thead>
                                        </table>
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