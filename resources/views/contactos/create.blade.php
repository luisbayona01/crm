@extends('layouts.plantilla')
@section('content')
@section('modal')
{{-- MODAL PERFIL --}}
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
                    <img src="{{asset('img/imagen-identificacion.png')}}" class="rounded imagen-identificacion" id="frameidentificacion">
                    <br>
                    <label for="urlidentificacion" style="cursor:pointer;"><u>Subir identificación</u></label>
                    <input class="form-control" type="file" id="urlidentificacion" name="urlidentificacion" onchange="previewidentifiacion()" hidden>
                </div>
                <br>
                {{-- HOJA DE VIDA --}}
                <div class="input-group mb-1 container-520">
                    <label for="urlhojadevida" style="cursor:pointer;"><u>Subir hoja de vida</u></label>
                    <h6 id="carga-h6" class="text-success" style="display:none;font-size:12px;">Hoja de vida cargada</h6>
                    <input class="form-control-file" type="file" name="urlhojadevida" id="urlhojadevida" onchange="previewhojadevida()" hidden>
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
                    <textarea class="form-control" name="notasdeperfil1" id="notasdeperfil1" rows="8" readonly>.</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">Confirmar</button>
            </div>
        </div>
    </div>            
</div>
@endsection
<!-- Begin Page Content -->
<div class="container-xl container-520"> 
    <div class="card shadow mb-4">
        <div class="card-body bg-gray-100">
            <div class="table-responsive text-gray-900">
                <form action="{{route('contactos.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- USERID --}}
                    <div class="input-group mb-1">
                        <input class="form-control" type="text" name="userid" value="{{ Auth::user()->id }}" required hidden>
                    </div>
                    {{-- FOTO DE PERFIL --}}
                    <div class="text-center">
                        <img src="https://www.intreasso.org/wp-content/uploads/user-4.png" class="rounded-circle foto-perfil-preview" id="framefotodeperfil">
                        <br>
                        <label for="urlfotoperfil" style="cursor:pointer;"><u>Subir foto</u></label>
                        <input class="form-control" type="file" id="urlfotoperfil" name="urlfotoperfil" onchange="previewfotodeperfil()" hidden>
                    </div>
                    {{-- ******** --}}
                    Etiquetas
                    <div class="input-group mb-1">
                        <select class="form-control multiselect" multiple name="etiqueta[]" id="etiqueta" data-placeholder="Compañía" required onchange="mostrarSubetiqueta(this)">
                            @foreach ($etiquetas as $id => $nombre)
                                <option value="{{ $id }}">{{ $nombre }}</option>
                            @endforeach
                        </select>
                        <div id="subetiqueta-container" style="display: none;">
                            <select class="form-control multiselect" multiple name="subetiqueta[]" id="subetiqueta" data-placeholder="Etiquetas">
                            </select>
                        </div>
                    </div>
                    {{-- ******** --}}
                    Nombres y Apellidos
                    <div class="input-group mb-1">
                        <input class="form-control" type="text" name="nombre" value="." required>
                    </div>
                    {{-- ******** --}}
                    Correo
                    <div class="input-group mb-1">
                        <input class="form-control" type="email" name="correo" value="sin@correo.com" required>
                    </div>
                    {{-- ******** --}}
                    Teléfono
                    <div id="telefonos-container">
                        <div class="input-group mb-1">
                            <input class="form-control telefono" type="text" id="telefono" name="telefono[]" value="+">
                            <div class="input-group-append">
                                <a href="" class="btn btn-primary text-gray-900 whatsapp-numero" id="llamada" target="_bank">Llamar ahora</a>
                                <a href="" class="btn btn-success text-gray-900 whatsapp-numero" id="linkwhatsapp" target="_bank">WhatsApp</a>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-4"></div>
                        <div class="col-8 text-right">
                            <button type="button" id="agregar-telefono">+ Agregar teléfono</button>
                        </div>
                    </div> --}}
                    <br>
                    {{-- ******** --}}
                    País de ubicación
                    <div class="input-group mb-1">
                        <select class="form-control" name="pais" aria-label=".form-select-lg example" required>
                            <option selected>Seleccione un país</option>
                            @foreach ($paises as $pais)
                                <option value="{{$pais->nombre}}">{{$pais->nombre}} ({{$pais->codigotelefono}})</option>
                            @endforeach
                        </select>                       
                    </div>
                    <br>
                    {{-- ******** --}}
                    Notas
                    <div class="form-outline mb-4">
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
                        <input class="form-control" name="nota" type="text" id="nota" placeholder="Escribir nota">
                        <div class="text-right">
                            <button type="button" onclick="agregarNota()">Agregar nota</button>
                        </div>
                        <br>
                        <textarea class="form-control" name="notas" id="notas" rows="8" readonly>.</textarea>
                        <textarea class="form-control" name="notasdeperfil" id="notasdeperfil" rows="8" readonly hidden>.</textarea>
                        <br>
                        <div class="text-center">
                            <button type="button" data-toggle="modal" data-target="#notasdeperfilmodal" class="btn btn-primary btn-md">Notas de perfil</button>
                        </div>
                    </div>
                    @yield('modal')
                    {{-- ******** --}}
                    Número de Identificación
                    <div class="input-group mb-1">
                        <input class="form-control" type="text" name="ndi" value="." required>
                    </div>
                    {{-- ******** --}}
                    Dirección y Ciudad
                    <div class="input-group mb-1">
                        <input class="form-control" type="text" name="ciudad" value="." required>
                    </div>
                    {{-- ******** --}}
                    Seguro Social
                    <div class="input-group mb-1">
                        <input class="form-control" type="text" name="segurosocial" value="." required>
                    </div>
                    {{-- ******** --}}
                    Profesión
                    <div class="input-group mb-1">
                        <input class="form-control" type="text" name="profesion" value="." required>
                    </div>
                    {{-- ******** --}}
                    Fecha de nacimiento
                    <input class="form-control" type="text" name="fechadecumpleanios" placeholder="02-03-1996" value="." onkeyup="agregarGuiones(this)" required>
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
                        <input class="form-control" type="text" id="status" name="status" value="Pendiente" required>
                        <select class="form-control" name="seguimiento">
                            <option value="Seguimiento" selected>Seguimiento</option>
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
                        <input class="form-control" type="text" name="referencia" value="." required>
                        <select class="form-control" name="referenciafuente">
                            <option value="Fuente" selected>Fuente</option>
                            <option value="Base de datos">Base de datos</option>
                            <option value="Facebook">Facebook</option>
                            <option value="Instagram">Instagram</option>
                            <option value="Tiktok">Tiktok</option>
                            <option value="Google">Google</option>
                            <option value="Correo">Correo</option>
                            <option value="Portales">Portales</option>
                            <option value="Formulario web">Formulario web</option>
                            <option value="Feria Inmobiliaria">Feria Inmobiliaria</option>
                            <option value="8x8 Work">8x8 Work</option>
                            <option value="WhatsApp">WhatsApp</option>
                            <option value="Emisora">Emisora</option>
                            <option value="Valla Publicitaria">Valla publicitaria</option>
                        </select>
                    </div>
                    {{-- ******** --}}
                    Tipo de Afiliación 
                    <div class="input-group mb-1">
                        <input class="form-control" type="text" name="tipodeafiliacion" value="." required>
                    </div>
                    {{-- ******** --}}
                    Fecha de Afiliación intREasso
                    <div class="input-group mb-1">
                        <input class="form-control" type="text" name="fechadeafiliacionintreasso" placeholder="01-01-2020" value="." onkeyup="agregarGuiones(this)" required>
                    </div> 
                    {{-- ******** --}}
                    Eventos confirmados para participar
                    <div class="input-group mb-1">
                        <select class="form-control multiselect" multiple name="evento[]" id="evento" data-placeholder="Eventos">
                            @foreach ($eventos as $id => $nombre)
                                <option value="{{ $id }}">{{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div> 
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Agregar contacto</button>
                    </div>
                </form>


            </div>
        </div>
    </div>

    
</div>

<!-- Aparecer Formularios -->
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<!-- Agrega el archivo del plugin multiselect -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

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
{{-- AGREGAR TELÉFONO --}}
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        const telefonosContainer = document.getElementById('telefonos-container');

        // Función para actualizar los enlaces de Llamada y WhatsApp
        const actualizarEnlaces = (telefonoInput, linkLlamada, linkWhatsapp) => {
            const telefonoSinMas = telefonoInput.value.slice(1);
            linkLlamada.href = `tel:${telefonoSinMas}`;
            linkWhatsapp.href = `https://api.whatsapp.com/send?phone=${telefonoSinMas}`;
        }

        // Función para agregar un nuevo campo de teléfono
        const agregarTelefono = () => {
            const nuevoInputGroup = document.createElement('div');
            nuevoInputGroup.classList.add('input-group', 'mb-1');

            const nuevoTelefono = document.createElement('input');
            nuevoTelefono.classList.add('form-control', 'telefono');
            nuevoTelefono.type = 'text';
            nuevoTelefono.name = 'telefono[]';
            nuevoTelefono.value = '+';
            nuevoTelefono.addEventListener('input', () => {
                actualizarEnlaces(nuevoTelefono, nuevoLinkLlamada, nuevoLinkWhatsapp);
            });

            const nuevoInputGroupAppend = document.createElement('div');
            nuevoInputGroupAppend.classList.add('input-group-append');

            const nuevoLinkLlamada = document.createElement('a');
            nuevoLinkLlamada.href = '';
            nuevoLinkLlamada.classList.add('btn', 'btn-primary', 'text-gray-900', 'whatsapp-numero', 'llamada');
            nuevoLinkLlamada.target = '_bank';
            nuevoLinkLlamada.textContent = 'Llamar ahora';
            nuevoLinkLlamada.addEventListener('click', (event) => {
                event.preventDefault();
                window.open(nuevoLinkLlamada.href, '_blank');
            });

            const nuevoLinkWhatsapp = document.createElement('a');
            nuevoLinkWhatsapp.href = '';
            nuevoLinkWhatsapp.classList.add('btn', 'btn-success', 'text-gray-900', 'whatsapp-numero', 'linkwhatsapp');
            nuevoLinkWhatsapp.target = '_bank';
            nuevoLinkWhatsapp.textContent = 'WhatsApp';
            nuevoLinkWhatsapp.addEventListener('click', (event) => {
                event.preventDefault();
                window.open(nuevoLinkWhatsapp.href, '_blank');
            });

            nuevoInputGroupAppend.appendChild(nuevoLinkLlamada);
            nuevoInputGroupAppend.appendChild(nuevoLinkWhatsapp);

            nuevoInputGroup.appendChild(nuevoTelefono);
            nuevoInputGroup.appendChild(nuevoInputGroupAppend);

            telefonosContainer.appendChild(nuevoInputGroup);

            actualizarEnlaces(nuevoTelefono, nuevoLinkLlamada, nuevoLinkWhatsapp);
        }

        // Agregar un nuevo campo de teléfono al hacer clic en el botón "Agregar teléfono"
        const agregarTelefonoButton = document.getElementById('agregar-telefono');
        agregarTelefonoButton.addEventListener('click', agregarTelefono);

        // Actualizar los enlaces de Llamada y WhatsApp al cambiar el valor del campo de teléfono
        const telefonosInputs = document.querySelectorAll('.telefono');
        telefonosInputs.forEach((telefonoInput) => {
            const linkLlamada = telefonoInput.parentNode.querySelector('.llamada');
            const linkWhatsapp = telefonoInput.parentNode.querySelector('.linkwhatsapp');

            telefonoInput.addEventListener('input', () => {
                actualizarEnlaces(telefonoInput, linkLlamada, linkWhatsapp);
            });
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
                    text: subetiqueta.nombre
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


        // Borrar el contenido del input
        document.getElementById("nota").value = "";
        document.getElementById("select").selectedIndex = 0;

        // Mover el scroll hacia arriba
        notas.scrollTop = 0;
    }
</script>
{{-- NOTAS DE PERFIL --}}
<script>
    function agregarNotadeperfil() {
        // Obtener la fecha actual
        var fecha = new Date();

        // Formatear la fecha como "DD/MM/YYYY HH:MM:SS"
        var fechaFormateada = fecha.toLocaleString();
        
        // Obtener el valor del input
        var valor = document.getElementById("notadeperfil").value;


        // Agregar el valor al textarea
        var notasdeperfil1 = document.getElementById("notasdeperfil1");
        notasdeperfil1.value = valor + "\n" + notasdeperfil1.value;
        // Agregar el valor al textarea
        var notasdeperfil = document.getElementById("notasdeperfil");
        notasdeperfil.value = valor + "\n" + notasdeperfil.value;


        // Borrar el contenido del input
        document.getElementById("notadeperfil").value = "";
        document.getElementById("select").selectedIndex = 0;

        // Mover el scroll hacia arriba
        notasdeperfil.scrollTop = 0;
        
    }
</script>
{{-- FOTO DE PERFIL --}}
<script>
    function previewfotodeperfil() {
        framefotodeperfil.src = URL.createObjectURL(event.target.files[0]);
    }
    function clearImage() {
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
    function previewidentifiacion() {
        frameidentificacion.src = URL.createObjectURL(event.target.files[0]);
    }
    function clearImage() {
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