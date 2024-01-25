<script>
    function cargar(selectPais) {
        var paisId = selectPais.value;

        // Hacer la solicitud AJAX
        fetch(`/get-regiones/${paisId}`)
            .then(response => response.json())
            .then(regiones => {
                // Obtener el select de region
                var selectRegion = document.getElementById('region');

                // Limpiar las opciones actuales
                selectRegion.innerHTML = '';

                // Agregar las nuevas opciones
                for (const [id, nombre] of Object.entries(regiones)) {
                    var option = document.createElement('option');
                    option.value = id;
                    option.text = nombre;
                    selectRegion.add(option);
                }
           cargarCiudad(selectRegion);
            })
            .catch(error => console.error('Error:', error));
    }

 function cargarCiudad(selectRegion) {
     var regionId = selectRegion.value;

        // Hacer la solicitud AJAX
        fetch(`/get-ciudad/${regionId}`)
            .then(response => response.json())
            .then(ciudades => {
                // Obtener el select de ciudad
                var selectciudad = document.getElementById('ciudad');

                // Limpiar las opciones actuales
                selectciudad.innerHTML = '';

                // Agregar las nuevas opciones
                for (const [id, nombre] of Object.entries(ciudades)) {
                    var option = document.createElement('option');
                    option.value = id;
                    option.text = nombre;
                    selectciudad.add(option);
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>

<div class="box box-info padding-1">
    <div class="box-body">


        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('categoria_id', 'Categoria') }}
                    {{ Form::select('categoria_id', $categorias, $propiedad->categoria_id, ['class' => 'form-control' . ($errors->has('categoria_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una categoría','required' => 'required']) }}
             <div class="invalid-feedback">el campo actegoria  es obligatorio</div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('titulo') }}
                    {{ Form::text('titulo', $propiedad->titulo, ['class' => 'form-control' . ($errors->has('Titulo') ? ' is-invalid' : ''), 'placeholder' => 'titulo','required' => 'required']) }}
                  <div class="invalid-feedback">el campo titulo  es obligatorio</div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('descripcion') }}
                    {{ Form::text('descripcion', $propiedad->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion','required' => 'required']) }}
                   <div class="invalid-feedback">el campo descripcion  es obligatorio</div>
                </div>
            </div>


        </div>

        <!-- Repite el mismo patrón para los siguientes campos -->

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('precio') }}
                    {{ Form::text('precio', $propiedad->precio, ['class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio','required' => 'required']) }}
                   <div class="invalid-feedback">el campo precio  es obligatorio</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <div class="form-group">
                        {{ Form::label('pais') }}


                        {{ Form::select('pais_id', $listaDePaises, $idpais, ['class' => 'form-control' . ($errors->has('pais_id') ? ' is-invalid' : ''),'id' => 'pais', 'placeholder' => 'Selecciona un país','onchange' => 'cargar(this)','required' => 'required']) }}
                       <div class="invalid-feedback">el campo pais  es obligatorio</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <div class="form-group">
                        {{ Form::label('region') }}
                        {{ Form::select('region_id', $listaDeRegiones, $idregion, ['class' => 'form-control' . ($errors->has('region_id') ? ' is-invalid' : ''),'id' => 'region', 'placeholder' => 'Selecciona una región','onchange' => 'cargarCiudad(this)','required' => 'required']) }}
                   <div class="invalid-feedback">el campo region  es obligatorio</div>
                    </div>
                </div>
            </div>





        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('ciudad') }}
                    {{ Form::select('ciudad', $listaDeCiudades, $propiedad->ciudad, ['class' => 'form-control' . ($errors->has('ciudad') ? ' is-invalid' : ''), 'id' => 'ciudad','placeholder' => 'Selecciona una ciudad','required' => 'required']) }}
                    <div class="invalid-feedback">el ciudad titulo  es obligatorio</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                   <div class="form-group">
    {{ Form::label('galeriaImagenes') }}
    {{ Form::file('galeriaImagenes', ['class' => 'form-control-file' . ($errors->has('galeriaImagenes') ? ' is-invalid' : '')]) }}
  <div class="invalid-feedback">seleccione  una imagen  </div>
