@extends('layouts.plantilla')

@section('template_title')
    {{ __('Update') }} Propiedad
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Propiedad</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('propiedades.update', $propiedad->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('propiedad.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
