@extends('layouts.app')

@section('template_title')
    {{ $roomUser->name ?? "{{ __('Show') Room User" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Room User</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('room-users.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Idroom:</strong>
                            {{ $roomUser->idroom }}
                        </div>
                        <div class="form-group">
                            <strong>Iduser:</strong>
                            {{ $roomUser->iduser }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
