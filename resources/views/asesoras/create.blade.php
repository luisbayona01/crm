@extends('layouts.plantilla')
@section('title', 'Asesoras Create')
@section('content')
<!-- Begin Page Content -->
<div class="container-xl container-520"> 
    @role('admin')
        <!-- CARD -->
        <div class="card shadow mb-4">
            <div class="card-body bg-gray-100">
                <div class="table-responsive">
                    
                    <form action="{{route('asesoras.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- ******** --}}
                        Nombre
                        <div class="input-group mb-1">
                            <input class="form-control" type="text" name="nombre" value="" required>
                        </div> 
                        @error('nombre')
                            <br>
                            <small>* Este campo es obligatorio</small>
                            <br>
                        @enderror
                        {{-- ******** --}}
                        Iniciales
                        <div class="input-group mb-1">
                            <input class="form-control" type="text" name="iniciales" value="" required>
                        </div> 
                        @error('iniciales')
                            <br>
                            <small>* Este campo es obligatorio</small>
                            <br>
                        @enderror
                        <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Agregar Asesora</button>
                        </div>
                    </form>
    
    
                </div>
            </div>
        </div>

        
    
        <!-- Aparecer Formularios -->
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    
    @endrole
    </div>
    @endsection