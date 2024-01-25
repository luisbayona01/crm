@extends('layouts.plantilla')
@section('content')
<!-- Begin Page Content -->
<div class="container-xl container-520"> 
    @if(Auth::user()->id == $publicacion->userid)
    <!-- Flexbox container for aligning the toasts -->
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="position:absolute;right:20px;top:80px;">
        <!-- Then put toasts within -->
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000">
        <div class="toast-header bg-success">
        </div>
        <div class="toast-body bg-gray-100">
            <h6 class="text-gray-900 text-center">Publicación Actualizada</h6>
        </div>
        </div>
    </div>
    <!-- CARD -->
    <div class="card shadow mb-4">
        <div class="card-body bg-gray-100">
            <div class="table-responsive">
                <form action="{{route('publicacions.update', $publicacion)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card shadow mb-4 bg-gray-100 text-gray-900">
                        <input class="form-control w-100" type="text" name="userid" value="{{old('publicacion', $publicacion->userid)}}" required hidden>
                        {{-- IMAGEN --}}
                        <div class="text-center">
                            <label data-toggle="modal" data-target="#imagenmodal" style="cursor:pointer;">
                                <img src="{{asset(str_replace('public', 'storage', $publicacion->urlimagen))}}" class="card-img-top" id="frameimagenpublicacion">
                            </label>
                            <br>
                            <label for="urlimagen" style="cursor:pointer;"><u>Cambiar imagen</u></label>
                            <input class="form-control" type="file" id="urlimagen" name="urlimagen" onchange="previewimagenpublicacion()" hidden>
                        </div>
                        <input class="form-control w-100" type="text" name="titulo" value="{{old('publicacion', $publicacion->titulo)}}" required hidden>
                        {{-- Descripción --}}
                        <textarea class="w-100" name="descripcion" rows="6" maxlength="500" placeholder="Descripción...">{{old('publicacion', $publicacion->descripcion)}}</textarea>
                        <div class="input-group-append align-items-center">
                            <input class="form-control w-100" type="text" name="ubicacion" value="{{old('publicacion', $publicacion->ubicacion)}}" placeholder="📍Ubicación" required>
                            <input class="form-control w-100" type="text" name="pais" value="{{old('publicacion', $publicacion->pais)}}" placeholder="País" required>
                        </div>
                        <div class="card-body">
                            <!-- INTERACCIONES -->
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="input-group-append align-items-center">
                                        <input class="form-control w-100" type="text" name="precio" value="{{old('publicacion', $publicacion->precio)}}" placeholder="$Precio" oninput="formatNumber(this)">
                                    </div>                                        
                                </div>
                                <div class="col-6">
                                    <div class="input-group-append align-items-center">
                                        <input class="form-control w-100" type="number" name="comision" value="{{old('publicacion', $publicacion->comision)}}" placeholder="%Comisión" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Actualizar</button>
                </form>
                <div class="text-right">
                    <a class="text-danger" href="{{route('publicacions.destroy', $publicacion)}}">Eliminar</a>
                </div>        
            </div>
        </div>
    </div>
    @endif
</div>
<br>
<!-- Aparecer Formularios -->
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
@if(session('info'))
    <script type="text/javascript">
        $(document).ready(function(){
            $('.toast').toast("show")
        });
    </script>
@endif
{{-- IMAGEN PUBLICACION --}}
<script>
    function previewimagenpublicacion() {
        frameimagenpublicacion.src = URL.createObjectURL(event.target.files[0]);
    }
    function clearImage() {
        document.getElementById('formFile').value = null;
        frameimagenpublicacion.src = "";
    }
    document.addEventListener("DOMContentLoaded", function() {
        // Obtén una referencia al elemento "Editar foto" y al input de la foto.
        var editarFoto = document.getElementById("editar-foto");
        var inputFoto = document.getElementById("urlimagen");
    });
</script>
{{-- FORMATO DE PRECIO --}}
<script>
    function formatNumber(input) {
      // Obtén el valor actual del input
      let value = input.value;
  
      // Remueve todos los puntos y comas
      value = value.replace(/[,.]/g, '');
  
      // Formatea el valor con puntos para separar los miles
      value = new Intl.NumberFormat('es-ES').format(value);
  
      // Actualiza el valor en el input
      input.value = value;
    }
</script>
@endsection