@extends('layouts.plantilla')
@section('content')
<!-- Begin Page Content -->
<div class="container-xl container-520">
    <div class="card shadow mb-4">
        <div class="card-body bg-gray-100">
            <form action="{{route('eventos.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- ******** --}}
                <div class="input-group mb-1">
                    <input class="form-control" type="text" name="userid" value="{{Auth::user()->id}}" required hidden>
                </div>
                {{-- IMAGEN --}}
                <div class="text-center">
                    <img src="{{asset('img/evento-preview.png')}}" class="foto-perfil-preview" id="frameimagen">
                    <br>
                    <label for="urlimagen" style="cursor:pointer;"><u>Subir imagen</u></label>
                    <input class="form-control" type="file" id="urlimagen" name="urlimagen" onchange="previewimagen()" hidden>
                </div>
                {{-- ******** --}}
                Nombre
                <div class="input-group mb-1">
                    <input class="form-control" type="text" name="nombre" required>
                </div>
                {{-- ******** --}}
                <div class="row">
                    <div class="col">
                        Fecha
                    </div>
                    <div class="col">
                        Tipo
                    </div>
                </div>
                <div class="input-group mb-1">
                    <input class="form-control" type="datetime-local" name="fecha" required>
                    <input class="form-control" type="text" name="tipo" required>
                </div>
                {{-- ******** --}}
                <div class="row">
                    <div class="col">
                        País
                    </div>
                    <div class="col">
                        URL de acceso
                    </div>
                </div>
                <div class="input-group mb-1">
                    <select class="form-control" name="pais">
                        <option value="Global">Seleccione un país</option>
                        @foreach ($paises as $pais)
                            <option value="{{$pais->nombre}}">{{$pais->nombre}}</option>
                        @endforeach
                    </select>
                    <input class="form-control" type="text" name="urldeacceso" required>
                </div>
                {{-- Descripción --}}
                <textarea class="w-100" id="exampleFormControlTextarea1" name="descripcion" rows="4" maxlength="2000" placeholder="Descripción..."></textarea>
                {{-- ******** --}}
                <div class="input-group mb-1">
                    <input class="form-control" type="text" name="destacado" value="." required hidden>
                </div>
                <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Agregar Evento</button>
                </div>
            </form>
        </div>
    </div>
</div>
<br>
<!-- Aparecer Formularios -->
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
{{-- IMAGEN --}}
<script>
    function previewimagen() {
        frameimagen.src = URL.createObjectURL(event.target.files[0]);
    }
    function clearImage() {
        document.getElementById('formFile').value = null;
        frameimagen.src = "";
    }
</script>
@endsection