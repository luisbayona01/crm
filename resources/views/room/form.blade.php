<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $room->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>

  <div class="form-group">

{{ Form::label('usuarios', 'usuarios') }}
{{ Form::select('usuarios[]', $usuarios , $room->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''),'id'=>'user-salas','required'=>'required', 'multiple' => true]) }}
{!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
<div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
