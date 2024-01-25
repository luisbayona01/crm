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
                            <h6 class="m-0 font-weight-bold text-gray-900">Grupos de Facebook</h6>
                        </div>
                        <div class="col-sm-6 text-right">
                            @role('admin')
                            <a href="{{route('gruposfacebook.create')}}"><button type="bottom" class="btn btn-primary">+ Agregar grupo</button></a>
                            @endrole
                        </div>
                    </div>
                </div>
                <div class="card-body bg-gray-100">
                    <div class="table-responsive">
                        <table class="table table-bordered text-gray-900" id="dataTable" data-order='[[ 0, "desc" ]]' width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>País</th>
                                    <th>Link</th>
                                    @role('admin')<th>Acción</th>@endrole
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($gruposfacebooks as $gruposfacebook)
                                <tr>
                                    <td>
                                        <a href="{{route('gruposfacebook.show', $gruposfacebook)}}" class="text-gray-900">
                                            {{$gruposfacebook->pais}}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{$gruposfacebook->urlgrupo}}" target="_bank" class="text-gray-900">
                                            {{$gruposfacebook->urlgrupo}}
                                        </a>
                                    </td>
                                    @role('admin')
                                    <td>
                                        <a href="{{route('gruposfacebook.edit', $gruposfacebook)}}">Editar</a>
                                        &nbsp;&nbsp;
                                        <a class="text-danger" href="{{route('gruposfacebook.destroy', $gruposfacebook)}}">Eliminar</a>
                                        
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