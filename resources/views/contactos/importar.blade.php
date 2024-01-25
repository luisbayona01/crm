@extends('layouts.plantilla')
@section('title', 'Importar Contactos')
@section('content')
<!-- Begin Page Content -->
<div class="container-xl container-520"> 
    <form action="{{route('users.import.excel')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button>Agregar contactos</button>
    </form>
</div>
@endsection