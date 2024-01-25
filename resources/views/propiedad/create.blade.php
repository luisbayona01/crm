@extends('layouts.plantilla')
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                
                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        Agregar propiedad
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('propiedades.store') }}"  role="form" enctype="multipart/form-data" id="CreateP" class="needs-validation" novalidate>
                            @csrf
                            @include('propiedad.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script>
    // Espera a que el DOM esté listo
    document.addEventListener('DOMContentLoaded', function () {
    console.log('aaaaa');

    var forms = document.querySelectorAll('#CreateP');

    forms.forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    });
});
</script>
@endsection
