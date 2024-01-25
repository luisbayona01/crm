@extends('layouts.plantilla')
@section('content')
{{-- MODAL FILTRO --}}
<div class="modal fade" id="filtromodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">FILTROS DE BUSQUEDAD</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="{{ route('agentes.agentessearch') }}" method="GET" class="form-inline">
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <input class="form-control w-100" type="text" name="name" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <input class="form-control w-100" type="text" name="intreassonumber" placeholder="intREasso Number">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <input class="form-control w-100" type="mail" name="email" placeholder="Correo electrónico">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <select class="form-control w-100" name="pais">
                                        <option value="">Pais</option>
                                        @foreach ($paises as $pais)
                                            <option value="{{$pais->nombre}}">{{$pais->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br><br><br>
                        <button type="submit" class="btn btn-primary btn-lg btn-block" >Buscar</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>            
</div>
<div class="row">
    <div class="col d-none d-sm-table-cell">
        <h4>AGENTES INMOBILIARIOS INTERNACIONALES</h4>
    </div>
    <div class="col">
        <!-- BUSCADOR DE USUARIOS -->
        <form action="{{ route('agentes.agentessearch') }}" method="GET" class="justify-content-center md-form form-sm">
            <div class="input-group-append justify-content-center">
                <input class="form-control form-control-sm ml-3 w-75 rounded-pill" type="text" placeholder="Buscar usuario por nombre, teléfono, correo, país, ciudad..." aria-label="Search" name="query" id="search_input" value="{{ $query ?? '' }}">
                &nbsp;&nbsp;
                <a href="#" data-toggle="modal" data-target="#filtromodal" class="btn btn-primary">Filtro</a>
            </div>
        </form>
    </div>
</div>
<br>
<!-- USUARIOS -->
<div class="row text-center">
    <div class="col-12 text-center">
        @foreach ($paises as $pais)
            <a href="{{ url('agentes/search?name=&intreassonumber=&email=&pais='.$pais->nombre)}}">
                <img src="{{ asset(str_replace('public', 'storage', $pais->urlbandera)) }}" class="banderas-agentes" title="{{$pais->nombre}}">
            </a> 
        @endforeach
    </div>
    <br><br>
    @foreach ($users as $user)
        <div class="col-lg-4 col-md-6 col-sm-12">
            <!-- CARD -->
            <div class="card shadow mb-4">
                <div class="card-body bg-gray-100">
                    {{-- FOTO DE PERFIL --}}
                    <div class="text-center">
                        <a href="{{route('usuarios.show', $user)}}" class="text-gray-900">
                            <img src="{{ asset(str_replace('public', 'storage', $user->urlfotoperfil)) }}" class="rounded-circle foto-perfil-preview" id="framefotodeperfil">
                            <br>
                            <h4>
                                {{$user->name}} 
                                @if($user->intreassonumber)
                                <i class="fas fa-check-circle text-amarillo" style="font-size:18px;"></i>
                                @endif
                            </h4>
                        </a>
                        <h6>
                        <a href="mailto:{{$user->email}}" class="text-gray-900">
                            <i class="fas fa-mail-bulk"></i> {{$user->email}}
                        </a>
                        </h6>
                        <a href="tel:{{$user->telefono}}" class="text-gray-900">
                            <i class="fas fa-phone-alt"></i> {{$user->telefono}}
                        </a>
                        <br><br>
                        <hr class="sidebar-divider my-0">
                        <br>
                        <h5 class="text-gray-900">Reigión y Localidad:</h5>
                        <b class="text-gray-900">{{$user->region}}, {{$user->ciudad}}</b>
                        <br><br>
                        <h5 class="text-gray-900">País:</h5>
                        <b class="text-gray-900">{{$user->pais}}</b>
                        <br><br>
                        <a href="{{$user->paginaweb}}" target="_bank" class="btn btn-amarillo">
                            <h6>Visite nuestra página directamente</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="pagination-contactos text-center">
    {{ $users->links() }}
</div>
<br>
<script>
jQuery(document).ready(function() {
     $('.giverscore_tooltip').popover({
        trigger:'hover',
        content:'write a review, create a keyword, invite a friend, and more.',
        placement:'top'
    });
 });
</script>
@endsection
