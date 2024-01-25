@extends('layouts.plantilla')
@section('content')
<!-- Begin Page Content -->
<div class="container-xl container-520"> 
    <!-- Flexbox container for aligning the toasts -->
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="position:absolute;right:20px;top:80px;">
        <!-- Then put toasts within -->
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000">
        <div class="toast-header bg-success">
        </div>
        <div class="toast-body bg-gray-100">
            <h6 class="text-gray-900 text-center">país Actualizado</h6>
        </div>
        </div>
    </div>
    <!-- CARD -->
    <div class="card shadow mb-4">
        <div class="card-body bg-gray-100">
            <div class="table-responsive">
                <form action="{{route('countries.update', $country)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    Nombre
                    <div class="input-group mb-1">
                        <input class="form-control" type="text" name="nombre" value="{{old('nombre', $country->nombre)}}" required>
                    </div>
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            Bandera
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            Codigo telefono
                        </div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="text-center">
                            <img src="{{asset(str_replace('public', 'storage', $country->urlbandera))}}" id="framebandera" style="height:38px;">
                            <br>
                            <label for="urlbandera" style="cursor:pointer;"><u>Cambiar bandera</u></label>
                            <input class="form-control" type="file" id="urlbandera" name="urlbandera" onchange="previewbandera()" hidden>
                        </div>
                        <input class="form-control" type="text" name="codigotelefono" value="{{old('codigotelefono', $country->codigotelefono)}}" required>
                    </div>
                    {{-- ******** --}}
                    <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Actualizar país</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
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