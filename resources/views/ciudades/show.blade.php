@extends('layouts.plantilla')

@section('template_title')
    {{ $ciudade->name ?? "{{ __('Show') Ciudade" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Ciudade</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ciudades.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $ciudade->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Region:</strong>
                            {{ $ciudade->region }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
