@extends('layouts.plantilla')
@section('content')
<script>
    function cargar(selectPais) {
        var paisId = selectPais.value;

        // Hacer la solicitud AJAX
        fetch(`/get-regiones/${paisId}`).then(response => response.json()).then(regiones => {
                // Obtener el select de region
                var selectRegion = document.getElementById('region');

                // Limpiar las opciones actuales
                selectRegion.innerHTML = '';

                // Agregar la opción predeterminada
                var defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.text = 'Selecciona una región';
                selectRegion.add(defaultOption);

                // Agregar las nuevas opciones
                for (const [id, nombre] of Object.entries(regiones)) {
                    var option = document.createElement('option');
                    option.value = id;
                    option.text = nombre;
                    selectRegion.add(option);
                }

                // cargarCiudad(selectRegion);
        }).catch(error => console.error('Error:', error));
    }
</script>
    <div class="container">
        <!-- Inicio del contenedor principal -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="row">
            <!-- Inicio de la fila -->
            <div class="col text-right">
                <a href="{{ route('paises.index') }}" class="btn btn-primary btn-sm">Países</a>
                <a href="{{ route('regiones.index') }}" class="btn btn-primary btn-sm">Regiones</a>
                <a href="{{ route('ciudades.index') }}" class="btn btn-primary btn-sm">Ciudades</a>
                <a href="{{ route('categorias.index') }}" class="btn btn-primary btn-sm">Categorías</a>
                <a href="{{ route('propiedades.index') }}" class="btn btn-primary btn-sm">Mis propiedades</a>
                <a href="{{ route('propiedades.create') }}" class="btn btn-primary btn-sm">+ Agregar nueva propiedad</a>
            </div>
        </div>
        <br>
        <form action="{{ route('propiedades.index') }}" method="GET">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        País
                        {{ Form::select('pais_id', $listaDePaises,'', ['class' => 'form-control' . ($errors->has('pais_id') ? ' is-invalid' : ''),'id' => 'pais', 'placeholder' => 'Selecciona un país','onchange' => 'cargar(this)']) }}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        Región
                        <select class="form-control" id="region" name="region_id">
                            <option selected="selected" value="">Selecciona una región</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        Categoría
                        {{ Form::select('categoria_id', $categorias, '', ['class' => 'form-control', 'placeholder' => 'Seleccione una categoría']) }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        Estado
                        {{ Form::select('estado', $opcionesEstado, null, ['class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : ''), 'id' => 'estado', 'placeholder' => 'Selecciona un estado']) }}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        Título / Precio
                        <input type="text" name="precio-titulo" class="form-control"  placeholder="buscar por título o  precio..." >
                    </div>
                </div>
                <div class="col-sm-4">
                    Haz clic en
                    <button type="submit" class="btn btn-amarillo btn-block">Buscar</button>
                </div>
            </div>
        </form>
        <!-- Fin de la fila -->
    </div>
    <br>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($propiedad as $propiedades)
                <div class="col">
                    <div class="card h-100">
                        <img src= "{{url('').'/'.$propiedades->galeriaImagenes}}"class="card-img-top" alt="...">
                        <form action="{{ route('propiedades.destroy', $propiedades->id) }}" method="POST">
                            <a class="btn btn-sm btn-success" href="{{ route('propiedades.edit', $propiedades->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i>{{ __('Delete') }}</button>
                        </form>
                        <div class="card-body">
                            <h5 class="card-title">{{ $propiedades->titulo }}</h5>
                            <div class="form-group">
                                <h3>Valor de la propiedad </h3>
                                <p style="font-weight: 700;font-size: 30Px;color: black;">{{ '$' . $propiedades->precio }}</p>
                            </div>
                            <div class="card-footer">
                                <a class="btn btn-success" href="{{ route('propiedades.show', $propiedades->id) }}">ver más..</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {!! $propiedad->links() !!}
        </div>
    </div>
    <br>
@endsection