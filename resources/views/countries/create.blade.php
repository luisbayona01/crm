@extends('layouts.plantilla')
@section('content')
<!-- Begin Page Content -->
<div class="container-xl container-520"> 
    @role('admin')
    <!-- CARD -->
    <div class="card shadow mb-4">
        <div class="card-body bg-gray-100">
            <div class="table-responsive">
                <form action="{{route('countries.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- ******** --}}
                    Nombre
                    <div class="input-group mb-1">
                        <input class="form-control" type="text" name="nombre" value="" required>
                    </div>
                    {{-- ******** --}}
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            Bandera
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            Codigo telefono
                        </div>
                    </div>
                    <div class="input-group mb-1">
                        {{-- BANDERA --}}
                        <div class="text-center">
                            <img src="{{asset('img/pais-preview.png')}}"  id="framebandera" style="height:38px;">
                            <br>
                            <label for="urlbandera" style="cursor:pointer;"><u>Subir bandera</u></label>
                            <input class="form-control" type="file" id="urlbandera" name="urlbandera" onchange="previewbandera()" hidden>
                        </div>
                        <input class="form-control" type="text" name="codigotelefono" value="." required>
                    </div>
                    <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Agregar país</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <br>

    <!-- Aparecer Formularios -->
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>

@endrole
</div>
{{-- BANDERA --}}
<script>
    function previewbandera() {
        framebandera.src = URL.createObjectURL(event.target.files[0]);
    }
    function clearImage() {
        document.getElementById('formFile').value = null;
        framebandera.src = "";
    }
</script>
@endsection