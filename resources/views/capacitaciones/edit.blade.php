@extends('layouts.plantilla')
@section('content')
<!-- Begin Page Content -->
<div class="container-xl container-520"> 
@role('admin')
    <!-- Flexbox container for aligning the toasts -->
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="position:absolute;right:20px;top:80px;">
        <!-- Then put toasts within -->
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000">
        <div class="toast-header bg-success">
        </div>
        <div class="toast-body bg-gray-100">
            <h6 class="text-gray-900 text-center">Capacitación Actualizada</h6>
        </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body bg-gray-100">
            <div class="table-responsive">
                <form action="{{route('capacitaciones.update', $capacitacion)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    {{-- ******** --}}
                    Título
                    <div class="input-group mb-1">
                        <input class="form-control" type="text" name="titulo" value="{{old('titulo', $capacitacion->titulo)}}" required>
                    </div>
                    {{-- ******** --}}
                    URL video
                    <div class="input-group mb-1">
                        <input class="form-control" type="text" name="urlvideo" value="{{old('urlvideo', $capacitacion->urlvideo)}}" required>
                    </div>
                    {{-- ******** --}}
                    <div class="row">
                        <div class="col">
                            País  
                        </div>
                        <div class="col">
                            Tipo           
                        </div>
                    </div>
                    <div class="input-group mb-1">
                        <select class="form-control" name="pais">
                            <option value="{{old('pais', $capacitacion->pais)}}">{{old('pais', $capacitacion->pais)}}</option>
                            @foreach ($paises as $pais)
                                <option value="{{$pais->nombre}}">{{$pais->nombre}}</option>
                            @endforeach
                        </select>
                        <input class="form-control" type="text" name="tipo" value="{{old('tipo', $capacitacion->tipo)}}" required>
                    </div>
                    {{-- ******** --}}
                    <div class="input-group mb-1" hidden>
                        <input class="form-control" type="text" name="destacar" value="{{old('destacar', $capacitacion->destacar)}}" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Actualizar Capacitación</button>
                </form>
                <div class="text-right">
                    <a class="text-danger" href="{{route('capacitaciones.destroy', $capacitacion)}}">Eliminar</a>
                </div>                 
            </div>
        </div>
    </div>
@endrole
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
@endsection