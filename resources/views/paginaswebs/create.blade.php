@extends('layouts.plantilla')
@section('content')
<div class="container-xl container-520"> 
@hasrole('afiliado|admin')
    <div class="card shadow mb-4">
        <div class="card-body bg-gray-100">
            <form action="{{route('paginaswebs.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- ******** --}}
                <input class="form-control w-100" type="text" name="userid" value="{{Auth::user()->id}}" required hidden>
                {{-- PORTADA --}}
                <label for="urlportada" class="text-center" style="cursor:pointer;">
                    <img src="{{asset('img/portada-preview.png')}}" class="card-img-top" id="frameportada">
                    <u>Subir portada</u>
                </label>
                <input class="form-control" type="file" id="urlportada" name="urlportada" onchange="previewportada()" hidden>
                {{-- LOGO --}}
                <div class="text-center">
                    <label for="urllogo" style="cursor:pointer;">
                        <img src="{{asset('img/logo-preview.png')}}" class="rounded-circle foto-perfil-preview" id="framelogo">
                        <br>
                        <u>Subir logo</u>
                    </label>
                    <input class="form-control" type="file" id="urllogo" name="urllogo" onchange="previewlogo()" hidden>
                </div>
                Título
                <div class="input-group mb-1">
                    <input class="form-control" type="text" name="titulo" required>
                </div> 
                Slogan
                <div class="input-group mb-1">
                    <input class="form-control" type="text" name="slogan" required>
                </div> 
                <br>
                {{-- QUIÉNES SOMOS --}}
                <textarea class="w-100" name="quienessomos" rows="4" maxlength="1000" placeholder="Quiénes Somos..." required></textarea>
                {{-- MISIÓN --}}
                <textarea class="w-100" name="mision" rows="4" maxlength="800" placeholder="Misión..." required></textarea>
                {{-- VISIÓN --}}
                <textarea class="w-100" name="vision" rows="4" maxlength="800" placeholder="Visión..." required></textarea>
                {{-- INFORMACIÓN --}}
                <textarea class="w-100" name="iformacion" rows="4" maxlength="1000" placeholder="Información..." required></textarea>
                {{-- INFORMACIÓN DEL EQUIPO --}}
                <textarea class="w-100" name="informaciondelequipo" rows="4" maxlength="1000" placeholder="Información del equipo..." required></textarea>
                <div class="row">
                    <div class="col">
                        {{-- IMAGEN 1 --}}
                        <div class="text-center">
                            <label for="urlimagen1" style="cursor:pointer;">
                                <img src="{{asset('img/logo-preview.png')}}" class="foto-perfil-preview" id="frameimagen1">
                                <br>
                                <u>Subir imagen 1</u>
                            </label>
                            <input class="form-control" type="file" id="urlimagen1" name="urlimagen1" onchange="previewimagen1()" hidden>
                        </div>
                    </div>
                    <div class="col">
                        {{-- IMAGEN 2 --}}
                        <div class="text-center">
                            <label for="urlimagen2" style="cursor:pointer;">
                                <img src="{{asset('img/logo-preview.png')}}" class="foto-perfil-preview" id="frameimagen2">
                                <br>
                                <u>Subir imagen 2</u>
                            </label>
                            <input class="form-control" type="file" id="urlimagen2" name="urlimagen2" onchange="previewimagen2()" hidden>
                        </div>
                    </div>
                </div>
                Título servicio 1
                <div class="input-group mb-1">
                    <input class="form-control" type="text" name="tituloservicio1" required>
                </div>
                {{-- DESCRIPCIÓN SERVICIO 1 --}}
                <textarea class="w-100" name="descripcionservicio1" rows="4" maxlength="800" placeholder="Descripción del servicio 1..."></textarea>
                Título servicio 2
                <div class="input-group mb-1">
                    <input class="form-control" type="text" name="tituloservicio2" required>
                </div>
                {{-- DESCRIPCIÓN SERVICIO 2 --}}
                <textarea class="w-100" name="descripcionservicio2" rows="4" maxlength="800" placeholder="Descripción del servicio 2..."></textarea>
                Título servicio 3
                <div class="input-group mb-1">
                    <input class="form-control" type="text" name="tituloservicio3" required>
                </div>
                {{-- DESCRIPCIÓN SERVICIO 3 --}}
                <textarea class="w-100" name="descripcionservicio3" rows="4" maxlength="800" placeholder="Descripción del servicio 3..."></textarea>
                <div class="row">
                    <div class="col">
                        URL Facebook
                    </div>
                    <div class="col">
                        URL Instagram
                    </div>
                </div>
                <div class="input-group mb-1">
                    <input class="form-control" type="text" name="urlfacebook" required>
                    <input class="form-control" type="text" name="urlinstagram" required>
                </div>
                <div class="row">
                    <div class="col">
                        Teléfono
                    </div>
                    <div class="col">
                        Correo
                    </div>
                </div>
                <div class="input-group mb-1">
                    <input class="form-control" type="text" name="telefono" required>
                    <input class="form-control" type="text" name="correo" required>
                </div>
                Dirección
                <div class="input-group mb-1">
                    <input class="form-control" type="text" name="direccion" required>
                </div>
                <br>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Crear Website</button>
                </div>
            </form>
        </div>
    </div>
@endhasrole
</div>
<br>
<!-- Aparecer Formularios -->
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
{{-- PORTADA --}}
<script>
    function previewportada(){
        frameportada.src = URL.createObjectURL(event.target.files[0]);
    }
    function clearImage(){
        document.getElementById('formFile').value = null;
        frameportada.src = "";
    }
</script>
{{-- LOGO --}}
<script>
    function previewlogo(){
        framelogo.src = URL.createObjectURL(event.target.files[0]);
    }
    function clearImage(){
        document.getElementById('formFile').value = null;
        framelogo.src = "";
    }
</script>
{{-- IMAGEN 1 --}}
<script>
    function previewimagen1(){
        frameimagen1.src = URL.createObjectURL(event.target.files[0]);
    }
    function clearImage(){
        document.getElementById('formFile').value = null;
        frameimagen1.src = "";
    }
</script>
{{-- IMAGEN 2 --}}
<script>
    function previewimagen2(){
        frameimagen2.src = URL.createObjectURL(event.target.files[0]);
    }
    function clearImage(){
        document.getElementById('formFile').value = null;
        frameimagen2.src = "";
    }
</script>
@endsection