</div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('urlvideo') }}
                    {{ Form::text('urlvideo', $propiedad->urlvideo, ['class' => 'form-control' . ($errors->has('urlvideo') ? ' is-invalid' : ''), 'placeholder' => 'Urlvideo','required' => 'required']) }}
                 <div class="invalid-feedback">el campovideo  es obligatorio</div>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('direccion') }}
                    {{ Form::text('direccion', $propiedad->direccion, ['class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => 'Direccion','required' => 'required']) }}
                   <div class="invalid-feedback">el campo  direccion  es obligatorio</div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('codigoPostal') }}
                    {{ Form::text('codigoPostal', $propiedad->codigoPostal, ['class' => 'form-control' . ($errors->has('codigoPostal') ? ' is-invalid' : ''), 'placeholder' => 'Codigopostal','required' => 'required']) }}
                    <div class="invalid-feedback">el campo  codigoPostal  es obligatorio</div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('metroscuadradosconstruccion') }}
                    {{ Form::text('metroscuadradosconstruccion', $propiedad->metroscuadradosconstruccion, ['class' => 'form-control' . ($errors->has('metroscuadradosconstruccion') ? ' is-invalid' : ''), 'placeholder' => 'Metroscuadradosconstruccion','required' => 'required']) }}
                   <div class="invalid-feedback">el campo  metros  construidos  es obligatorio</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('metroscuadradostotal') }}
                    {{ Form::number('metroscuadradostotal', $propiedad->metroscuadradostotal, ['class' => 'form-control' . ($errors->has('metroscuadradostotal') ? ' is-invalid' : ''), 'placeholder' => 'Metroscuadradostotal','required' => 'required']) }}
                    <div class="invalid-feedback">el campo metros total de area  es obligatorio</div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('baños') }}
                    {{ Form::number('banos', $propiedad->banos, ['class' => 'form-control' . ($errors->has('banos') ? ' is-invalid' : ''), 'placeholder' => 'Banos','required' => 'required']) }}
                   <div class="invalid-feedback">el campo baños  es obligatorio</div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('habitaciones') }}
                    {{ Form::number('habitaciones', $propiedad->habitaciones, ['class' => 'form-control' . ($errors->has('habitaciones') ? ' is-invalid' : ''), 'placeholder' => 'Habitaciones','required' => 'required']) }}
                   <div class="invalid-feedback">el campo habitaciones  es obligatorio</div>
                </div>
            </div>
        </div>
        <div class="row">


            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('garages') }}
                    {{ Form::number('garages', $propiedad->garages, ['class' => 'form-control' . ($errors->has('garages') ? ' is-invalid' : ''), 'placeholder' => 'Garages','required' => 'required']) }}
                     <div class="invalid-feedback">el campo garages  es obligatorio</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('estado') }}
                    {{ Form::select('estado',$opcionesEstado, $propiedad->estado, ['class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : ''), 'placeholder' => 'Selecione un Estado','required' => 'required']) }}
                    {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('refrigeracion') }}
                    <div class="form-check">
                        {{ Form::hidden('refrigeracion', 0) }}
                        {{ Form::checkbox('refrigeracion', 1, $propiedad->refrigeracion, ['class' => 'form-check-input' . ($errors->has('refrigeracion') ? ' is-invalid' : '')]) }}
                        {{ Form::label('refrigeracion', 'Yes', ['class' => 'form-check-label']) }}
                    </div>
                    {!! $errors->first('refrigeracion', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('calefaccion') }}
                    <div class="form-check">
                        {{ Form::hidden('calefaccion', 0) }}
                        {{ Form::checkbox('calefaccion', 1, $propiedad->calefaccion, ['class' => 'form-check-input' . ($errors->has('calefaccion') ? ' is-invalid' : '')]) }}
                        {{ Form::label('calefaccion', 'Yes', ['class' => 'form-check-label']) }}
                    </div>
                    {!! $errors->first('calefaccion', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('parqueadero') }}
                    <div class="form-check">
                        {{ Form::hidden('parqueadero', 0) }}
                        {{ Form::checkbox('parqueadero', 1, $propiedad->parqueadero, ['class' => 'form-check-input' . ($errors->has('parqueadero') ? ' is-invalid' : '')]) }}
                        {{ Form::label('parqueadero', 'Yes', ['class' => 'form-check-label']) }}
                    </div>
                    {!! $errors->first('parqueadero', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('seguridad') }}
                    <div class="form-check">
                        {{ Form::hidden('seguridad', 0) }}
                        {{ Form::checkbox('seguridad', 1, $propiedad->seguridad, ['class' => 'form-check-input' . ($errors->has('seguridad') ? ' is-invalid' : '')]) }}
                        {{ Form::label('seguridad', 'Yes', ['class' => 'form-check-label']) }}
                    </div>
                    {!! $errors->first('seguridad', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('año construccion') }}
                    {{ Form::text('anoconstruccion', $propiedad->anoconstruccion, ['class' => 'form-control' . ($errors->has('anoconstruccion') ? ' is-invalid' : ''), 'placeholder' => 'Anoconstruccion','required' => 'required']) }}
                     <div class="invalid-feedback">el campo año construccion  es obligatorio</div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('piscina') }}
                    <div class="form-check">
                        {{ Form::hidden('piscina', 0) }}
                        {{ Form::checkbox('piscina', 1, $propiedad->piscina, ['class' => 'form-check-input' . ($errors->has('piscina') ? ' is-invalid' : '')]) }}
                        {{ Form::label('piscina', 'Yes', ['class' => 'form-check-label']) }}
                    </div>
                    {!! $errors->first('piscina', '<div class="invalid-feedback">:message</div>') !!}


                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('nombre contacto') }}
                    {{ Form::text('contactonombre', $propiedad->contactonombre, ['class' => 'form-control' . ($errors->has('contactonombre') ? ' is-invalid' : ''), 'placeholder' => 'Contactonombre','required' => 'required']) }}
                   <div class="invalid-feedback">el campo nombre de contacto  es obligatorio</div>
                </div>

            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('contactoemail') }}
                    {{ Form::email('contactoemail', $propiedad->contactoemail, ['class' => 'form-control' . ($errors->has('contactoemail') ? ' is-invalid' : ''), 'placeholder' => 'Contactoemail','required' => 'required']) }}
                    <div class="invalid-feedback">el campo email   es obligatorio</div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('contactotelefono') }}
                    {{ Form::text('contactotelefono', $propiedad->contactotelefono, ['class' => 'form-control' . ($errors->has('contactotelefono') ? ' is-invalid' : ''), 'placeholder' => 'Contactotelefono','required' => 'required']) }}
                   <div class="invalid-feedback">el campo contactotelefono   es obligatorio</div>
                </div>
            </div>
        </div>


    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
