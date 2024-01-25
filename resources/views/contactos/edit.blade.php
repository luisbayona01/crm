@extends('layouts.plantilla')
@section('content')
{{-- MODAL PERFIL --}}
@section('modal')
<div class="modal fade" id="notasdeperfilmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" style="max-width:480px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-gray-900" id="exampleModalLabel">PERFIL</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-gray-900">
                {{-- IDENTIFICACIÓN --}}
                <div class="text-center">
                    <img src="{{ asset(str_replace('public', 'storage', $contacto->urlidentificacion)) }}" class="rounded imagen-identificacion" id="frameidentificacion">
                    <br>
                    <label for="urlidentificacion" style="cursor:pointer;"><u>Cambiar identificación</u></label>
                    <input class="form-control" type="file" id="urlidentificacion" name="urlidentificacion" onchange="previewidentifiacion()" hidden>
                </div>
                <br>
                {{-- HOJA DE VIDA --}}
                <div class="row">
                    <div class="col">
                        <label for="urlhojadevida" style="cursor:pointer;"><u>Subir hoja de vida</u></label>
                        <h6 id="carga-h6" class="text-success" style="display:none;font-size:12px;">Hoja de vida cargada</h6>
                        <input class="form-control-file" type="file" name="urlhojadevida" id="urlhojadevida" onchange="previewhojadevida()" hidden>
                    </div>
                    <div class="col text-right">
                        <a href="{{ asset($contacto->urlhojadevida) }}" target="_blank" class="btn btn-primary">Ver Hoja de vida</a>  
                    </div>
                </div>
                <br>
                {{-- ******** --}}
                Notas de perfil
                <div class="form-outline mb-4">
                    <input class="form-control" name="notadeperfil" type="text" id="notadeperfil" placeholder="Escribir nota">
                    <div class="text-right">
                        <button type="button" onclick="agregarNotadeperfil()">Agregar nota</button>
                    </div>
                    <br>
                    <div id="notasdeperfil-lineas2" class="bg-light text-gray-900" style="padding: 5px">
                        @if ($contacto->notasdeperfil)
                            @foreach (explode("\n", $contacto->notasdeperfil) as $linea)
                                <div class="notadepefil-linea" data-linea="{{substr($linea, 0, 3)}}">{{$linea}}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">Confirmar</button>
            </div>
        </div>
    </div>            
</div>
{{-- MODAL FOTO DE PERFIL --}}
<div class="modal fade" id="fotodeperfilmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-gray-900">
                <img src="{{ asset(str_replace('public', 'storage', $contacto->urlfotoperfil)) }}" width="100%">
            </div>
        </div>
    </div>            
