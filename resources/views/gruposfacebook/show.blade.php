@extends('layouts.plantilla')
@section('content')
<div class="container-xl container-520">          
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-gray-100">
            <h6 class="m-0 font-weight-bold text-gray-900">Perfil</h6>
        </div>
        <div class="card-body bg-gray-100">
            <div class="table-responsive">
                <div class="form-group">
                    <label>Grupo</label>
                    <h3 class="text-gray-900">
                        {{$gruposfacebook->nombre}}
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
@role('admin')
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="{{route('gruposfacebook.edit', $gruposfacebook)}}"  class="btn btn-primary btn-lg btn-block">Editar Grupo</a>
            </div>
            <div class="col">
                <form action="{{route('gruposfacebook.destroy', $gruposfacebook)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-lg btn-block">Eliminar Grupo</button>
                </form>
            </div>
        </div>
    </div>
@endrole  
<br><br>  
@endsection
