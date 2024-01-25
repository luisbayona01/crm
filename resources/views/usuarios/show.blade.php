@extends('layouts.plantilla')
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
                <img src="{{asset(str_replace('public', 'storage', $user->urlfotoperfil))}}" width="100%">
            </div>
        </div>
    </div>            
</div>
{{-- MODAL CERTIFICADO --}}
<div class="modal fade" id="certificadomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-gray-900">
                <img src="{{asset(str_replace('public', 'storage', $user->urlfotoperfil))}}" width="100%">
                <br>
                <img src="{{asset(str_replace('public', 'storage', $user->urlfotoperfil))}}" width="100%">
            </div>
        </div>
    </div>            
</div>
<div class="main-section text-center">
    <!-- Profile Header -->
    <style>
        .profile-header {
            background-image: url('{{asset(str_replace('public', 'storage', $user->urlfotoportada))}}');
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0 auto;
            height: 250px;
        }
    </style>
    <div class="row profile-header"></div>
    <!-- User Detail Section -->
    <div class="row user-detail">
        <div class="col-lg-12">
            <label data-toggle="modal" data-target="#fotodeperfilmodal" style="cursor:pointer;">
                <img src="{{asset(str_replace('public', 'storage', $user->urlfotoperfil))}}" class="rounded-circle img-thumbnail">
            </label>
        </div>
        <div class="col-sm-4">
            <h4 class="text-gray-800">
                {{$user->name}} 
                @if($user->intreassonumber)
                <i class="fas fa-check-circle text-amarillo" style="font-size:18px;"></i>
                @endif
            </h4>
        </div>
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <a href="mailto:{{$user->email}}" class="text-gray-800">
                <h5><i class="fas fa-mail-bulk"></i> {{$user->email}}</h5>
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-4">
            <h5 class="text-gray-800">
                @if($user->intreassonumber)
                <a href="#" class="text-gray-800" data-toggle="modal" data-target="#certificadomodal" style="cursor:pointer;">
                    <b>{{$user->intreassonumber}}</b>
                </a>
                <br>
                <small class="text-gray-800" style="position:relative;top:-5px;">ACTIVE</small>
                @else
                INACTIVE
                @endif
            </h5>
        </div>
        <div class="col-sm-4"><h5 class="text-gray-800">{{$user->direccion}}, {{$user->pais}}</h5></div>
        <div class="col-sm-4">
            <a href="tel:{{$user->telefono}}" class="text-gray-800">
                <h5><i class="fas fa-phone-alt"></i> {{$user->telefono}}</h5>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4"></div>
        <div class="col-sm-4"></div>
    </div>
    <br>
</div>
<br>
<div class="container container-lg">
    <div class="row justify-content-center text-center">
        <h5>{{$user->descripcionperfil}}</h5>
    </div>
    <br>
    <div class="row justify-content-center text-center">
        <h4>VENTA - COMPRA - RENTA - INVERSIONES</h4>
    </div>
    <br>
    <div class="row justify-content-center">
        <a href="{{$user->paginaweb}}" target="_bank" class="btn btn-amarillo">
            <h5>Visite nuestra página directamente</h5>
        </a>
    </div>
    <br>
    <div class="row justify-content-center text-center container-320">
        <div class="col-6">
            <a href="{{$user->urlfacebook}}" target="_bank" class="btn btn-amarillo shadow-lg">
                <i class="fab fa-facebook boton-red-social-perfil"></i>
            </a>
        </div>
        <div class="col-6">
            <a href="{{$user->urlinstagram}}" target="_bank" class="btn btn-amarillo shadow-lg">
                <i class="fab fa-instagram boton-red-social-perfil"></i>
            </a>
        </div>
    </div>
    <br>
    <div class="row justify-content-center text-center container-320">
        <div class="col-6">
            <a href="tel:{{$user->telefono}}" target="_bank" class="btn btn-amarillo shadow-lg">
                <i class="fas fa-phone-alt boton-red-social-perfil"></i>
            </a>
        </div>
        <div class="col-6">
            <a href="mailto:{{$user->email}}" target="_bank" class="btn btn-amarillo shadow-lg">
                <i class="fas fa-mail-bulk boton-red-social-perfil"></i>
            </a>
        </div>
    </div>
    <br>
    <div class="row justify-content-center text-center container-320">
        <div class="col-6">
            <a href="https://api.whatsapp.com/send?phone={{substr($user->telefono, 1)}}&text=" target="_bank" class="btn btn-amarillo shadow-lg">
                <i class="fab fa-whatsapp boton-red-social-perfil"></i>
            </a>
        </div>
        <div class="col-6">
            <a href="https://www.google.com/maps/place/{{$user->direccion}}" target="_bank" class="btn btn-amarillo shadow-lg">
                <i class="fas fa-map-pin boton-red-social-perfil"></i>
            </a>
        </div>
    </div>
    <br><br>
    <div class="container-520">
        @if($publicacions->isEmpty())
            @else
            <h4 class="text-center">PUBLICACIONES</h4>
        @endif
        @foreach ($publicacions as $publicacion)
            <!-- PUBLICACIONES -->
            <div class="card shadow mb-4 bg-gray-100 text-gray-900">
                <img src="{{ asset(str_replace('public', 'storage', $publicacion->urlimagen)) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <a class="text-gray-900" href="{{route('contactanos.index')}}">
                        <img src="{{ asset(str_replace('public', 'storage', $publicacion->user ? $publicacion->user->urlfotoperfil : '.')) }}" width="40" height="40" class="rounded-circle">
                    </a>
                    &nbsp;
                    <label class="card-title h5">
                        <a class="text-gray-900" href="{{route('usuarios.show', $publicacion->user)}}">
                            {{ $publicacion->user ? $publicacion->user->name : '.' }} <i class="fas fa-check-circle text-amarillo" style="font-size: 16px;"></i>
                        </a>
                        <br>
                        <small class="text-muted">{{$publicacion->updated_at->format('d M Y')}}</small>
                        <a class="text-gray-900 active" href="/home/search?descripcion=&pais={{$publicacion->pais}}&precio=&comision=">
                            <small class="text-gray-900">{{$publicacion->pais}}</small>
                        </a>
                    </label>
                    <p class="card-text more-text">
                        {{$publicacion->descripcion}}
                    </p>
                    <br>
                    <hr class="sidebar-divider my-0">
                    <!-- INTERACCIONES -->
                    <div class="row text-center">
                        <div class="col">
                            <a class="dropdown-item bg-gray-100 text-gray-900">
                                <i class="fa fa-dollar-sign"></i>
                                {{$publicacion->precio}}
                            </a>
                        </div>
                        <div class="col">
                            <a class="dropdown-item bg-gray-100 text-gray-900">
                                <i class="fas fa-percent"></i>
                                {{$publicacion->comision}}
                            </a>
                        </div>
                        @hasrole('afiliado|admin')
                        @if(Auth::user()->id == $publicacion->userid)
                            <div class="col">
                                <a class="dropdown-item bg-gray-100 text-gray-900 active" href="{{route('publicacions.edit', $publicacion)}}">
                                    <i class="far fa-edit"></i>
                                    Editar
                                </a>
                            </div>
                        @endif
                        @endhasrole
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<br><br>
@endsection