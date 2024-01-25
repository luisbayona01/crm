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
                            <h6 class="m-0 font-weight-bold text-gray-900">países</h6>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{route('countries.create')}}"><button type="bottom" class="btn btn-primary">+ Crear país</button></a>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-gray-100">
                    <div class="table-responsive">
                        <table class="table text-gray-900" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center cursor-pointer">
                                    <th>Nombre</th>
                                    <th>Codigo telefono</th>
                                    <th class="d-none d-sm-table-cell">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($countries as $country)
                                    <tr class="tr-etiquetas">
                                        <td>
                                            <a href="{{route('countries.show', $country)}}" class="text-gray-900 ">
                                                {{$country->nombre}}
                                            </a>
                                        </td>
                                        <td>
                                            <img src="{{ asset(str_replace('public', 'storage', $country->urlbandera)) }}" class="banderas-agentes" title="{{$country->nombre}}"> 
                                            {{$country->codigotelefono}}
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            <a href="{{route('countries.edit', $country)}}">Editar</a>
                                            &nbsp;&nbsp;
                                            @role('admin')
                                                <a href="{{route('countries.show', $country)}}" class="text-danger">Eliminar</a>
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
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    {{-- TABLA --}}
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({
                "pageLength": 80,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
                }
            });
        });
    </script>
@endsection