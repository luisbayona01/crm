@extends('layouts.plantilla')
@section('title', 'Etiquetas Create')
@section('content')
<!-- AGREGAR -->
<div class="row">
    <div class="col-sm-6">
        
    </div>
    <div class="col-sm-6 text-right">
        <div class="d-sm-none">
            <br>
        </div>
        <a href="{{route('subetiquetas.create')}}"><button type="bottom" class="btn btn-info">+ Agregar sub etiqueta</button></a>
    </div>
</div>


<!-- Begin Page Content -->
<div class="container-xl container-520"> 

    <!-- CARD -->
    <div class="card shadow mb-4">
        <div class="card-body bg-gray-100">
            <div class="table-responsive">
                <form action="{{route('etiquetas.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    Nombre de la etiqueta
                    <div class="input-group mb-1">
                        <input class="form-control" type="text" name="nombre" value="" required>
                    </div> 
                    @error('nombre')
                        <br>
                        <small>* Este campo es obligatorio</small>
                        <br>
                    @enderror
                    {{-- ******** --}}
                    <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Agregar etiqueta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Aparecer Formularios -->
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    
</div>
@endsection