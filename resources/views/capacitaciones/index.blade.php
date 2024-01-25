@extends('layouts.plantilla')
@section('content')
@hasrole('admin')
<div class="row">
    <div class="col">
        <h4>CAPACITACIONES</h4>           
    </div>
    <div class="col text-right">
        <a href="{{route('capacitaciones.create')}}" class="btn btn-primary">+ Agregar Capacitación</a>                  
    </div>
</div>
@endhasrole
<br>
<div class="container-768">
    <div class="row">
        <div class="col">
            <div class="embed-responsive embed-responsive-16by9">
                <video class="embed-responsive-item" src="{{$ultimaCapacitacion->urlvideo}}" controls controlsList="nodownload" allowfullscreen></video>
            </div>   
            <br>    
            <h3 class="text-center text-uppercase">
                @hasrole('admin')  
                    <a href="{{route('capacitaciones.edit', $ultimaCapacitacion)}}">{{$ultimaCapacitacion->titulo}}</a>  
                @else
                    {{$ultimaCapacitacion->titulo}}
                @endhasrole
            </h3>               
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <hr class="sidebar-divider my-0">
            <br>
            <h4 class="text-gray-800"><b>Capacitaciones Internacionales</b></h4>
            <br>
        </div>
        @foreach ($capacitaciones as $capacitacion)
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="embed-responsive embed-responsive-16by9">
                <video class="embed-responsive-item" src="{{$capacitacion->urlvideo}}" controls controlsList="nodownload" allowfullscreen></video>
            </div>   
            <h5 class="text-center text-uppercase mt-2">
                @hasrole('admin')  
                    <a href="{{route('capacitaciones.edit', $capacitacion)}}">{{$capacitacion->titulo}}</a>  
                @else
                    {{$capacitacion->titulo}}
                @endhasrole
            </h5>
            <br>      
        </div>
        @endforeach
    </div>
</div>
<div class="pagination-contactos text-center">
    {{ $capacitaciones->links() }}
</div>
<br>
@endsection