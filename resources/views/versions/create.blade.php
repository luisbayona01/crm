@extends('layouts.plantilla')
@section('content')
<div class="container-xl container-520"> 
    @role('admin')
        <!-- CARD -->
        <div class="card shadow mb-4">
            <div class="card-body bg-gray-100">
                <div class="table-responsive">
                    <form action="{{route('versions.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- ******** --}}
                        Versión
                        <div class="input-group mb-1">
                            <input class="form-control" type="text" name="version" value="" required>
                        </div>
                        {{-- ******** --}}
                        Comentario
                        <div class="input-group mb-1">
                            <input class="form-control" type="text" name="comentario" value="" required>
                        </div> 
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Agregar Versión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endrole
</div>
<br>
<!-- Aparecer Formularios -->
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
@endsection