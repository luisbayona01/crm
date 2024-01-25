@extends('layouts.plantilla')
@section('title', 'Contáctanos')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-xl">
        <!-- Form Example -->
        <div class="card shadow mb-4">
            <div class="card-body bg-gray-100">
                <div class="table-responsive">
                    <h2 class="text-gray-900 text-center">Déjanos un mensaje</h2>
                    <form action="{{route('contactanos.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label hidden>Nombre</label>
                            <input type="text" name="nombre" value="{{ Auth::user()->name }}" class="form-control" hidden>
                            @error('nombre')
                                <br>
                                <small>* Este campo es obligatorio</small>
                                <br>
                            @enderror
                            <br>
                            <label hidden>
                                Correo
                            </label>
                            <input type="email" name="correo" value="info@intREasso.org" class="form-control" hidden>
                            @error('Correo')
                                <br>
                                <small>* Este campo es obligatorio</small>
                                <br>
                            @enderror
                            <br>
                            <label>
                                Mensaje
                            </label>
                            <textarea name="mensaje" class="form-control"></textarea>
                            @error('mensaje')
                                <br>
                                <small>* Este campo es obligatorio</small>
                                <br>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">ENVIAR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- Flexbox container for aligning the toasts -->
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
        <!-- Then put toasts within -->
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000">
            <div class="toast-header bg-success">
            </div>
            <div class="toast-body bg-gray-100">
                <h6 class="text-gray-900 text-center">Mensaje Enviado</h6>
                <h6 class="text-gray-900 text-center">Consultaremos tu mensaje</h6>
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