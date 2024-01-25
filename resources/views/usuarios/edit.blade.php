@extends('layouts.plantilla')
@section('title', 'Usuario Edit')
@section('content')
{{-- MODAL FOTO DE PERFIL --}}
<div class="modal fade" id="fotodeperfilmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-gray-900">
                <img src="{{ asset(str_replace('public', 'storage', $user->urlfotoperfil)) }}" width="100%">
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
            <h6 class="text-gray-900 text-center">Contacto Actualizado</h6>
        </div>
        </div>
    </div>          
    <!-- CARD -->
    <div class="card shadow mb-4">
        <div class="card-body bg-gray-100">
            <div class="table-responsive">
                <form action="{{route('usuarios.update', $user)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    {{-- FOTO DE PORTADA --}}
                    <div class="text-center" hidden>
                        <img src="{{ asset(str_replace('public', 'storage', $user->urlfotoportada)) }}" class="W-100" height="300" id="framefotoportada">
                        <br>
                        <label for="urlfotoportada" style="cursor:pointer;"><u>Cambiar portada</u></label>
                        <input class="form-control" type="file" id="urlfotoportada" name="urlfotoportada" onchange="previewfotodeportada()" hidden>
                        <br>
                    </div> 
                    <br>
                    {{-- FOTO DE PERFIL --}}
                    <div class="text-center">
                        <label data-toggle="modal" data-target="#fotodeperfilmodal" style="cursor:pointer;">
                            <img src="{{ asset(str_replace('public', 'storage', $user->urlfotoperfil)) }}" class="rounded-circle foto-perfil-preview" id="framefotodeperfil">
                        </label>
                        <br>
                        <label for="urlfotoperfil" style="cursor:pointer;"><u>Cambiar foto de perfil</u></label>
                        <input class="form-control" type="file" id="urlfotoperfil" name="urlfotoperfil" onchange="previewfotodeperfil()" hidden>
                        <br>
                    </div>
                    {{-- VISTA DE ADMINISTRADOR --}}
                    @role('admin')
                    Nombre y Apellido
                    <input class="form-control" type="text" name="name" value="{{old('name', $user->name)}}">
                    <br>
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            intREasso Number
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            Iniciales
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" name="intreassonumber" value="{{old('intreassonumber', $user->intreassonumber)}}">
                        <input class="form-control" type="text" name="estado" value="{{old('estado', $user->estado)}}">
                    </div>
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            Correo
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            Roles
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control" type="email" name="email" value="{{old('email', $user->email)}}">
                        <select class="form-control" id="roles" name="roles[]">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" @if(in_array($role->id, $user->roles->pluck('id')->toArray())) selected @endif>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    Descripción
                    <textarea class="w-100" name="descripcionperfil" rows="3" maxlength="800">{{old('descripcionperfil', $user->descripcionperfil)}}</textarea>
                    @else
                    {{-- VISTA DE USUARIO --}}
                    <input class="form-control" type="text" name="name" value="{{old('name', $user->name)}}" hidden>
                    <input class="form-control" type="text" name="estado" value="{{old('estado', $user->estado)}}" hidden>
                    <select class="form-control" id="roles" name="roles[]" hidden>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" @if(in_array($role->id, $user->roles->pluck('id')->toArray())) selected @endif>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            Nombre y Apellido
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            Correo
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" name="name" value="{{old('name', $user->name)}}" required>
                        <input class="form-control" type="email" name="email" value="{{old('email', $user->email)}}" readonly>
                    </div>
                    @endrole
                    {{-- IDENTIFICACIÓN --}}
                    <div class="text-center">
                        <img src="{{ asset(str_replace('public', 'storage', $user->urlidentificacion)) }}" class="W-100" height="300" id="frameidentificacion">
                        <br>
                        <label for="urlidentificacion" style="cursor:pointer;"><u>Cambiar identifiación</u></label>
                        <input class="form-control" type="file" id="urlidentificacion" name="urlidentificacion" onchange="previewidentifiacion()" hidden>
                        <br>
                    </div> 
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            Número de identificación
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            Fecha de nacimiento
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" name="numeroidentificacion" value="{{old('numeroidentificacion', $user->numeroidentificacion)}}">
                        <input class="form-control" type="date" name="fechadenacimiento" value="{{old('fechadenacimiento', $user->fechadenacimiento)}}">
                    </div> 
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            País
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            Teléfono
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-control" name="pais" required>
                            <option value="{{old('pais', $user->pais)}}">{{old('pais', $user->pais)}}</option>
                            @foreach ($paises as $pais)
                                <option value="{{$pais->nombre}}">{{$pais->nombre}}</option>
                            @endforeach
                        </select>
                        <input class="form-control" type="text" id="telefono" name="telefono" value="{{old('telefono', $user->telefono)}}" placeholder="+13058908515">
                    </div> 
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            Región
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            Ciudad o Localidad
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" name="region" value="{{old('region', $user->region)}}">
                        <input class="form-control" type="text" name="ciudad" value="{{old('ciudad', $user->ciudad)}}">
                    </div> 
                    Dirección de domicilio
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" name="direccion" value="{{old('direccion', $user->direccion)}}">
                    </div> 
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            Referencia 1
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            Referencia 2
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <textarea name="referencia1" rows="3" maxlength="500">{{old('referencia1', $user->referencia1)}}</textarea>
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            <textarea name="referencia2" rows="3" maxlength="500">{{old('referencia2', $user->referencia2)}}</textarea> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            URL Facebook
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            URL Instagram
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" name="urlfacebook" value="{{old('urlfacebook', $user->urlfacebook)}}">
                        <input class="form-control" type="text" name="urlinstagram" value="{{old('urlinstagram', $user->urlinstagram)}}">
                    </div>
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            Otra red social
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            URL Página Web
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" name="otraredsocial" value="{{old('otraredsocial', $user->otraredsocial)}}">
                        <input class="form-control" type="text" name="paginaweb" value="{{old('paginaweb', $user->paginaweb)}}">
                    </div>
                    Temas
                    <div class="input-group mb-3">
                        @php
                            $opciones = ['Oscuro', 'Claro'];
                        @endphp
                        <select class="form-control" name="temaplantilla">
                            @foreach ($opciones as $opcion)
                                @if ($opcion == old('temaplantilla', $user->temaplantilla))
                                    <option value="{{ $opcion }}" selected>{{ $opcion }}</option>
                                @else
                                    <option value="{{ $opcion }}">{{ $opcion }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div> 
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Actualizar usuario</button>
                </form>
                
                
            </div>
        </div>
    </div>
    <br>
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
{{-- TELÉFONO --}}
<script type="text/javascript">
    var telefono = document.getElementById("telefono");
    telefono.addEventListener("input", function(event) {
        var valor = telefono.value;
        valor = valor.replace(/[^0-9+]/g, "");
        telefono.value = valor;
    });
</script>
{{-- FOTO DE PORTADA --}}
<script>
    function previewfotodeportada(){
        framefotoportada.src = URL.createObjectURL(event.target.files[0]);
    }
    function clearImage() {
        document.getElementById('formFile').value = null;
        framefotoportada.src = "";
    }
</script>
{{-- FOTO DE PERFIL --}}
<script>
    function previewfotodeperfil(){
        framefotodeperfil.src = URL.createObjectURL(event.target.files[0]);
    }
    function clearImage(){
        document.getElementById('formFile').value = null;
        framefotodeperfil.src = "";
    }
</script>
{{-- IDENTIFICACIÓN --}}
<script>
    function previewidentifiacion(){
        frameidentificacion.src = URL.createObjectURL(event.target.files[0]);
    }
    function clearImage(){
        document.getElementById('formFile').value = null;
        frameidentificacion.src = "";
    }
</script>
@endsection