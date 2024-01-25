<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $region->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre','required' => 'required']) }}
           <div class="invalid-feedback">el campo nombre de region es obligatorio</div>
        </div>
        <div class="form-group">
            {{ Form::label('pais') }}
              {{ Form::select('pais', $listaDePaises, $region->pais, ['class' => 'form-control' . ($errors->has('pais') ? ' is-invalid' : ''),'id' => 'pais', 'placeholder' => 'Selecciona un país','required' => 'required']) }}
             <div class="invalid-feedback">el campo pais  es obligatorio</div>
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
