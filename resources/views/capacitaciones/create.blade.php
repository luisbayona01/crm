@extends('layouts.plantilla')
@section('content')
@role('admin')
<div class="container-xl container-520"> 
    <div class="card shadow mb-4">
        <div class="card-body bg-gray-100">
            <div class="table-responsive">
                <form action="{{route('capacitaciones.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- ******** --}}
                    Título
                    <div class="input-group mb-1">
                        <input class="form-control" type="text" name="titulo" required>
                    </div>
                    {{-- ******** --}}
                    URL video
                    <div class="input-group mb-1">
                        <input class="form-control" type="text" name="urlvideo" required>
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
                            <option value="">Seleccione un país</option>
                            @foreach ($paises as $pais)
                                <option value="{{$pais->nombre}}">{{$pais->nombre}}</option>
                            @endforeach
                        </select>
                        <input class="form-control" type="text" name="tipo" required>
                    </div>
                    {{-- ******** --}}
                    <div class="input-group mb-1" hidden>
                        <input class="form-control" type="text" name="destacar" value="." required>
                    </div>
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Agregar Capacitación</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endrole
<br>
<!-- Aparecer Formularios -->
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
@endsection