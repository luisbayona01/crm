@extends('layouts.plantilla')
@section('content')
    <!-- Content Row 1 -->
    <div class="row">
        <!-- User name Card Example -->
        <div class="col-xl-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-gray-100">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="m-0 font-weight-bold text-gray-900">Importar</h6>
                        </div>
                        <div class="col-sm-6 text-right">
                    
                        </div>
                    </div>
                </div>
                <div class="card-body bg-gray-100">
                    <div class="table-responsive">
                    <div class="formcontacto">
  <form action="{{ route('index.contactosgoogleporetiqueta', ['etiqueta' => request()->input('etiqueta')]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="file" name="tu_archivo_excel" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
      <input type="hidden" name="etiqueta" value="">
      <button type="submit">Importar Contactos</button>
  </form>
</div>

                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <script>
// Obtener la URL anterior
var urlAnterior = document.referrer;

// Obtener el valor de la variable 'etiqueta' de la URL anterior
var urlAnteriorParams = new URLSearchParams(urlAnterior.split('?')[1]);
var etiqueta = urlAnteriorParams.get('etiqueta');

// Asignar el valor de la variable 'etiqueta' al valor del campo oculto
document.getElementsByName("etiqueta")[0].value = etiqueta;
</script>
    <style>
  input[type="file"] {
    font-family: Arial, sans-serif;
    font-size: 16px;
    color: #fff;
    background-color: #4CAF50;
    padding: 10px 20px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
  }

  button[type="submit"] {
    font-family: Arial, sans-serif;
    font-size: 16px;
    color: #fff;
    background-color: #4CAF50;
    padding: 10px 20px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
  }

  .formcontacto {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
</style>
@endsection