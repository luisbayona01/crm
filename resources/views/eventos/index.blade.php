@extends('layouts.plantilla')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-gray-100">
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="m-0 font-weight-bold text-gray-900">Eventos</h6>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{route('eventos.create')}}"><button type="bottom" class="btn btn-primary">+ Crear Evento</button></a>
                    </div>
                </div>
            </div>
            <div class="card-body bg-gray-100">
                <div class="table-responsive">
                    <table class="table text-gray-900" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center cursor-pointer">
                                <th>Fecha</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th class="d-none d-sm-table-cell">Cantidad de Contactos</th>
                                @hasrole('afiliado|admin')
                                <th class="d-none d-sm-table-cell">Acción</th>
                                @endhasrole
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($eventos as $evento)
                                <tr class="tr-etiquetas">
                                    <td>
                                        {{ date('d/m/Y', strtotime($evento->fecha)) }}
                                    </td>
                                    <td>
                                        <a href="{{route('eventos.show', $evento)}}" class="text-gray-900">
                                            {{ $evento->nombre }}
                                        </a>
                                    </td>
                                    <th>{{ $evento->tipo }}</th>
                                    <td class="text-center d-none d-sm-table-cell">
                                        <a href="{{ route('contactos.index') }}?evento={{ $evento->id }}" class="text-gray-900">{{ $evento->num_contactos }} / ver contactos</a>
                                    </td>
                                    @hasrole('afiliado|admin')
                                    <td class="d-none d-sm-table-cell">
                                        <a href="{{route('eventos.edit', $evento)}}">Editar</a>
                                        <a class="text-danger" href="{{route('eventos.destroy', $evento)}}">Eliminar</a>
                                    </td>
                                    @endhasrole  
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination-contactos">
                    {{ $eventos->links() }}
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
            "pageLength": 10,
            "ordering": false
        });
    });
</script>
@endsection