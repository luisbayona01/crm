@extends('layouts.plantilla')
@section('title', 'intREasso')
@section('content')    
{{-- MODAL FILTRO --}}
<div class="modal fade" id="filtromodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">FILTROS DE BUSQUEDAD</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="{{ route('home.search') }}" method="GET" class="form-inline">
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-1">
                                    <input class="w-100" type="text" name="descripcion" placeholder="Palabra clave">
                                </div>
                            </div>
                            <div class="col-6">
                                <select class="w-100" name="pais">
                                    <option value="">Pais</option>
                                    @foreach ($paises as $pais)
                                        <option value="{{$pais->nombre}}">{{$pais->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <input class="w-100" type="text" name="precio" placeholder="precio máximo" oninput="formatNumber(this)">
                            </div>
                            <div class="col-6">
                                <input class="w-100" type="text" name="comision" placeholder="Comisión máxima">
                            </div>
                        </div>
                        <br><br><br>
                        <button type="submit" class="btn btn-primary btn-lg btn-block" >Buscar</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>            
</div>
@hasrole('afiliado|admin')
{{-- MODAL CREAR PUBLICACIÓN --}}
<div class="modal fade" id="crearpublicacionmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog container-520" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear publicación</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="{{ route('publicacions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card shadow mb-4 text-gray-900">
                            <input class="form-control w-100" type="text" name="userid" value="{{Auth::user()->id}}" required hidden>
                            <label for="urlimagen" class="cursor-pointer">
                                <img src="{{asset('img/propiedad-preview.png')}}" class="card-img-top" id="frameimagenpublicacion" alt="...">
                            </label>
                            <input class="form-control" type="file" id="urlimagen" name="urlimagen" onchange="previewimagenpublicacion()" hidden>
                            <input class="form-control w-100" type="text" name="titulo" value="." required hidden>
                            {{-- Descripción --}}
                            <textarea class="w-100" id="exampleFormControlTextarea1" name="descripcion" rows="3" maxlength="500" placeholder="Descripción..."></textarea>
                            <div class="input-group-append align-items-center">
                                <input class="form-control w-100" type="text" name="ubicacion" value="" placeholder="📍Ubicación" required>
                                <select class="form-control w-100" name="pais" required>
                                    <option value="">Pais</option>
                                    @foreach ($paises as $pais)
                                        <option value="{{$pais->nombre}}">{{$pais->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-body">
                                <!-- INTERACCIONES -->
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="input-group-append align-items-center">
                                            <input class="form-control w-100" type="text" name="precio" placeholder="$Precio" oninput="formatNumber(this)">
                                        </div>                                        
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group-append align-items-center">
                                            <input class="form-control w-100" type="number" name="comision" value="" placeholder="%Comisión" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block" >Publicar</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>            
</div>
@endhasrole
<div class="row">
    {{-- INFORMACIÓN --}}
    <div class="col d-none d-sm-table-cell text-center">
        <h5>
            @role('admin')
            <a href="{{route('gruposfacebook.index')}}"> 
                Grupos de Facebook <i class="fas fa-fw fa-edit"></i>
            </a>
            @else
            Grupos de Facebook
            @endrole
        </h5>        
        @foreach ($gruposfacebooks as $gruposfacebook)
            <a href="{{$gruposfacebook->urlgrupo}}" target="_bank" class="btn btn-amarillo btn-block">
                {{$gruposfacebook->pais}}
            </a>
        @endforeach
    </div>
    {{-- FEED --}}
    <div class="col-12 col-md-6">
        <!-- BUSCADOR DE PUBLICACIONES -->
        <form action="" method="GET" class="justify-content-center md-form form-sm mt-0 d-block d-sm-none">
            <div class="input-group-append justify-content-center">
                <input class="form-control form-control-sm ml-3 w-100 rounded-pill" type="text" placeholder="Buscar..." aria-label="Search" name="query" id="search_input" value="{{ $query ?? '' }}">
                &nbsp;&nbsp;
                <a href="#" data-toggle="modal" data-target="#filtromodal" class="btn btn-primary">Filtro</a>
            </div>
            <br>
        </form>
        <!-- NUEVA PUBLICACIÓN -->
        <div class="card shadow mb-4 bg-gray-100 text-gray-900">
            <div class="card-body">
                <div class="input-group-append justify-content-center">
                    <a class="bg-gray-100 text-gray-900" href="{{route('contactanos.index')}}">
                        <img src="{{ asset(str_replace('public', 'storage', Auth::user()->urlfotoperfil)) }}" width="40" height="40" class="rounded-circle">
                    </a>
                    @hasrole('afiliado|admin')
                        <input class="form-control form-control-sm ml-3 rounded-pill" type="text" placeholder="Escribe tu publicación..." data-toggle="modal" data-target="#crearpublicacionmodal">
                    @else
                        <input class="form-control form-control-sm ml-3 rounded-pill" type="text" placeholder="Escribe tu publicación..." data-toggle="modal" data-target="#necesitasafiliartemodal">
                    @endhasrole
                </div>
            </div>
        </div>
        @foreach ($publicacions as $publicacion)
        <!-- PUBLICACIONES -->
        <div class="card shadow mb-4 bg-gray-100 text-gray-900">
            <img src="{{ asset(str_replace('public', 'storage', $publicacion->urlimagen)) }}" class="card-img-top" alt="...">
            <div class="card-body">
                <a class="text-gray-900" href="{{route('usuarios.show', $publicacion->user)}}">
                    <img src="{{asset(str_replace('public', 'storage', $publicacion->user ? $publicacion->user->urlfotoperfil : '.' ))}}" width="40" height="40" class="rounded-circle">
                </a>
                &nbsp;
                <label class="card-title h5">
                    <a class="text-gray-900" href="{{route('usuarios.show', $publicacion->user)}}">
                        {{$publicacion->user ? $publicacion->user->name : '.'}} 
                        <i class="fas fa-check-circle text-amarillo" style="font-size: 16px;"></i>
                    </a>
                    <br>
                    <small class="text-muted">{{$publicacion->updated_at->format('d M Y')}}</small>
                    <a class="text-gray-900 active" href="/home/search?descripcion=&pais={{$publicacion->pais}}&precio=&comision=">
                        <small class="text-gray-900">{{$publicacion->pais}}</small>
                    </a>
                </label>
                <p class="card-text more-text">
                    {{$publicacion->descripcion}}
                </p>
                <br>
                <hr class="sidebar-divider my-0">
                <!-- INTERACCIONES -->
                <div class="row text-center">
                    <div class="col">
                        <a class="dropdown-item bg-gray-100 text-gray-900">
                            <i class="fa fa-dollar-sign"></i>
                            {{$publicacion->precio}}
                        </a>
                    </div>
                    <div class="col">
                        <a class="dropdown-item bg-gray-100 text-gray-900">
                            <i class="fas fa-percent"></i>
                            {{$publicacion->comision}}
                        </a>
                    </div>
                    <div class="col">
                        @hasrole('afiliado|admin')
                            <a class="dropdown-item bg-gray-100 text-gray-900 active" href="{{route('usuarios.show', $publicacion->user)}}">
                                <i class="far fa-comment-alt"></i>
                                Contactar agente
                            </a>
                        @else
                            <a data-toggle="modal" data-target="#necesitasafiliartemodal" class="dropdown-item bg-gray-100 text-gray-900 cursor-pointer active">
                                <i class="far fa-comment-alt"></i>
                                Contactar agente
                            </a>
                        @endhasrole
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{-- EVENTOS INTERNACIONALES --}}
    <div class="col d-none d-sm-table-cell text-center">
        <!-- BUSCADOR DE PUBLICACIONES -->
        <form action="{{ route('home.search') }}" method="GET" class="justify-content-center md-form form-sm mt-3">
            <div class="input-group-append justify-content-center">
                <input class="form-control form-control-sm ml-3 w-75 rounded-pill" type="text" placeholder="Buscar publicación..." aria-label="Search" name="query" id="search_input" value="{{ $query ?? '' }}">
                &nbsp;&nbsp;
                <a href="#" data-toggle="modal" data-target="#filtromodal" class="btn btn-primary">Filtro</a>
            </div>
        </form>
        <br>
        <h5>Eventos Internacionales</h5>
        @foreach ($eventos as $evento)
        <!-- EVENTOS -->
        <a href="{{route('eventos.show', $evento)}}" style="text-decoration:none;">
            <div class="card shadow mb-4 bg-gray-100 text-gray-900">
                <img src="{{asset(str_replace('public', 'storage', $evento->urlimagen))}}" class="card-img-top" alt="{{$evento->nombre}}">
                <div class="card-body">
                    <small class="text-gray-900">{{$evento->pais}}</small>
                    <p class="card-text more-text">
                        {{$evento->nombre}}
                    </p>
                    <hr class="sidebar-divider my-0">
                    <!-- INTERACCIONES -->
                    <button class="btn btn-amarillo btn-block">
                        Ver evento
                    </button>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>



<!-- Bootstrap core JavaScript-->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
{{-- LUPA BUSCADOR --}}
<script>
    // Obtener el icono de búsqueda
    var searchIcon = document.querySelector('#search-icon');
    // Agregar un evento de clic al icono de búsqueda
    searchIcon.addEventListener('click', function(event) {
        // Obtener el valor del campo de entrada de búsqueda
        var query = searchInput.value;
        // Verificar si hay más de 7 números seguidos o si hay guiones o paréntesis y tratarlo como un número de teléfono
        if (/[\d()+\s-]{7,}/.test(query)) {
            // Eliminar los espacios, paréntesis y guiones si es un número de teléfono
            query = query.replace(/[\s()+\-]/g, '');
        }
        // Establecer el valor actualizado del campo de entrada de búsqueda
        searchInput.value = query;
        // Enviar el formulario de búsqueda
        searchInput.form.submit();
    });
</script>
<script>
    // Obtener el campo de entrada de búsqueda
    var searchInput = document.querySelector('#search_input');
    // Agregar un evento de envío al formulario de búsqueda para verificar si es un número de teléfono
    searchInput.form.addEventListener('submit', function(event) {
        var query = searchInput.value;
        // Verificar si hay más de 7 números seguidos o si hay guiones o paréntesis y tratarlo como un número de teléfono
        if (/[\d()+\s-]{7,}/.test(query)) {
            // Eliminar los espacios, paréntesis y guiones si es un número de teléfono
            query = query.replace(/[\s()+\-]/g, '');
        }
        // Establecer el valor actualizado del campo de entrada de búsqueda
        searchInput.value = query;
    });
</script>
{{-- PUBLICACIONES DESCRIPCIÓN --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
      var maxLength = 300;
      var showChar = 300;
      
      var moreTextElements = document.querySelectorAll(".more-text");
  
      moreTextElements.forEach(function(element) {
        var content = element.innerHTML;
  
        if (content.length > maxLength) {
          var visibleText = content.substr(0, showChar);
          var hiddenText = content.substr(showChar, content.length - showChar);
  
          var updatedContent =
            visibleText +
            '<span class="show-more-content">' +
            hiddenText +
            '</span>' +
            '<b class="read-more cursor-pointer" onclick="toggleReadMore(this)"> Ver más...</b>';
  
          element.innerHTML = updatedContent;
        }
      });
    });
  
    function toggleReadMore(element) {
      var moreText = element.previousSibling; // Busca el elemento hermano anterior
      var readMoreBtn = element;
  
      if (moreText.style.display === "none" || moreText.style.display === "") {
        moreText.style.display = "inline";
        readMoreBtn.innerHTML = " Ver menos...";
      } else {
        moreText.style.display = "none";
        readMoreBtn.innerHTML = " Ver más...";
      }
    }
</script>
{{-- IMAGEN PUBLICACION --}}
<script>
    function previewimagenpublicacion() {
        frameimagenpublicacion.src = URL.createObjectURL(event.target.files[0]);
    }
    function clearImage() {
        document.getElementById('formFile').value = null;
        frameimagenpublicacion.src = "";
    }
</script>
{{-- FORMATO DE PRECIO --}}
<script>
    function formatNumber(input) {
      // Obtén el valor actual del input
      let value = input.value;
  
      // Remueve todos los puntos y comas
      value = value.replace(/[,.]/g, '');
  
      // Formatea el valor con puntos para separar los miles
      value = new Intl.NumberFormat('es-ES').format(value);
  
      // Actualiza el valor en el input
      input.value = value;
    }
</script>
@endsection