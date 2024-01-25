@extends('layouts.plantilla')
@section('content')
{{-- MODAL IMAGEN --}}
<div class="modal fade" id="imagenmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-gray-900">
                <img src="{{asset(str_replace('public', 'storage', $evento->urlimagen))}}" width="100%">
            </div>
        </div>
    </div>            
</div>
<!-- Begin Page Content -->
<div class="container-xl container-520"> 
    <!-- Flexbox container for aligning the toasts -->
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="position:absolute;right:20px;top:80px;">
        <!-- Then put toasts within -->
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000">
        <div class="toast-header bg-success">
        </div>
        <div class="toast-body bg-gray-100">
            <h6 class="text-gray-900 text-center">Evento Actualizado</h6>
        </div>
        </div>
    </div>
    <!-- CARD -->
    <div class="card shadow mb-4">
        <div class="card-body bg-gray-100">
            <div class="table-responsive">
                
                <form action="{{route('eventos.update', $evento)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    {{-- USER ID --}}
                    <input class="form-control" type="text" name="userid" value="{{old('userid', $evento->userid)}}" required hidden>
                    {{-- IMAGEN --}}
                    <div class="text-center">
                        <label data-toggle="modal" data-target="#imagenmodal" style="cursor:pointer;">
                            <img src="{{ asset(str_replace('public', 'storage', $evento->urlimagen)) }}" class="foto-perfil-preview" id="frameimagen">
                        </label>
                        <br>
                        <label for="urlimagen" style="cursor:pointer;"><u>Cambiar imagen</u></label>
                        <input class="form-control" type="file" id="urlimagen" name="urlimagen" onchange="previewimagen()" hidden>
                    </div>
                    Nombre
                    <div class="input-group mb-1">
                        <input class="form-control" type="text" name="nombre" value="{{old('nombre', $evento->nombre)}}" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            Fecha
                        </div>
                        <div class="col">
                            Tipo
                        </div>
                    </div>
                    <div class="input-group mb-1">
                        <input class="form-control" type="datetime-local" name="fecha" value="{{ old('fecha', $fecha) }}" required>
                        <input class="form-control" type="text" name="tipo" value="{{old('tipo', $evento->tipo)}}" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            País
                        </div>
                        <div class="col">
                            URL de acceso
                        </div>
                    </div>
                    País
                    <div class="input-group mb-1">
                        <select class="form-control" name="pais" required>
                            <option value="{{old('pais', $evento->pais)}}">{{old('pais', $evento->pais)}}</option>
                            @foreach ($paises as $pais)
                                <option value="{{$pais->nombre}}">{{$pais->nombre}}</option>
                            @endforeach
                        </select>
                        <input class="form-control" type="text" name="urldeacceso" value="{{old('urldeacceso', $evento->urldeacceso)}}" required>
                    </div>
                    Descripción
                    {{-- Descripción --}}
                    <textarea class="w-100" id="exampleFormControlTextarea1" name="descripcion" rows="4" maxlength="2000" placeholder="Descripción...">{{old('descripcion', $evento->descripcion)}}</textarea>
                    {{-- ******** --}}
                    <div class="input-group mb-1">
                        <input class="form-control" type="text" name="destacado" value="{{old('destacado', $evento->destacado)}}" required hidden>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Actualizar evento</button>
                    </div>
                </form>
                <div class="text-right">
                    <a class="text-danger" href="{{route('eventos.destroy', $evento)}}">Eliminar</a>
                </div>        
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