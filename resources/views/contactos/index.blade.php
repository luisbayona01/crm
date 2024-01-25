@extends('layouts.plantilla')
@section('content')    
{{-- MODAL CUMPLEAÑOS --}}
<div class="modal fade" id="cumpleaniosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CUMPLEAÑOS</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 style="font-size: 14px;">
                    @foreach($contactoscumpleanios as $contacto)
                        <a href="{{route('contactos.edit', $contacto)}}" class="text-gray-900">{{$contacto->nombre}} - ¡HOY! &nbsp;&nbsp;</a> <i class="fas fa-fw fa-birthday-cake" style="color:#ff88bd;"></i> &nbsp;&nbsp;
                        <br>
                    @endforeach
                    @foreach($contactoscumpleaniosmaniana as $contacto)
                        <a href="{{route('contactos.edit', $contacto)}}" class="text-gray-900">{{$contacto->nombre}} - ¡MAÑANA! &nbsp;&nbsp;</a> <i class="fas fa-fw fa-birthday-cake" style="color:#ff88bd;"></i> &nbsp;&nbsp;
                        <br>
                    @endforeach
                </h6>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>            
</div>
{{-- MODAL CONTACTOS DUPLICADOS --}}
<div class="modal fade" id="duplicadosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CONTACTOS DUPLICADOS</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table text-gray-900" width="100%" cellspacing="0" style="font-size: 14px;">
                    <thead>
                        <tr class="text-center cursor-pointer text-truncate">
                            <th class="">Teléfono</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($contactosDuplicados as $contacto)
                        <tr class="text-center">
                            <td class="text-truncate" style="max-width:100px;">
                                <a href="https://crm.intreasso.org/search?query={{$contacto->telefono}}" class="text-gray-900 whatsapp-numero">
                                    {{$contacto->telefono}} 
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>            
</div>
{{-- MODAL CONTACTOS QUE SE VENCE MEMBRESÍA --}}
<div class="modal fade" id="vencermembresiamodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PRONTO A VENCER</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 style="font-size: 14px;">
                    @foreach($vencemembresiahoy as $contacto)
                        <a href="{{route('contactos.edit', $contacto)}}" class="text-gray-900">{{$contacto->nombre}} - ¡HOY! </a>
                        <br>
                    @endforeach
                    @foreach($vencemembresia10dias as $contacto)
                        <a href="{{route('contactos.edit', $contacto)}}" class="text-gray-900">{{$contacto->nombre}} - ¡EN 10 DÍAS! </a>
                        <br>
                    @endforeach
                </h6>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>            
