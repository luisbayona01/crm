@extends('layouts.plantilla')
@section('title', 'Contáctanos')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-xl container-520">
        <!-- Form Example -->
        <div class="card shadow mb-4">
            <div class="card-body bg-gray-100">
                <div class="table-responsive">
                    <h2 class="text-gray-900 text-center">CARGANDO...</h2>
                    <form id="formularionotificacion" action="{{route('contactanos.storenotificacion')}}" method="POST" hidden>
                        @csrf
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" value="{{Auth::user()->name}}" class="form-control" required>
                            @error('nombre')
                                <br>
                                <small>* Este campo es obligatorio</small>
                                <br>
                            @enderror
                            <br>
                            <label>
                                Correo
                            </label>
                            <input type="email" name="correo" value="{{Auth::user()->email}}" class="form-control" required>
                            @error('Correo')
                                <br>
                                <small>* Este campo es obligatorio</small>
                                <br>
                            @enderror
                            <br>
                            <label>
                                Mensaje
                            </label>
                            <textarea id="mensaje" name="mensaje" class="form-control">
                                Hay una Solicitud pendiente TxID: {{session('txid')}}
                            </textarea>
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
            <h6 class="text-gray-900 text-center">Solicitud de transacción enviada</h6>
            <h6 class="text-gray-900 text-center">Esperar a que sea aprobada</h6>
        </div>
        </div>
    </div>





    <!-- Aparecer Formularios -->
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script type="text/javascript">
        document.forms["formularionotificacion"].submit();
    </script>
@endsection