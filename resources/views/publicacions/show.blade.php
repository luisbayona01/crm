@extends('layouts.plantilla')
@section('content')
<!-- Begin Page Content -->
<div class="container-xl container-520">          
    <!-- Form Example -->
    <div class="card shadow mb-4 bg-gray-100 text-gray-900">
        <img src="{{ asset(str_replace('public', 'storage', $publicacion->urlimagen)) }}" class="card-img-top" alt="...">
        <div class="card-body">
            <a class="text-gray-900" href="{{route('contactanos.index')}}">
                <img src="{{ asset(str_replace('public', 'storage', Auth::user()->urlfotoperfil)) }}" width="40" height="40" class="rounded-circle">
            </a>
            &nbsp;
            <label class="card-title h5">
                <a class="text-gray-900" href="{{route('usuarios.show', $publicacion->user)}}">
                    {{ $publicacion->user ? $publicacion->user->name : '.' }} <i class="fas fa-check-circle" style="font-size: 16px;"></i>
                </a>
                <br>
                <small class="text-muted">{{$publicacion->updated_at->format('d M Y')}}</small>
                <a class="text-gray-900 active" href="{{route('contactanos.index')}}">
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
                    <a class="dropdown-item bg-gray-100 text-gray-900" href="{{route('contactanos.index')}}" data-toggle="modal" data-target="#filtromodal">
                        <i class="fa fa-dollar-sign"></i>
                        {{$publicacion->precio}}
                    </a>
                </div>
                <div class="col">
                    <a class="dropdown-item bg-gray-100 text-gray-900" href="{{route('contactanos.index')}}" data-toggle="modal" data-target="#filtromodal">
                        <i class="fas fa-percent"></i>
                        {{$publicacion->comision}}
                    </a>
                </div>
                @hasrole('afiliado|admin')
                <div class="col">
                    <a class="dropdown-item bg-gray-100 text-gray-900 active" href="{{route('contactanos.index')}}">
                        <i class="far fa-comment-alt"></i>
                        Contactar agente
                    </a>
                </div>
                @endhasrole
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@role('admin')
<div class="container">
    <div class="row">
        <div class="col">
            <a href="{{route('publicacions.edit', $publicacion)}}"  class="btn btn-primary btn-lg btn-block">Editar Publicación</a>
        </div>
        <div class="col">
            <form action="{{route('publicacions.destroy', $publicacion)}}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-lg btn-block">Eliminar Publicación</button>
            </form>
        </div>
    </div>
</div>
@endrole 
<br><br>
@endsection
