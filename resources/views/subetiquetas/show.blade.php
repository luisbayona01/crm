@extends('layouts.plantilla')
@section('title', 'Sub etiqueta'.$subetiqueta->nombre)
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
                            {{$subetiqueta->nombre}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->


    <div class="container">
        <div class="row">
            <div class="col">
                <a href="{{route('subetiquetas.edit', $subetiqueta)}}"  class="btn btn-primary btn-lg btn-block">Editar Etiqueta</a>
            </div>
            <div class="col">
                <form action="{{route('subetiquetas.destroy', $subetiqueta)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-lg btn-block">Eliminar etiqueta</button>
                </form>
            </div>
        </div>
    </div>
    <br><br>
  
@endsection