</div>
@endsection
<div class="container-xl"> 
    <!-- Flexbox container for aligning the toasts -->
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="position:absolute;right:20px;top:80px;">
        <!-- Then put toasts within -->
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000">
        <div class="toast-header bg-success">
        </div>
        <div class="toast-body bg-gray-100">
            <h6 class="text-gray-900 text-center">Contacto Actualizado</h6>
        </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body bg-gray-100">
            <div class="table-responsive text-gray-900">
                
                <form action="{{route('contactos.update', $contacto)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="container-520">
                        {{-- FOTO DE PERFIL --}}
                        <div class="text-center">
                            <label data-toggle="modal" data-target="#fotodeperfilmodal" style="cursor:pointer;">
                                <img src="{{ asset(str_replace('public', 'storage', $contacto->urlfotoperfil)) }}" class="rounded-circle foto-perfil-preview" id="framefotodeperfil">
                            </label>
                            <br>
                            <label for="urlfotoperfil" style="cursor:pointer;"><u>Cambiar foto</u></label>
                            <input class="form-control" type="file" id="urlfotoperfil" name="urlfotoperfil" onchange="previewfotodeperfil()" hidden>
                            <br>
                        </div>
                        {{-- ETIQUETA --}}
                        <div class="input-group mb-1">
                            <select class="form-control multiselect" multiple name="etiqueta[]" id="etiqueta" data-placeholder="Compañía" required>
                                @foreach ($etiquetas as $id => $nombre)
                                    <option value="{{ $id }}" @if(in_array($id, $etiquetasSeleccionadas)) selected @endif>{{ $nombre }}</option>
                                @endforeach
                            </select>
                            <select class="form-control multiselect" multiple name="subetiqueta[]" id="subetiqueta" data-placeholder="Etiquetas">
                                @foreach ($subetiquetas as $id => $nombre)
                                    <option value="{{ $id }}" @if(in_array($id, $subetiquetasSeleccionadas)) selected @endif>{{ $nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- USERID --}}
                        <div class="input-group mb-1">
                            <input class="form-control" type="text" name="userid" value="{{old('userid', $contacto->userid)}}" required hidden>
                        </div>
                        {{-- ******** --}}
                        Nombres y Apellidos
                        <div class="input-group mb-1">
                            <input class="form-control" type="text" name="nombre" value="{{old('nombre', $contacto->nombre)}}" required>
                        </div>
                        {{-- ******** --}}
                        Correo
                        <div class="input-group mb-1">
                            <input class="form-control" type="email" name="correo" value="{{old('correo', $contacto->correo)}}" required>
                        </div>
                        {{-- ******** --}}
                        Teléfono
                        <div id="telefonos-container">
                            <div class="input-group mb-1">
                                <input class="form-control telefono" type="text" id="telefono" name="telefono" value="{{old('telefono', $contacto->telefono)}}">
                                <div class="input-group-append">
                                    <a href="" class="btn btn-primary text-gray-900 whatsapp-numero" id="llamada" target="_bank">Llamar ahora</a>
                                    <a href="" class="btn btn-success text-gray-900 whatsapp-numero" id="linkwhatsapp" target="_bank">WhatsApp</a>
                                </div>
                            </div>
                        </div>
                        {{-- ******** --}}
                        País de ubicación
                        <div class="input-group mb-1">
                            <select class="form-control" name="pais" required>
                                <option value="{{old('pais', $contacto->pais)}}">{{old('pais', $contacto->pais)}}</option>
                                @foreach ($paises as $pais)
                                    <option value="{{$pais->nombre}}">{{$pais->nombre}}</option>
                                @endforeach
                            </select>                        
                        </div>
                    </div>
                    <br>
                    {{-- ******** --}}
                    <div class="form-outline mb-4">
                        <div class="container-520">
                            Nota de:<br>
                            {{-- Asesoras --}}
                            <select id="select" hidden>
                                <option value="{{ Auth::user()->estado }}">{{ Auth::user()->estado }}</option>
                            </select>
                            {{-- Compañia --}}
                            <select id="selectlinea">
                                <option style="font-size: 14px;" value="" selected>Selecciona una línea</option>
                                <option style="font-size: 14px;" value="01-">01- intREasso</option>
                                <option style="font-size: 14px;" value="02-">02- ABC College</option>
                                <option style="font-size: 14px;" value="03-">03- American Homes</option>
                                <option style="font-size: 14px;" value="04-">04- Power City Chruch</option>
                                <option style="font-size: 14px;" value="05-">05- Jurídico</option>
                                <option style="font-size: 14px;" value="06-">06- MORTGAGE</option>
                                <option style="font-size: 14px;" value="07-">07- MIA</option>
                                <option style="font-size: 14px;" value="08-">08- Credit Hospital</option>
                                <option style="font-size: 14px;" value="09-">09- Radio Nube</option>
                                <option style="font-size: 14px;" value="10-">10- Personal</option>
                                <option style="font-size: 14px;" value="11-">11- Col Servicios</option>
                                <option style="font-size: 14px;" value="12-">12- USA Servicios</option>
                                <option style="font-size: 14px;" value="13-">13- Hojas de vida</option>
                            </select>
                            <select id="selecttipo">
                                <option style="font-size: 14px;" selected value="">Tipo</option>
                                <option style="font-size: 14px;" value="C">Comentarios</option>
                                <option style="font-size: 14px;" value="M">Mensajes</option>
                            </select>
                            <small id="avisoselectlinea" class="text-danger">* Seleccione una línea</small>
                            <small id="avisoselecttipo" class="text-danger">* Seleccione un tipo de nota</small>
                            <input class="form-control" type="text" id="nota" placeholder="Escribir nota">
                            <div class="text-right">
                                <button type="button" onclick="agregarNota()">Agregar nota</button>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <button type="button" data-toggle="modal" data-target="#notasdeperfilmodal" class="btn btn-primary btn-md">Notas de Perfil</button>
                                </div>
                                <div class="col text-right">
                                    <button type="submit" class="btn btn-primary btn-md">Actualizar Contacto</button>
                                </div>
                            </div>
                        </div>
                        <br>
                        Mostrar línea:
                            <br>
                            <select id="selectlinea2">
                                <option style="font-size: 14px;" selected value="todas">Todos</option>
                                <option style="font-size: 14px;" value="01-">01- intREasso</option>
                                <option style="font-size: 14px;" value="02-">02- ABC College</option>
                                <option style="font-size: 14px;" value="03-">03- American Homes</option>
                                <option style="font-size: 14px;" value="04-">04- Power City Chruch</option>
                                <option style="font-size: 14px;" value="05-">05- Jurídico</option>
                                <option style="font-size: 14px;" value="06-">06- MORTGAGE</option>
                                <option style="font-size: 14px;" value="07-">07- MIA</option>
                                <option style="font-size: 14px;" value="08-">08- Credit Hospital</option>
                                <option style="font-size: 14px;" value="09-">09- Radio Nube</option>
                                <option style="font-size: 14px;" value="10-">10- Personal</option>
                                <option style="font-size: 14px;" value="11-">11- Col Servicios</option>
                                <option style="font-size: 14px;" value="12-">12- USA Servicios</option>
                                <option style="font-size: 14px;" value="13-">13- Hojas de vida</option>
                            </select>
                            <select id="selecttipo2">
                                <option style="font-size: 14px;" selected value="todas">Tipo</option>
                                <option style="font-size: 14px;" value="C">Comentarios</option>
                                <option style="font-size: 14px;" value="M">Mensajes</option>
                            </select>
                        <br>
                        {{-- Notas --}}
                        @if (auth()->user()->hasRole('admin'))
                            <div class="row">
                                <div class="col">
                                </div>
                                <div class="col text-right">
                                    <button type="button" id="botoneditarnotas" onclick="editarNotas()">Editar Nota</button>
                                </div>
                            </div>
                            <div id="notasusuario">
                                <div id="notas-lineas2" class="text-gray-900" style="padding: 5px">
                                    @if ($contacto->notas)
                                        @foreach (explode("\n", $contacto->notas) as $linea)
                                            <div class="nota-linea" data-linea="{{substr($linea, 0, 3)}}">{{$linea}}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div id="editarnotas">
                                {{-- NOTAS A EDITAR --}}
                                <textarea class="form-control" name="notas" id="notas" rows="8">{{old('etiqueta', $contacto->notas)}}</textarea>
                            </div>
                        @else
                            <div id="notasusuario"></div>
                            <div id="editarnotas"></div>
                            {{-- Notas USARIO--}}
                            <textarea class="form-control" name="notas" id="notas" rows="8" readonly hidden>{{old('etiqueta', $contacto->notas)}}</textarea>
                            <div id="notas-lineas2" class="text-gray-900" style="padding: 5px">
                                @if ($contacto->notas)
                                    @foreach (explode("\n", $contacto->notas) as $linea)
                                        <div class="nota-linea" data-linea="{{substr($linea, 0, 3)}}">{{$linea}}</div>
                                    @endforeach
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="container-520">
                        {{-- MODAL NOTAS DE PERFIL --}}
                        @yield('modal')
                        <textarea class="form-control" name="notasdeperfil" id="notasdeperfil" rows="8" readonly hidden>{{old('etiqueta', $contacto->notasdeperfil)}}</textarea>
                        {{-- ******** --}}
                        Número de Identificación
                        <div class="input-group mb-1">
                            <input class="form-control" type="text" name="ndi" value="{{old('ndi', $contacto->ndi)}}" required>
                        </div> 
                        {{-- ******** --}}
                        Dirección y Ciudad
                        <div class="input-group mb-1">
                            <input class="form-control" type="text" name="ciudad" value="{{old('ciudad', $contacto->ciudad)}}" required>
                        </div>
                        {{-- ******** --}}
                        Seguro Social
                        <div class="input-group mb-1">
                            <input class="form-control" type="text" name="segurosocial" value="{{old('segurosocial', $contacto->segurosocial)}}" required>
                        </div>
                        {{-- ******** --}}
                        Profesión
                        <div class="input-group mb-1">
                            <input class="form-control" type="text" name="profesion" value="{{old('profesion', $contacto->profesion)}}" required>
                        </div>
                        {{-- ******** --}}
                        Fecha de nacimiento
                        <div class="input-group mb-1">
                            <input class="form-control" type="text" name="fechadecumpleanios" placeholder="02-03-1996" value="{{old('fechadecumpleanios', $contacto->fechadecumpleanios)}}" onkeyup="agregarGuiones(this)" required>
                        </div>
                        {{-- ******** --}}
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                Status
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                Seguimiento
                            </div>
                        </div>
                        <div class="input-group mb-1">
                            <input class="form-control" type="text" id="status" name="status" value="{{old('status', $contacto->status)}}" required>
                            <select class="form-control" name="seguimiento">
                                <option value="-{{old('seguimiento', $contacto->seguimiento)}}">{{old('seguimiento', $contacto->seguimiento)}}</option>
                                @foreach ($users as $user)
                                    @if ($user->username !== 'admin')
                                        <option value="{{$user->name}}">{{$user->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        {{-- ******** --}}
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                Referido por
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                Fuente
                            </div>
                        </div>
                        <div class="input-group mb-1">
                            <input class="form-control" type="text" name="referencia" value="{{old('referencia', $contacto->referencia)}}" required>
                            <select class="form-control" name="referenciafuente">
                                <option value="{{old('referenciafuente', $contacto->referenciafuente)}}">{{old('referenciafuente', $contacto->referenciafuente)}}</option>
                                <option value="Base de datos">Base de datos</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Instagram">Instagram</option>
                                <option value="Tiktok">Tiktok</option>
                                <option value="Google">Google</option>
                                <option value="Correo">Correo</option>
                                <option value="Portales">Portales</option>
                                <option value="Formulario web">Formulario web</option>
                                <option value="Feria Inmobiliara">Feria Inmobiliaria</option>
                                <option value="8x8 Work">8x8 Work</option>
                                <option value="WhatsApp">WhatsApp</option>
                                <option value="Emisora">Emisora</option>
                                <option value="Valla Publicitaria">Valla Publicitaria</option>
                            </select>
                        </div>
                        {{-- ******** --}}
                        Tipo de Afiliación 
                        <div class="input-group mb-1">
                            <input class="form-control" type="text" name="tipodeafiliacion" value="{{old('tipodeafiliacion', $contacto->tipodeafiliacion)}}" required>
                        </div> 
                        {{-- ******** --}}
                        Fecha de Afiliación intREasso
                        <div class="input-group mb-1">
                            <input class="form-control" type="text" name="fechadeafiliacionintreasso" placeholder="01-01-2020" value="{{old('fechadeafiliacionintreasso', $contacto->fechadeafiliacionintreasso)}}" onkeyup="agregarGuiones(this)" required>
                        </div>
                        {{-- ******** --}}
                        Eventos confirmados para participar
                        <div class="input-group mb-1">
                            <select class="form-control multiselect" multiple name="evento[]" id="evento" data-placeholder="Eventos">
                                @foreach ($eventos as $id => $nombre)
                                    <option value="{{ $id }}" @if(in_array($id, $eventosSeleccionados)) selected @endif>{{ $nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Actualizar contacto</button>
                        </div>
                        <br>
                        Registrado el
                        {{$contacto->created_at->format('d-m-Y H:i')}}
                        <br>
                        Actualizado el 
                        {{$contacto->updated_at->format('d-m-Y H:i')}}
                    </div>
                </form>
                @hasrole('afiliado|admin')
                <div class="text-right">
                    <a class="text-danger" href="{{route('contactos.destroy', $contacto)}}">Eliminar</a>
                </div>
                @endhasrole                        
            </div>
        </div>
    </div>
</div>
<br>
<!-- Aparecer Formularios -->
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
@if(session('info'))
    <script type="text/javascript">
        $(document).ready(function(){
            $('.toast').toast("show")
        });
    </script>
@endif
{{-- TELÉFONO --}}
<script type="text/javascript">
    var telefono = document.getElementById("telefono");
    telefono.addEventListener("input", function(event) {
        var valor = telefono.value;
        valor = valor.replace(/[^0-9+]/g, "");
        telefono.value = valor;
    });
    document.addEventListener('DOMContentLoaded', () => {
    // Obtenemos los elementos del DOM
    const telefono = document.getElementById('telefono');
    // Datos Llamada
    const linkLlamada = document.getElementById('llamada');
    // Datos Whatsapp
    const linkWhatsapp = document.getElementById('linkwhatsapp');
    const telefonoSinMas = telefono.value.slice(1);

    // Actualizar el enlace de Llamada con el valor por defecto
    linkLlamada.href = `tel:${telefonoSinMas}`;
    // Actualizar el enlace de WhatsApp con el valor por defecto
    linkWhatsapp.href = `https://api.whatsapp.com/send?phone=${telefonoSinMas}`;

    // Al cambiar el valor del campo de teléfono
    telefono.addEventListener('input', () => {
    // Obtener el valor del campo de teléfono sin el primer caracter (+)
    const telefonoSinMas = telefono.value.slice(1);
    // Actualizar la URL del enlace con el número de teléfono
    linkLlamada.href = `tel:${telefonoSinMas}`;
    // Actualizar la URL del enlace con el número de teléfono
    linkWhatsapp.href = `https://api.whatsapp.com/send?phone=${telefonoSinMas}`;
    });
});
</script>
{{-- CUMPLEAÑOS --}}
<script type="text/javascript">
    function agregarGuiones(input) {
    // Obtener el valor actual del input
    var valor = input.value;
    // Eliminar los guiones existentes
    valor = valor.replace(/-/g, '');
    // Insertar los guiones en la posición adecuada
    if (valor.length > 2) {
        valor = valor.slice(0, 2) + '-' + valor.slice(2);
    }
    if (valor.length > 5) {
        valor = valor.slice(0, 5) + '-' + valor.slice(5);
    }
    // Actualizar el valor del input
    input.value = valor;
    }
</script>
{{-- ETIQUETA --}}
<script>
    $(document).ready(function() {
    $('.multiselect').multiselect({
        enableFiltering: true,
        filterPlaceholder: 'Buscar...',
        allSelectedText: 'Todas las opciones seleccionadas',
        includeSelectAllOption: true,
        selectAllText: 'Seleccionar todo'
    });
    });
</script>
{{-- SUBETIQUETA --}}
<script>
    var subetiquetas = {!! json_encode($subetiquetas) !!};

    $(function() {
        $('#etiqueta').multiselect({
            includeSelectAllOption: true,
            onSelectAll: function() {
                $('#subetiqueta').multiselect('rebuild');
            },
            onDeselect: function(option, checked) {
                var deselectedValue = option.val();
                var subetiquetaSelect = $('#subetiqueta');
                        
                // Find all options in subetiqueta select that correspond to the deselected etiqueta
                var optionsToRemove = subetiquetaSelect.find('option[data-etiqueta="' + deselectedValue + '"]');
                        
                // Remove the corresponding options
                optionsToRemove.remove();
                        
                // Find all optgroups in subetiqueta select that have no options and remove them
                subetiquetaSelect.find('optgroup').filter(function() {
                    return $(this).children().length === 0;
                }).remove();
                        
                // Rebuild the subetiqueta select
                $('#subetiqueta').multiselect('rebuild');
            }
        });

        $('#subetiqueta').multiselect({
            includeSelectAllOption: true,
            buttonWidth: '100%',
            maxHeight: 300,
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            enableClickableOptGroups: true
        });
    });

    function mostrarSubetiqueta(select) {
        var subetiquetaContainer = $('#subetiqueta-container');
        var etiqueta_ids = $(select).val();

        // Remove all optgroups in subetiqueta select
        var subetiquetaSelect = $('#subetiqueta');
        subetiquetaSelect.find('optgroup').remove();

        $.each(etiqueta_ids, function(i, etiqueta_id) {
            var filtered_subetiquetas = subetiquetas.filter(function(subetiqueta) {
                return subetiqueta.etiqueta_id == etiqueta_id;
            }).sort(function(a, b) {
                return a.nombre.localeCompare(b.nombre);
            });

            // Create new optgroup with corresponding subetiquetas
            var optgroup = $('<optgroup class="font-weight-bold">');
            optgroup.attr('label', $('#etiqueta option[value="' + etiqueta_id + '"]').text());

            $.each(filtered_subetiquetas, function(i, subetiqueta) {
                var option = $('<option>', {
                    value: subetiqueta.id,
                    text: subetiqueta.nombre,
                    'data-etiqueta': subetiqueta.etiqueta_id
                });
                optgroup.append(option);
            });

            // Add optgroup in subetiqueta select
            subetiquetaSelect.append(optgroup);
        });

        // Show or hide subetiqueta container
        if (etiqueta_ids.length > 0) {
            subetiquetaContainer.show();
        } else {
            subetiquetaContainer.hide();
        }

        $('#subetiqueta').multiselect('rebuild');
    }
</script>
{{-- NOTAS --}}
<script type="text/javascript">
    // EDITAR NOTAS
    document.getElementById("editarnotas").style.display = "none";
    function editarNotas(){
        document.getElementById("botoneditarnotas").style.display = "none";
        document.getElementById("editarnotas").style.display = "block";
        document.getElementById("notasusuario").style.display = "none";
        document.getElementById("selectlinea2").style.display = "none";
        document.getElementById("selecttipo2").style.display = "none";
    }

    // AGREGAR NOTAS
    document.getElementById("avisoselectlinea").style.display = "none";
    document.getElementById("avisoselecttipo").style.display = "none";
    function agregarNota() {
        // Obtener la fecha actual
        var fecha = new Date();

        // Formatear la fecha como "DD/MM/YYYY HH:MM:SS"
        var fechaFormateada = fecha.toLocaleString();

        // Obtener el valor del input
        var valor = document.getElementById("nota").value;

        // Obtener el valor seleccionado del select
        var select = document.getElementById("select");
        var seleccion = select.options[select.selectedIndex].value;

        // Obtener el valor del selectlinea
        var selectlinea = document.getElementById("selectlinea");
        var seleccionlinea = selectlinea.options[selectlinea.selectedIndex].value;
        // Si el valor está vacío, mostrar un mensaje de advertencia
        if (seleccionlinea == "") {
            document.getElementById("avisoselectlinea").style.display = "block";
            return;
        }
        else {
            document.getElementById("avisoselectlinea").style.display = "none";
        }

        // Obtener el valor seleccionado del selecttipo
        var selecttipo = document.getElementById("selecttipo");
        var selecciontipo = selecttipo.options[selecttipo.selectedIndex].value;
        // Si el valor está vacío, mostrar un mensaje de advertencia
        if (selecciontipo == "") {
            document.getElementById("avisoselecttipo").style.display = "block";
            return;
        }
        else {
            document.getElementById("avisoselecttipo").style.display = "none";
        }

        // Agregar el valor al textarea
        var notas = document.getElementById("notas");
        notas.value = seleccionlinea + " " + selecciontipo + " " + seleccion + " " + fechaFormateada + " " + valor + "\n" + notas.value;

        // Agregar el valor al div "notas-lineas2"
        var notasLineas2 = document.getElementById("notas-lineas2");
        var nuevaNotaLinea = document.createElement("div");
        nuevaNotaLinea.setAttribute("class", "nota-linea");
        nuevaNotaLinea.setAttribute("data-linea", seleccionlinea);
        nuevaNotaLinea.innerHTML = seleccionlinea + " " + selecciontipo + " " +  seleccion + " " + fechaFormateada + " " + valor + "<br>";
        notasLineas2.prepend(nuevaNotaLinea);

        // Borrar el contenido del input
        document.getElementById("nota").value = "";
        document.getElementById("select").selectedIndex = 0;

        // Mover el scroll hacia arriba
        notas.scrollTop = 0;
    }




    // MOSTRAR COMENTARIOS Y MENSAJES
    document.querySelector('#selectlinea2').addEventListener('change', function() {
    mostrarNotasSeleccionadas();
    });
    document.querySelector('#selecttipo2').addEventListener('change', function() {
        mostrarNotasSeleccionadas();
    });
    function mostrarNotasSeleccionadas() {
        let valorSeleccionadoLinea = document.querySelector('#selectlinea2').value;
        let valorSeleccionadoTipo = document.querySelector('#selecttipo2').value;

        let notasLineas = document.querySelectorAll('.nota-linea');
        notasLineas.forEach(function(notaLinea) {
            let linea = notaLinea.getAttribute('data-linea');
            let tipo = notaLinea.innerHTML.charAt(4);

            if (valorSeleccionadoLinea == 'todas' && valorSeleccionadoTipo == 'todas') {
                notaLinea.style.display = 'block';
            } else if (valorSeleccionadoLinea == 'todas' && valorSeleccionadoTipo == tipo) {
                notaLinea.style.display = 'block';
            } else if (valorSeleccionadoTipo == 'todas' && valorSeleccionadoLinea == linea) {
                notaLinea.style.display = 'block';
            } else if (valorSeleccionadoLinea == linea && valorSeleccionadoTipo == tipo) {
                notaLinea.style.display = 'block';
            } else {
                notaLinea.style.display = 'none';
            }
        });
    }
</script>
{{-- NOTAS DE PERFIL--}}
<script>
    function agregarNotadeperfil(){
        // Obtener la fecha actual
        var fecha = new Date();

        // Formatear la fecha como "DD/MM/YYYY HH:MM:SS"
        var fechaFormateada = fecha.toLocaleString();
        
        // Obtener el valor del input
        var valor = document.getElementById("notadeperfil").value;

        // Obtener el valor seleccionado del select
        var select = document.getElementById("select");
        var seleccion = select.options[select.selectedIndex].value;
        // Obtener el valor seleccionado del selectlinea
        var selectlinea = document.getElementById("selectlinea");
        var seleccionlinea = selectlinea.options[selectlinea.selectedIndex].value;

        // Agregar el valor al textarea
        var notasdeperfil = document.getElementById("notasdeperfil");
        notasdeperfil.value = valor + "\n" + notasdeperfil.value;

        // Agregar el valor al div "notas-lineas2"
        var notasLineas2 = document.getElementById("notasdeperfil-lineas2");
        var nuevaNotaLinea = document.createElement("div");
        nuevaNotaLinea.setAttribute("class", "notadeperfil-linea");
        nuevaNotaLinea.setAttribute("data-linea", seleccionlinea);
        nuevaNotaLinea.innerHTML = valor + "<br>";
        notasLineas2.prepend(nuevaNotaLinea);

        // Borrar el contenido del input
        document.getElementById("notadeperfil").value = "";
        document.getElementById("select").selectedIndex = 0;

        // Mover el scroll hacia arriba
        notas.scrollTop = 0;
    }
    document.querySelector('#selectlinea2').addEventListener('change', function() {
        let valorSeleccionado = this.value;
        let notasLineas = document.querySelectorAll('.notadeperfil-linea');
        notasLineas.forEach(function(notaLinea) {
            let linea = notaLinea.getAttribute('data-linea');
            if (valorSeleccionado == 'todas' || valorSeleccionado == linea) {
                notaLinea.style.display = 'block';
            } else {
                notaLinea.style.display = 'none';
            }
        });
    });
</script>
{{-- FOTO DE PERFIL --}}
<script>
    function previewfotodeperfil(){
        framefotodeperfil.src = URL.createObjectURL(event.target.files[0]);
    }
    function clearImage(){
        document.getElementById('formFile').value = null;
        framefotodeperfil.src = "";
    }
    document.addEventListener("DOMContentLoaded", function() {
        // Obtén una referencia al elemento "Editar foto" y al input de la foto.
        var editarFoto = document.getElementById("editar-foto");
        var inputFoto = document.getElementById("urlfotoperfil");
    });
</script>
{{-- IDENTIFICACIÓN --}}
<script>
    function previewidentifiacion(){
        frameidentificacion.src = URL.createObjectURL(event.target.files[0]);
    }
    function clearImage(){
        document.getElementById('formFile').value = null;
        frameidentificacion.src = "";
    }
</script>
{{-- HOJA DE VIDA --}}
<script>
    function previewhojadevida() {
        // Mostrar el h6 de carga una vez que se ha cargado la hoja de vida
        document.getElementById("carga-h6").style.display = "block";
    }
</script>
@endsection