@extends('layouts.plantilla')
@section('content')
<!-- Begin Page Content -->
<div class="container-xl container-520"> 
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="position:absolute;right:20px;top:80px;">

        <!-- Then put toasts within -->
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000">
        <div class="toast-header bg-success">
        </div>
        <div class="toast-body bg-gray-100">
            <h6 class="text-gray-900 text-center">Etiqueta Actualizada</h6>
        </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body bg-gray-100">
            <div class="table-responsive">
                
                <form action="{{route('etiquetas.update', $etiqueta)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-md">Actualizar etiqueta</button>
                    </div>
                    Nombre
                    <div class="input-group mb-1">
                        <input class="form-control" type="text" name="nombre" value="{{old('nombre', $etiqueta->nombre)}}" required>
                    </div> 
                    @error('nombre')
                        <br>
                        <small>* Este campo es obligatorio</small>
                        <br>
                    @enderror
                    {{-- ******** --}}
                    <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Actualizar etiqueta</button>
                    </div>
                </form>

                <div class="text-right">
                    <a class="text-danger" href="{{route('etiquetas.destroy', $etiqueta)}}">Eliminar</a>
                </div>
                                        
            </div>
        </div>
    </div>
</div>
<!-- Aparecer Formularios -->
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
@if(session('info'))
    <script type="text/javascript">
        $(document).ready(function(){
            $('.toast').toast("show")
        });
    </script>
@endif
@endsection