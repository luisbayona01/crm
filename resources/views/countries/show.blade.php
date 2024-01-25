@extends('layouts.plantilla')
@section('content')
<div class="container-xl">
    <div class="card shadow mb-4">
        <div class="card-body bg-gray-100">
            <div class="table-responsive">
                <div class="form-group">
                    <h3 class="text-gray-900">
                        {{$country->nombre}}
                    </h3>
                    <h3 class="text-gray-900">
                        <img src="{{ asset(str_replace('public', 'storage', $country->urlbandera)) }}" class="banderas-agentes" title="{{$country->nombre}}">
                        {{$country->codigotelefono}}
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
            <a href="{{route('countries.edit', $country)}}"  class="btn btn-primary btn-lg btn-block">Editar pais</a>
        </div>
        <div class="col">
            <form action="{{route('countries.destroy', $country)}}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-lg btn-block">Eliminar país</button>
            </form>
        </div>
        
    </div>
</div>
@endrole 
<br><br>
@endsection