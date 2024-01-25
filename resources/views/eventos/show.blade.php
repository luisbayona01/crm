@extends('layouts.plantilla')
@section('content')
<!-- Begin Page Content -->
<div class="container-xl">          
    <!-- Form Example -->
    <div class="card shadow mb-4">
        <div class="card-body bg-gray-100">
            <div class="table-responsive">
                <div class="form-group">
                    <h3 class="text-gray-900">
                        {{$evento->nombre}}
                    </h3>
                    <label>{{ \Carbon\Carbon::parse($evento->fecha)->locale('es_ES')->isoFormat('D MMMM YYYY h:mm A') }}</label>
                    <br>
                    <img src="{{asset(str_replace('public', 'storage', $evento->urlimagen))}}" width="100%">
                    <br>
                    <p class="text-gray-900" style="white-space:pre-line;">
                        {{$evento->descripcion}}
                    </p>
                    <h5 class="text-gray-900">
                        <b>Fecha y Hora:</b>
                        {{ \Carbon\Carbon::parse($evento->fecha)->locale('es_ES')->isoFormat('D MMMM YYYY h:mm A') }}
                    </h5>
                    <h5 class="text-gray-900">
                        <b>Ingresa directamente en el siguiente enlace:</b>
                        <a href="{{$evento->urldeacceso}}" target="_bank">{{$evento->urldeacceso}}</a>
                    </h5>
                    <h5 class="text-gray-900">
                        <b>Facebook Live:</b>
                        <a href="https://www.facebook.com/intreasso" target="_bank">https://www.facebook.com/intreasso</a>
                    </h5>
                    <h5 class="text-gray-900">
                        <b>Categoría del Evento:</b>
                        {{$evento->tipo}}
                    </h5>
                    <div class="text-center">
                        <a href="https://www.google.com/calendar/event?action=TEMPLATE&amp;dates=20231201T110000/20231201T120000&amp;text=CAPACITACI%C3%93N%20%26%238211%3B%20intREasso&amp;details=CAPACITACI%C3%93N+-+Ingresa+con+el+siguiente+enlace%3A+%3Ca+href%3D%22https%3A%2F%2Fwww.facebook.com%2Fintreasso%22+target%3D%22_blank%22+rel%3D%22noopener%22%3Ehttps%3A%2F%2Fwww.facebook.com%2Fintreasso%3C%2Fa%3E&amp;location=Virtual%20por%20Facebook.com/intREasso&amp;trp=false&amp;ctz=America/New_York&amp;sprop=website:https://www.intreasso.org" class="tribe-events-c-subscribe-dropdown__list-item-link btn btn-amarillo" target="_blank" rel="noopener noreferrer nofollow noindex">
                            Agregar a mi Google Calendar	
                        </a>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@role('admin')
<div class="container">
    <div class="row">
        <div class="col">
            <a href="{{route('eventos.edit', $evento)}}"  class="btn btn-primary btn-lg btn-block">Editar Evento</a>
        </div>
        <div class="col">
            <form action="{{route('eventos.destroy', $evento)}}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-lg btn-block">Eliminar Evento</button>
            </form>
        </div>
    </div>
</div>
@endrole 
<br><br>
@endsection
