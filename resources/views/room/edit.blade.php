@extends('layouts.plantilla')

@section('template_title')
    {{ __('Update') }} Room
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Room users</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('rooms.update') }}"  role="form" enctype="multipart/form-data">

                            @csrf

                            @include('room.formEdit')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
