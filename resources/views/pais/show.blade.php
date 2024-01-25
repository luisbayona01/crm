@extends('layouts.plantilla')

@section('template_title')
    {{ $pai->name ?? "{{ __('Show') Pai" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Pai</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('paises.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Pais:</strong>
                            {{ $pai->pais }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
