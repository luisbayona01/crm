@extends('layouts.plantilla')
@section('content')
    @role('admin')
    <!-- Content Row 1 -->
    <div class="row">
        <!-- User name Card Example -->
        <div class="col-xl-12">
            
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-gray-100">
                    <div class="row">
                        <div class="col-sm">
                            <h6 class="m-0 font-weight-bold text-gray-900">Todos los usuarios</h6>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{route('asesoras.index')}}"><button type="bottom" class="btn btn-primary">Asesoras</button></a>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-gray-100">
                    <div class="table-responsive">
                        <table class="table table-bordered text-gray-900" id="dataTable" data-order='[[ 0, "asc" ]]' width="100%" cellspacing="0" style="font-size:14px">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Nombres</th>
                                    <th>Iniciales</th>
                                    <th>Correo</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>
                                        <a href="{{route('usuarios.show', $user)}}" class="text-gray-900">
                                            <img src="{{ asset(str_replace('public', 'storage', $user->urlfotoperfil)) }}" width="25" height="25" class="rounded-circle">
                                            &nbsp;
                                            {{$user->username}}
                                        </a>
                                        </td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->estado}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <a href="{{route('usuarios.edit', $user)}}">Editar</a>
                                        &nbsp;&nbsp;
                                        <a class="text-danger" href="{{route('usuarios.destroy', $user)}}">Eliminar</a>
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
    @else
    <script>
        // Esta función se ejecutará cuando la página se cargue completamente
        window.onload = function() {
            // Redirigir a la vista deseada
            window.location.href = "{{ route('usuarios.show', ['user' => Auth::user()]) }}";
        };
    </script>
    @endrole
@endsection
