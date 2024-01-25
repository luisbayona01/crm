@extends('layouts.app')

@section('template_title')
    {{ $message->name ?? "{{ __('Show') Message" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Message</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('messages.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $message->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Room Id:</strong>
                            {{ $message->room_id }}
                        </div>
                        <div class="form-group">
                            <strong>Content:</strong>
                            {{ $message->content }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
