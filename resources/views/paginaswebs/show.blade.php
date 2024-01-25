@extends('layouts.plantilla')
@section('content')
@if(auth()->check())
@hasrole('afiliado|admin')
<div class="row justify-content-center">
<a href="{{route('paginaswebs.edit', $paginaweb)}}" class="btn btn-primary">
  Editar
</a>
</div>
@endhasrole
{{-- @else --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light menu-paginaweb">
    <div class="container-fluid">
        <a href="#"><img src="{{asset(str_replace('public', 'storage', $paginaweb->urllogo))}}" width="30"></a>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#quienessomos">Quénes Somos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#equipo">Equipo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#contactanos">Contáctanos</a>
            </li>
          </ul>
        </div>
        <a href="#propiedades" class="btn btn-primary d-none d-sm-table-cell">
          Propiedades
        </a>
        <!-- Dropdown - Menú Movil -->
        <button class="navbar-toggler" type="button" id="paginamenumovil" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="paginamenumovil">
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                Inicio
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#quienessomos">
                Quénes Somos
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#equipo">
                Equipo
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#contactanos">
                Contáctanos
            </a>
        </div>
    </div>
</nav>
@endif
<div class="main-section text-center" style="border:0px;border-radius:0px;">
    <!-- Profile Header -->
    <style>
        .profile-header {
            background-image: url('{{asset(str_replace('public', 'storage', $paginaweb->urlportada))}}');
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0 auto;
            height:520px
        }
    </style>
    <div class="row align-items-center profile-header">
        <div class="col container-768">
            <h1>{{$paginaweb->titulo}}</h1>
            <h3>{{$paginaweb->slogan}}</h3>
        </div>
    </div>
</div>
<br>
<div class="container container-lg">
    <div class="row justify-content-center text-center">
        <h4>Servicios de nuestros agentes</h4>
    </div>
    <br>
    {{-- SERVICIOS --}}
    <div class="row justify-content-center text-center">
        <div class="col-12 col-md">
            <div class="card shadow">
                <div class="card-body">
                    <h4><b>{{$paginaweb->tituloservicio1}}</b></h4>
                    <h5>{{$paginaweb->descripcionservicio1}}</h5>
                </div>
            </div>
            <br>
        </div>
        <div class="col-12 col-md">
            <div class="card shadow">
                <div class="card-body">
                    <h4><b>{{$paginaweb->tituloservicio2}}</b></h4>
                    <h5>{{$paginaweb->descripcionservicio2}}</h5>
                </div>
            </div>
            <br>
        </div>
        <div class="col-12 col-md">
            <div class="card shadow">
                <div class="card-body">
                    <h4><b>{{$paginaweb->tituloservicio3}}</b></h4>
                    <h5>{{$paginaweb->descripcionservicio3}}</h5>
                </div>
            </div>
            <br>
        </div>
    </div>
    <br><br><br><br>
    {{-- QUIÉNES SOMOS --}}
    <div id="quienessomos" class="row justify-content-center text-center">
        <div class="col-12">
            <h3>QUIÉNES SOMOS</h3>
            <br>
            <h5>{{$paginaweb->quienessomos}}</h5>
            <br><br>   
        </div>
        <div class="col-12 col-md-6">
            <img src="{{asset(str_replace('public', 'storage', $paginaweb->urllogo))}}" width="100%">
            <br><br>
        </div>
        <div class="col-12 col-md-6">
            <img src="{{asset(str_replace('public', 'storage', $paginaweb->urllogo))}}" width="100%">
            <br><br>
        </div>
        <div class="col-12 col-md-6">
            <h3><b>Misión</b></h3>
            <h5 class="text-justify">{{$paginaweb->mision}}</h5>
            <br> 
        </div>
        <div class="col-12 col-md-6">
            <h3><b>Visión</b></h3>
            <h5 class="text-justify">{{$paginaweb->vision}}</h5>
            <br> 
        </div>
        <div class="col-12">
            <a href="#contactanos" class="btn btn-primary">CONTÁCTANOS</a>
        </div>
    </div>
    <br><br><br><br>
    {{-- PROPIEDADES --}}
    {{-- <div id="propiedades" class="row justify-content-center text-center">
        <div class="col-12 col-md">
            PROPIEDADES
            <br>
        </div>
    </div> --}}
    {{-- NUESTRO EQUIPO --}}
    <div id="equipo" class="row justify-content-center text-center">
        <div class="col-12 col-md">
            <h3>NUESTRO EQUIPO</h3>
            <br>
            <h5>{{$paginaweb->informaciondelequipo}}</h5>
            <br>
        </div>
    </div>
    <br><br><br><br>
    <div class="dropdown-divider"></div>
    <br>
    {{-- CONTÁCTANOS --}}
    <div id="contactanos" class="row justify-content-center">
        <div class="col-12 col-md-6">
            <h5>Datos de contacto</h5>
            <br>
            <h6 class="text-justify"><i class="fas fa-phone-alt"></i>&nbsp; <b>{{$paginaweb->telefono}}</b></h6>
            <h6 class="text-justify"><i class="fas fa-mail-bulk"></i>&nbsp; <b>{{$paginaweb->correo}}</b></h6>
            <h6 class="text-justify"><i class="fas fa-phone-alt"></i>&nbsp; <b>{{$paginaweb->direccion}}</b></h6>        
            <br> 
        </div>
        <div class="col-12 col-md-6">
            <h5>Síguenos</h5>
            <br>
            <h5>
                <a href="{{$paginaweb->urlfacebook}}" target="_blank"><i class="fab fa-facebook-square"></i></a>&nbsp;
                <a href="{{$paginaweb->urlinstagram}}" target="_blank"><i class="fab fa-instagram"></i></a>&nbsp;
            </h5>
        </div>
    </div>
    <div class="dropdown-divider"></div>
    {{-- FOOTER --}}
    <div id="contactanos" class="row justify-content-center text-center">
        <div class="col-12 col-md-6">
            <h6>{{$paginaweb->titulo}} ©  {{date('Y')}} | <a href="https://www.intreasso.org/" target="_blank" class="text-amarillo">intREasso</a></h6>
        </div>
    </div>
</div>
@endsection