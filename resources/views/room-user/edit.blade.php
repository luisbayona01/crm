@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Room User
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Room User</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('room-users.update', $roomUser->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('room-user.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
