<div class="box box-info padding-1">
    <div class="box-body">




        <div class="form-group">
         {{ Form::label('sala', 'Seleccione una sala') }}


{{ Form::select('idroom', $rooms, null, ['class' => 'form-control', 'id' => 'select-sala','placeholder'=>'seleccione  una sala']) }}

        </div>

  <div class="form-group">
{{ Form::label('usuarios', 'Usuarios') }}
<select name="iduser[]" class="form-control" id="usuarios" multiple>

</select>


<div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
