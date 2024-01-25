@extends('layouts.plantilla')
@section('content')
<!-- Begin Page Content -->
<div class="container-xl container-520"> 
    @role('admin')
        <!-- CARD -->
        <div class="card shadow mb-4">
            <div class="card-body bg-gray-100">
                <div class="table-responsive">
                    <form action="{{route('gruposfacebook.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- ******** --}}
                        Nombre
                        <div class="input-group mb-1">
                            <input class="form-control" type="text" name="nombre" value="." required>
                        </div>
                        {{-- ******** --}}
                        País
                        <div class="input-group mb-1">
                            <input class="form-control" type="text" name="pais" value="." required>
                        </div>
                        {{-- ******** --}}
                        <div class="input-group mb-1">
                            <input class="form-control" type="text" name="cantidadmiembros" value="." required hidden>
                        </div>
                        {{-- ******** --}}
                        Link
                        <div class="input-group mb-1">
                            <input class="form-control" type="text" name="urlgrupo" value="." required>
                        </div>
                        <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Agregar Grupo</button>
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
    @endsection