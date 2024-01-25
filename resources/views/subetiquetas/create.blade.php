@extends('layouts.plantilla')
@section('title', 'Sub Etiqueta Create')
@section('content')
<!-- Begin Page Content -->
<div class="container-xl container-520"> 

    <!-- CARD -->
    <div class="card shadow mb-4">
        <div class="card-body bg-gray-100">
            <div class="table-responsive">
                <form action="{{route('subetiquetas.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="etiqueta_id">Etiqueta principal:</label>
                        <select class="form-control" name="etiqueta_id" required>
                            @foreach($etiquetas as $etiqueta)
                                <option value="{{$etiqueta->id}}">{{$etiqueta->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre de la subetiqueta:</label>
                        <input class="form-control" type="text" name="nombre" value="" required>
                    </div> 
                    @error('nombre')
                        <br>
                        <small>* Este campo es obligatorio</small>
                        <br>
                    @enderror
                    {{-- ******** --}}
                    <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Agregar subetiqueta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Aparecer Formularios -->
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    
</div>
@endsection