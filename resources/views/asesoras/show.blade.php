@extends('layouts.plantilla')
@section('title', 'Asesora'.$asesora->nombre)
@section('content')

    <!-- Begin Page Content -->
    <div class="container-xl container-520">          
        <!-- Form Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-gray-100">
                <h6 class="m-0 font-weight-bold text-gray-900">Perfil</h6>
            </div>
            <div class="card-body bg-gray-100">
                <div class="table-responsive">
                    <div class="form-group">
                        <label>NOMBRE</label>
                        <h3 class="text-gray-900">
                            {{$asesora->nombre}}
                        </h3>
                    </div>        
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->



@role('admin')
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="{{route('asesoras.edit', $asesora)}}"  class="btn btn-primary btn-lg btn-block">Editar Asesora</a>
            </div>
            <div class="col">
                <form action="{{route('asesoras.destroy', $asesora)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-lg btn-block">Eliminar Asesora</button>
                </form>
            </div>
        </div>
    </div>
    <br><br>
@endrole    
@endsection
