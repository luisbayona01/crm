@extends('layouts.plantilla')
@section('title', 'TRADINGOLD | Admin')
@section('content')
    @role('admin')
    <!-- Content Row 1 -->
    <div class="row">

        <!-- User name Card Example -->
        <div class="col-xl-12">
            
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-gray-900">
                    <div class="row">
                        <div class="col-sm">
                            <h6 class="m-0 font-weight-bold text-gray-100">Transacciones pendientes</h6>
                        </div>
                        <div class="col-sm text-right">
                            
                        </div>
                    </div>
                </div>
                <div class="card-body bg-gray-900">
                    <div class="table-responsive">
                        <table class="table table-bordered text-gray-100" id="dataTable" data-order='[[ 0, "desc" ]]' width="100%" cellspacing="0" style="font-size: 14px;">
                            <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Nombre Transacción</th>
                                    <th>Usuario</th>
                                    <th>Monto de Inversión</th>
                                    <th>Método de pago</th>
                                    <th>Fecha de pago</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                               
                                <tr>
                                    <td>asd</td>
                                    <td>
                                        asd
                                    </td>
                                    <td>asd</td>
                                    <td class="text-right">
                                        asd
                                    </td>
                                    <td>asd</td>
                                    <td>asd</td>
                                    <td>asd</td>
                                    <td>
                                        asd
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            

        </div>

    </div>


    @endrole
@endsection