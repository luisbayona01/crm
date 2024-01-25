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
  <form action="{{ route('index.contactosporsubetiqueta', ['subetiqueta' => request()->input('subetiqueta')]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="file" name="tu_archivo_excel" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
      <input type="hidden" name="subetiqueta" value="">
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

// Obtener el valor de la variable 'subetiqueta' de la URL anterior
var urlAnteriorParams = new URLSearchParams(urlAnterior.split('?')[1]);
var subetiqueta = urlAnteriorParams.get('subetiqueta');

// Asignar el valor de la variable 'subetiqueta' al valor del campo oculto
document.getElementsByName("subetiqueta")[0].value = subetiqueta;
</script>
    <style>
  input[type="file"] {
    font-family: Arial, sans-serif;
    font-size: 14px;
    color: #333;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 6px 12px;
    cursor: pointer;
  }
  button[type="submit"] {
    font-family: Arial, sans-serif;
    font-size: 14px;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 4px;
    padding: 6px 12px;
    cursor: pointer;
  }
  button[type="submit"]:hover {
    background-color: #0069d9;
  }
  </style>
@endsection