</div>
{{-- MODAL FILTRO --}}
<div class="modal fade" id="filtromodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <form action="{{ route('contactos.search') }}" method="GET" class="form-inline">
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-1">
                                    <input type="text" name="nombre" placeholder="Nombre y Apellido">
                                </div>
                            </div>
                            <div class="col-6">
                                <select name="referencia">
                                    <option value="">Referido Por</option>
                                    @foreach ($users as $user)
                                        @if ($user->username !== 'admin')
                                            <option value="{{$user->username}}">{{$user->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-1">
                                    <input type="text" name="status" placeholder="Status">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-1">
                                    <select name="seguimiento">
                                        <option value="">Seguimiento por</option>
                                        @foreach ($users as $user)
                                            @if ($user->username !== 'admin')
                                                <option value="{{$user->username}}">{{$user->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-1">
                                    <div class="input-group mb-1">
                                        <input type="text" name="pais" placeholder="País">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-1">
                                    <select name="referenciafuente">
                                        <option value="" selected>Fuente del contacto</option>
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
{{-- MODAL FILTRO --}}
<div class="modal fade" id="filtromodal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">OPCIONES DE EXPORTAR</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="{{ route('contactos.search') }}" method="GET" class="form-inline">
                        <div class="row">
                           
                           
                        @if(request()->has('etiqueta'))
                        <a href="{{ route('index.contactos2', ['etiqueta' => request()->input('etiqueta')]) }}" class="btn btn-primary" >
                        <i  class='fas'>&#xf093;</i>
                        <span >Exportar por crm</span>
                        </a>
                        @endif

                        @if(request()->has('subetiqueta'))
                        <a href="{{ route('index.contactos2', ['subetiqueta' => request()->input('subetiqueta')]) }}" class="btn btn-primary" >
                        <i  class='fas'>&#xf093;</i>
                        <span >Exportar por crm</span>
                        </a>
                        @endif
                        &nbsp;&nbsp;



                        @if(request()->has('etiqueta'))
                        <a href="{{ route('index.contactos', ['etiqueta' => request()->input('etiqueta')]) }}" class="btn btn-primary" >
                        <i  class='fas'>&#xf093;</i>
                        <span >Exportar para contactos de google</span>
                        </a>
                        @endif

                        @if(request()->has('subetiqueta'))
                        <a href="{{ route('index.contactos', ['subetiqueta' => request()->input('subetiqueta')]) }}" class="btn btn-primary" >
                        <i  class='fas'>&#xf093;</i>
                        <span >Exportar para contactos de google</span>
                        </a>
                        @endif




                          
                          
                    
                        </div>
                        <br><br><br>
                     
                    </form>
                </div> 
            </div>
        </div>
    </div>            
</div>
{{-- MODAL FILTRO --}}
<div class="modal fade" id="filtromodal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">OPCIONES DE EXPORTAR</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="{{ route('contactos.search') }}" method="GET" class="form-inline">
                        <div class="row">
                        
                            @if(request()->has('etiqueta'))
                            <a href="{{route('contacts.index')}}" class="btn btn-primary" >
                            <i  class='fas'>&#xf019;</i>
                            <span >Importar por crm</span>
                            </a>
                            @endif


                            @if(request()->has('subetiqueta'))
                            <a href="{{route('contactosporsubetiqueta.index')}}" class="btn btn-primary" >
                            <i  class='fas'>&#xf019;</i>
                            <span >Importar por crm</span>
                            </a>
                            @endif


                            &nbsp;&nbsp;

                            @if(request()->has('etiqueta'))
                            <a href="{{route('contactosgoogleporetiqueta.index')}}" class="btn btn-primary" >
                            <i  class='fas'>&#xf019;</i>
                            <span class="">Importar por contactos de google</span>
                            </a>
                            @endif



                            @if(request()->has('subetiqueta'))
                            <a href="{{route('contactosgoogleporsubetiqueta.index')}}" class="btn btn-primary" >
                            <i  class='fas'>&#xf019;</i>
                            <span >Importar para contactos de google</span>
                            </a>
                            @endif




                          
                          
                    
                        </div>
                        <br><br><br>
                     
                    </form>
                </div> 
            </div>
        </div>
    </div>            
</div>
<!-- Content Row 1 -->
<div class="row">
    <div class="col-xl-12">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            {{-- NOTIFICACIONES --}}
            <div class="card-header py-3 bg-gray-100">
                <div class="row">
                    <div class="col-sm-3 d-flex align-items-center">
                        <div class="row">
                            <div class="col-xl-12 text-center">
                                {{-- CUMPLEAÑOS --}}
                                @if (!empty($contactoscumpleanios) || !empty($contactoscumpleaniosmaniana))
                                    @if(count($contactoscumpleanios) > 0 || count($contactoscumpleaniosmaniana) > 0)
                                        <h6 style="font-size: 14px;">
                                            <i class="fas fa-fw fa-birthday-cake" style="color:#ff88bd;"></i> &nbsp;&nbsp;
                                            <a href="#" data-toggle="modal" data-target="#cumpleaniosmodal" class="text-gray-900">CUMPLEAÑOS</a> &nbsp;&nbsp;
                                            <i class="fas fa-fw fa-birthday-cake" style="color:#ff88bd;"></i> &nbsp;&nbsp;
                                        </h6>
                                    @endif
                                @endif
                                {{-- CONTACTOS DUPLICADOS --}}
                                @if(count($contactosDuplicados) > 0)
                                    <h6 style="font-size: 14px;">
                                        <a href="#" data-toggle="modal" data-target="#duplicadosmodal" class="text-gray-900">CONTACTOS DUPLICADOS</a>
                                    </h6>
                                @endif
                                {{-- CONTACTOS QUE SE VENCEN MEMBRESÍA --}}
                                @if (!empty($vencemembresiahoy) || !empty($vencemembresia10dias))
                                    @if(count($vencemembresiahoy) > 0 || count($vencemembresia10dias) > 0)
                                        <h6 style="font-size: 14px;">
                                            <a href="#" data-toggle="modal" data-target="#vencermembresiamodal" class="text-gray-900">MEMBRESÍA A VENCER</a>
                                        </h6>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 text-right">
                        <!-- Search form -->
                        <form action="{{ route('contactos.search') }}" method="GET" class="form-inline d-flex justify-content-center md-form form-sm mt-0">
                            <i id="search-icon" class="fas fa-search text-primary" aria-hidden="true" style="cursor: pointer;"></i>
                            <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search" aria-label="Search" name="query" id="search_input" value="{{ $query ?? '' }}">
                            &nbsp;&nbsp;
                            <a href="#" data-toggle="modal" data-target="#filtromodal" class="btn btn-primary">+ Filtro</a>
                        </form>                        
                    </div>
                    <div class="col-sm-3 text-right">
                        <div class="d-sm-none">
                            <br>
                        </div>
                        <a href="{{route('contactos.create')}}" class="btn btn-primary">+ Agregar contacto</a>
                        @if(request()->has('etiqueta'))
                            <a href="#" data-toggle="modal" data-target="#filtromodal1" class="btn btn-primary">
                            <i  class='fas'>&#xf093;</i>
                            <span class="hover-text">Exportar</span>
                            </a>
                        @endif
                        @if(request()->has('subetiqueta'))
                            <a href="#" data-toggle="modal" data-target="#filtromodal1" class="btn btn-primary">
                            <i  class='fas'>&#xf093;</i>
                            <span class="hover-text">Exportar</span>
                            </a>
                        @endif
                        @if(request()->has('etiqueta'))
                            <a href="#" data-toggle="modal" data-target="#filtromodal2" class="btn btn-primary">
                            <i  class='fas'>&#xf019;</i>
                            <span class="hover-text1">Importar</span>
                            </a>
                        @endif
                        @if(request()->has('subetiqueta'))
                            <a href="#" data-toggle="modal" data-target="#filtromodal2" class="btn btn-primary">
                            <i  class='fas'>&#xf019;</i>
                            <span class="hover-text1">Importar</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="card-body bg-gray-100">
                <div class="table-responsive">
                    <table class="table text-gray-900" id="dataTable" data-order='[[ 1, "asc" ]]' width="100%" cellspacing="0" style="font-size: 14px;">
                        <thead>
                            <tr class="text-center cursor-pointer text-truncate">
                                <th class="d-none d-sm-table-cell">Línea</th>
                                <th class="">Nombre</th>
                                <th class="">Teléfono</th>
                                <th class="d-none d-sm-table-cell">Correo</th>
                                <th class="d-none d-sm-table-cell">País</th>
                                <th class="d-none d-sm-table-cell">Status</th>
                                <th class="d-none d-sm-table-cell">Actualización</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($contactos as $contacto)
                            <tr class="text-center">
                                <td class="text-left text-truncate d-none d-sm-table-cell" style="max-width:5px;">
                                    @foreach($contacto->etiquetas as $etiqueta)
                                        <span>{{substr($etiqueta->nombre, 0, 2)}}</span>
                                    @endforeach
                                </td>
                                <td class="text-left text-truncate" style="max-width:180px;">
                                    <a href="{{route('contactos.edit', $contacto)}}" class="text-gray-900">
                                        <img src="{{ asset(str_replace('public', 'storage', $contacto->urlfotoperfil)) }}" width="25" height="25" class="rounded-circle">
                                        &nbsp;
                                        {{$contacto->nombre}}
                                    </a>
                                </td>
                                <td class="text-truncate" style="max-width:100px;">
                                    <?php
                                        $telefono = $contacto->telefono;
                                        $parte1 = substr($telefono, -4);
                                        $parte2 = substr($telefono, -7, 3);
                                        $parte3 = substr($telefono, -10, 3);
                                        $codigoPais = substr($telefono, 0, strlen($telefono) - 10);
                                    ?>
                                    <a href="https://api.whatsapp.com/send?phone={{substr($telefono, 1)}}&text=" target="_bank" class="text-gray-900 whatsapp-numero">
                                        {{$codigoPais . $parte3 . '-' . $parte2 . '-' . $parte1}}
                                    </a>
                                </td>
                                <td class="text-truncate d-none d-sm-table-cell" style="max-width:100px;">
                                    {{$contacto->correo}}
                                </td>
                                <td class="text-truncate d-none d-sm-table-cell" style="max-width:100px;">
                                   {{$contacto->pais}}
                                </td>
                                <td class="text-truncate d-none d-sm-table-cell" style="max-width:100px;">{{$contacto->status}}</td>
                                <td class="text-truncate d-none d-sm-table-cell" style="max-width:2px;">{{$contacto->updated_at->format('d-m-y H:i')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if(request()->has('etiqueta') || (request()->is('search') && request()->has('query')))
                    <div class="pagination-contactos2 text-center">
                        {{ $contactos->links() }}
                    </div>
                    @if(!request()->is('search') || (request()->is('search') && request()->has('query')))
                        <div class="text-center">
                            <a href="{{ request()->fullUrlWithQuery(['page' => request()->input('page', 1) + 1]) }}">
                                <button type="button">Siguiente página</button>
                            </a>
                        </div>
                    @endif
                @else
                    <div class="pagination-contactos">
                        {{ $contactos->links() }}
                    </div>
                @endif
            </div>
        </div>
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
{{-- TABLA --}}
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            "pageLength": 50,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
            }
        });
    });
</script>
@endsection