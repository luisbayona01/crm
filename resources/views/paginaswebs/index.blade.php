@extends('layouts.plantilla')
@section('content')
<div class="row">
    <div class="col-xl-12">    
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-gray-100">
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="m-0 font-weight-bold text-gray-900">Páginas web</h6>
                    </div>
                    <div class="col-sm-6 text-right">
                        @role('admin')
                        <a href="{{route('paginaswebs.create')}}"><button type="bottom" class="btn btn-primary">+ Agregar página</button></a>
                        @endrole
                    </div>
                </div>
            </div>
            <div class="card-body bg-gray-100">
                <div class="table-responsive">
                    <table class="table table-bordered text-gray-900" id="dataTable" data-order='[[ 0, "desc" ]]' width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>Usuario</th>
                                <th>Título</th>
                                <th>Actualización</th>
                                @role('admin')<th>Acción</th>@endrole
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($paginaswebs as $paginaweb)
                            <tr>
                                <td>
                                    <a class="text-gray-900" href="{{route('usuarios.show', $paginaweb->user)}}">
                                        <img src="{{asset(str_replace('public', 'storage', $paginaweb->user ? $paginaweb->user->urlfotoperfil : '.' ))}}" width="25" height="25" class="rounded-circle">
                                        &nbsp;
                                        {{$paginaweb->user->name}}
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a class="text-gray-900" href="{{route('paginaswebs.show', $paginaweb)}}">
                                        {{$paginaweb->titulo}}
                                    </a>
                                </td>
                                <td class="text-truncate d-none d-sm-table-cell" style="max-width:2px;">
                                    {{$paginaweb->updated_at->format('d-m-y H:i')}}
                                </td>
                                @hasrole('afiliado|admin')
                                <td><a href="{{route('paginaswebs.edit', $paginaweb)}}">Editar</a></td>
                                @endhasrole
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