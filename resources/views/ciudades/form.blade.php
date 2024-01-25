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
           //cargarCiudad(selectRegion);
            })
            .catch(error => console.error('Error:', error));
    }

</script>
<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('pais') }}
            {{ Form::select('', $listaDePaises, $idpais, ['class' => 'form-control' . ($errors->has('pais_id') ? ' is-invalid' : ''), 'id' => 'pais', 'placeholder' => 'Selecciona un país', 'onchange' => 'cargar(this)', 'required' => 'required']) }}
            <div class="invalid-feedback">el campo pais es obligatorio</div>
        </div>


 <div class="form-group">
                        {{ Form::label('region') }}
                        {{ Form::select('region', $listaDeRegiones, $ciudade->region, ['class' => 'form-control' . ($errors->has('region_id') ? ' is-invalid' : ''),'id' => 'region', 'placeholder' => 'Selecciona una región','required' => 'required']) }}
                   <div class="invalid-feedback">el campo region  es obligatorio</div>
                    </div>


        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $ciudade->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
          <div class="invalid-feedback">el campo nombre ciudad  es obligatorio</div>
        </div>


    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
