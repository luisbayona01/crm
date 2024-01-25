@extends('layouts.plantilla')
@section('content')
<!-- Begin Page Content -->
<div class="container-xl container-520"> 
    <!-- CARD -->
    <div class="card shadow mb-4">
        <div class="card-body bg-gray-100">
            <div class="table-responsive">
                <form action="{{ route('publicacions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card shadow mb-4 bg-gray-100 text-gray-900">
                        {{-- ******** --}}
                        <input class="form-control w-100" type="text" name="userid" value="{{Auth::user()->id}}" required hidden>
                        {{-- ******** --}}
                        <input class="form-control w-100" type="text" name="titulo" value="." required hidden>
                        {{-- IMAGEN --}}
                        <label for="urlimagen" style="cursor:pointer;">
                            <img src="{{asset('img/propiedad-preview.png')}}" class="card-img-top" id="frameimagenpublicacion" alt="...">
                        </label>
                        <input class="form-control" type="file" id="urlimagen" name="urlimagen" onchange="previewimagenpublicacion()" hidden>
                        {{-- Descripción --}}
                        <textarea class="w-100" name="descripcion" rows="4" maxlength="500" placeholder="Descripción..." required></textarea>
                        <div class="input-group-append align-items-center">
                            <input class="form-control w-100" type="text" name="ubicacion" value="" placeholder="📍Ubicación" required>
                            <input class="form-control w-100" type="text" name="pais" value="" placeholder="País" required>
                        </div>
                        <div class="card-body">
                            <!-- INTERACCIONES -->
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="input-group-append align-items-center">
                                        <input class="form-control w-100" type="text" name="precio" placeholder="$Precio" oninput="formatNumber(this)">
                                    </div>                                        
                                </div>
                                <div class="col-6">
                                    <div class="input-group-append align-items-center">
                                        <input class="form-control w-100" type="number" name="comision" value="" placeholder="%Comisión" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" >Publicar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
<!-- Aparecer Formularios -->
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
{{-- IMAGEN PUBLICACION --}}
<script>
    function previewimagenpublicacion() {
        frameimagenpublicacion.src = URL.createObjectURL(event.target.files[0]);
    }
    function clearImage() {
        document.getElementById('formFile').value = null;
        frameimagenpublicacion.src = "";
    }
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