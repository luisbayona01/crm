<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('idroom') }}
            {{ Form::text('idroom', $roomUser->idroom, ['class' => 'form-control' . ($errors->has('idroom') ? ' is-invalid' : ''), 'placeholder' => 'Idroom']) }}
            {!! $errors->first('idroom', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('iduser') }}
            {{ Form::text('iduser', $roomUser->iduser, ['class' => 'form-control' . ($errors->has('iduser') ? ' is-invalid' : ''), 'placeholder' => 'Iduser']) }}
            {!! $errors->first('iduser', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>