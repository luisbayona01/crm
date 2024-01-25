<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="intREasso">
    <meta name="author" content="intREasso">
    <title>intREasso</title>
    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/css/bootstrap-multiselect.min.css" integrity="sha512-fZNmykQ6RlCyzGl9he+ScLrlU0LWeaR6MO/Kq9lelfXOw54O63gizFMSD5fVgZvU1YfDIc6mxom5n60qJ1nCrQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{asset('img/logo.png')}}" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">



<script>
var conn;
 // Tu código de inicialización, por ejemplo, al cargar la página
    var userId = btoa('{{ Auth::user()->id }}');
    console.log('idqueenvia',userId)
var hostname = window.location.hostname;
    var storedConnectionInfo = localStorage.getItem('websocketConnectionInfo');
    var connectionInfo = storedConnectionInfo ? JSON.parse(storedConnectionInfo) : null;
  conn = connectionInfo ? new WebSocket(connectionInfo.url) : new WebSocket('ws://localhost:8080/?token=' + userId);


conn.onopen = function(e) {
        console.log("Connection established!");
        localStorage.setItem('websocketConnectionInfo', JSON.stringify({ url: conn.url }));
        // ... otras acciones que desees realizar cuando se abra la conexión
    };

    /*conn.onclose = function(e) {
        console.log("Connection closed!");
        localStorage.removeItem('websocketConnectionInfo');
        // ... otras acciones que desees realizar cuando se cierre la conexión
    };*/

    /*conn.onmessage = function(event) {
        // Manejar mensajes del servidor
        console.log('Mensaje del servidor:', event.data);
        // ... otras acciones que desees realizar al recibir mensajes del servidor
    }*/

    // ... otras configuraciones o funciones de inicialización

 console.log('dentro del load',conn)
 conn.onmessage = function(event) {
        // Manejar mensajes del servidor
        console.log('Mensaje del servidor:', event.data);
        // ... otras acciones que desees realizar al recibir mensajes del servidor
    };

    conn.onerror = function (error) {
    console.error("WebSocket error:", error);
};
function logoutAndCloseWebSocket() {
    console.log(conn);

  conn.send(JSON.stringify({ type: 'logout', userId: userId }))
    conn.onclose = function(e) {
        console.log("Connection closed!");
        localStorage.removeItem('websocketConnectionInfo'); // Elimina la información de la conexión al cerrarse
    };

    conn.onmessage = function(event) {
        // Manejar mensajes del servidor, por ejemplo, confirmación de logout
        console.log('Mensaje del servidor:', event.data);

        // Cerrar la conexión después de recibir la confirmación del servidor
        //conn.close();
    };
     localStorage.clear();
    document.getElementById('logout-form').submit();
}


async function notificacion() {
    try {
        // Lógica síncrona aquí...

        const idUsuario = '{{ Auth::user()->id }}'; // Reemplaza esto con el ID de usuario adecuado

        // Lógica asíncrona para obtener la cantidad de mensajes no leídos
        const response = await fetch(`/contarmensagesnoleidos/${idUsuario}`);

        if (!response.ok) {
            throw new Error(`Error de red: ${response.status}`);
        }

        const data = await response.json();
        // Aquí puedes trabajar con los datos recibidos
        console.log('Cantidad de mensajes no leídos:', data.contarmenssageU);
         document.getElementById('noficamensajes').innerHTML ="";
        document.getElementById('noficamensajes').innerHTML =data.contarmenssageU;
         document.getElementById('noficamensajes').classList.remove('d-none');
        // Puedes hacer algo con la cantidad de mensajes, por ejemplo, mostrarlo en la interfaz de usuario
        //console.log('Cantidad total de mensajes no leídos:', data.cantidad);

        // Más lógica síncrona si es necesario...

        //console.log('Hola desde la función de notificacion');
    } catch (error) {
        // Manejo de errores aquí
        console.error('Error en la función de notificacion:', error);
    }
}
</script>

</head>
<body id="page-top">

    @hasrole('user|afiliado|admin')

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Preparado para salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Salir" a continuación si está listo para terminar su sesión actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
                    <!-- Authentication -->
                    <form method="POST" action="{{route('logout') }}" id="logout-form">
                        @csrf

                <x-responsive-nav-link href="#" onclick="event.preventDefault();logoutAndCloseWebSocket(event)">
    {{ __('Salir') }}
</x-responsive-nav-link>
                    </form>


                    {{-- <a class="btn btn-primary" href="login.html">Logout</a> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL NECESITAS AFILIARTE --}}
    <div class="modal fade" id="necesitasafiliartemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CONTENIDO SOLO PARA FILIADOS</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <a href="https://www.intreasso.org/servicios-y-beneficios-intreasso/" type="submit" class="btn btn-amarillo btn-lg btn-block" >AFILIARSE AHORA</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar bg-gray-100 accordion toggled" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a href="/" class="sidebar-brand d-flex align-items-center justify-content-center text-gray-900" >
                <img src="{{asset('img/logo.png')}}" width="27px" style="margin-top:-9px;" alt="intREasso">
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a href="/" class="nav-link text-gray-900" >
                    <i class="fas fa-fw fa-home"></i>
                    <span>INICIO</span>
                </a>
            </li>

            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a href="{{route('agentes.index')}}" class="nav-link text-gray-900">
                    <i class="fas fa-fw fa-users"></i>
                    <span>AGENTES</span>
                </a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a href="{{route('iachat.index')}}" class="nav-link text-gray-900">
                    <i class="fas fa-fw fa-comment"></i>
                    <span>IA CHAT</span>
                </a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a href="{{route('propiedades.index')}}" class="nav-link text-gray-900">
                    <i class="fas fa-fw fa-laptop-house"></i>
                    <span>MLS</span>
                </a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item text-center">
                <span>EDUCACIÓN</span>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                @hasrole('afiliado|admin')
                <a href="{{route('campus.index')}}" class="nav-link text-gray-900">
                @else
                <a data-toggle="modal" data-target="#necesitasafiliartemodal" class="nav-link text-gray-900 cursor-pointer">
                @endhasrole
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>CAMPUS</span>
                </a>
            </li>
            <li class="nav-item active">
                @hasrole('afiliado|admin')
                <a href="{{route('capacitaciones.index')}}" class="nav-link text-gray-900">
                @else
                <a data-toggle="modal" data-target="#necesitasafiliartemodal" class="nav-link text-gray-900 cursor-pointer">
                @endhasrole
                    <i class="fas fa-graduation-cap"></i>
                    <span>CAPACITACIÓN</span>
                </a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item text-center">
                <span>CRM</span>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                @hasrole('afiliado|admin')
                <a href="{{route('eventos.index')}}" class="nav-link text-gray-900">
                @else
                <a data-toggle="modal" data-target="#necesitasafiliartemodal" class="nav-link text-gray-900 cursor-pointer">
                @endhasrole
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>MIS EVENTOS</span>
                </a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                @hasrole('afiliado|admin')
                <a href="{{route('etiquetas.index')}}" class="nav-link text-gray-900">
                @else
                <a data-toggle="modal" data-target="#necesitasafiliartemodal" class="nav-link text-gray-900 cursor-pointer">
                @endhasrole
                    <i class="fas fa-address-book"></i>
                    <span>CONTACTOS</span>
                </a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">

                @hasrole('afiliado|admin')
                    @isset($paginaweb)
                        <a href="{{route('paginaswebs.show', $paginaweb->id)}}" class="nav-link text-gray-900">
                            <i class="fas fa-desktop"></i>
                            <span>MI WEBSITE</span>
                        </a>
                    @else
                        <a href="{{route('paginaswebs.create')}}" class="nav-link text-gray-900">
                            <i class="fas fa-desktop"></i>
                            <span>MI WEBSITE</span>
                        </a>
                    @endisset
                @else
                <a data-toggle="modal" data-target="#necesitasafiliartemodal" class="nav-link text-gray-900 cursor-pointer">

                    <i class="fas fa-desktop"></i>
                    <span>MI WEBSITE</span>
                </a>
                @endhasrole
            </li>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        {{-- ESPACIO DE LA PLANTILLA --}}
        <ul class="navbar-nav d-none d-md-table-cell bg-gray-100 accordion toggled" id="accordionSidebar">
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link text-gray-900">
                    <i class="fas fa-fw fa-users"></i>
                    <span>USUARIOS</span>
                </a>
            </li>
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-gray-100 topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3 d-none d-md-table-cell">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

<li class="nav-item dropdown no-arrow" id="customDropdown">

     <a class="nav-link text-gray-900 dropdown-toggle" href="{{url('/rooms')}}" id="contactanosDropdown" role="button"  aria-haspopup="true" aria-expanded="false">
        <i class="far fa-comment-alt"></i>
      <b style="font-size: 12px; position: absolute; left: 20px; top: 18px;" class="badge badge-danger rounded-pill d-none" id="noficamensajes"></b>
    </a>


</li>
        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link text-gray-900 dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="far fa-bell"></i>
                                <b style="font-size:12px;position:absolute;left:22px;top: 15px;">0</b>
                            </a>
                        </li>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link text-gray-900 dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset(str_replace('public', 'storage', Auth::user()->urlfotoperfil)) }}" width="25" height="25" class="rounded-circle">
                                &nbsp;
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('usuarios.show', Auth::user())}}">
                                    <i class="fas fa-user fa-sm fa-fw"></i>
                                    {{Auth::user()->name}}
                                </a>
                                @hasrole('admin')
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('publicacions.index')}}">
                                    <i class="fas fas fa-unlock fa-sm fa-fw"></i>
                                    Publicaciones
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('usuarios.index')}}">
                                    <i class="fas fas fa-unlock fa-sm fa-fw"></i>
                                    Usuarios
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('countries.index')}}">
                                    <i class="fas fas fa-unlock fa-sm fa-fw"></i>
                                    Países
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('paginaswebs.index')}}">
                                    <i class="fas fas fa-unlock fa-sm fa-fw"></i>
                                    Páginas web
                                </a>
                                @endhasrole
                                <div class="d-block d-sm-none">
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('campus.index')}}">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                        Campus Virtual
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('capacitaciones.index')}}">
                                        <i class="fas fa-graduation-cap fa-sm fa-fw"></i>
                                        Capacitaciones
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('eventos.index')}}">
                                        <i class="fas fa-calendar fa-sm fa-fw"></i>
                                        Mis Eventos
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('contactos.index')}}">
                                        <i class="fas fa-address-book"></i>
                                        Mis Contactos
                                    </a>
                                </div>
                                <div class="dropdown-divider"></div>

                                @isset($paginaweb)
                                    <a class="dropdown-item" href="{{route('paginaswebs.show', $paginaweb->id)}}">
                                        <i class="fas fa-desktop"></i>
                                        Mi Website
                                    </a>
                                @else
                                    <a class="dropdown-item" href="{{route('paginaswebs.create')}}">
                                        <i class="fas fa-desktop"></i>
                                        Mi Website
                                    </a>
                                @endisset

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('usuarios.edit', Auth::user())}}">
                                    <i class="fa">&#xf013;</i>
                                    Cuenta
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('contactanos.index')}}">
                                    <i class="fas fa-sm fa-fw fa-question-circle"></i>
                                    Ayuda
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sm fa-fw fa-sign-out-alt"></i>
                                    Salir
                                </a>
                            </div>
                        </li>

                    </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid bg-light">
                    <br><br>
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <div class="d-md-none">
                <br><br>
            </div>
            <!-- Tabs Menú-->
            <div class="container-fluid menu-movil d-md-none text-center bg-gray-100">
                <div class="row ">
                    <div class="col active">
                        <a class="nav-link text-gray-900" href="/">
                            <i class="fas fa-fw fa-home"></i>
                            <br>
                            <span>INICIO</span>
                        </a>
                    </div>
                    <div class="col active">
                        <a class="nav-link text-gray-900" href="{{route('agentes.index')}}">
                            <i class="fas fa-fw fa-users"></i>
                            <br>
                            <span>AGENTES</span>
                        </a>
                    </div>
                    <div class="col active">
                        <a class="nav-link text-gray-900" href="{{route('iachat.index')}}">
                            <i class="fas fa-fw fa-comment"></i>
                            <br>
                            <span>IA CHAT</span>
                        </a>
                    </div>
                    <div class="col active">
                        <a class="nav-link text-gray-900" href="{{route('propiedades.index')}}">
                            <i class="fas fa-fw fa-laptop-house"></i>
                            <br>
                            <span>MLS</span>
                        </a>
                    </div>
                    <div class="col active">
                        <a class="nav-link text-gray-900" href="{{route('usuarios.show', Auth::user())}}">
                            <i class="fas fa-fw fa-user"></i>
                            <br>
                            <span>PERFIL</span></a>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-gray-100 d-none d-md-table-cell">
                <div class="container my-auto">
                    <div class="copyright text-center text-gray-900 my-auto">
                        <span>intREasso © 2020-{{date('Y')}} USA &nbsp;|&nbsp;
                            <a href="{{route('versions.index')}}" class="text-gray-900">
                                @isset($ultimaVersion)
                                    V {{ $ultimaVersion->version }}
                                @endisset
                            </a>
                        </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>

        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    @else
        <!-- Begin Page Content -->
        <div class="container-fluid bg-light">
            <br><br>
            @yield('content')
        </div>
        <!-- /.container-fluid -->
    @endhasrole
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>






    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>

    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/js/bootstrap-multiselect.min.js" integrity="sha512-lxQ4VnKKW7foGFV6L9zlSe+6QppP9B2t+tMMaV4s4iqAv4iHIyXED7O+fke1VeLNaRdoVkVt8Hw/jmZ+XocsXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Core plugin JavaScript-->
<script src="{{asset('js/roomchat.js')}}"></script>
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    <script>
notificacion()
        if ($(window).width() < 520 && !$(".sidebar").hasClass("toggled")) {
            $("body").addClass("sidebar-toggled");
            $(".sidebar").addClass("toggled");
            $('.sidebar .collapse').collapse('hide');
        }
    </script>
    <!-- Page level plugins -->
   {{--
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>
--}}
{{-- Comentario: Estos scripts están generrando errores --}}
    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    <!-- Tu script de cambio de tema -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var temaUsuario = "{{ Auth::user()->temaplantilla }}";
            var elementosConClase900 = document.querySelectorAll('.bg-gray-100');
            var elementosConClase100 = document.querySelectorAll('.text-gray-900');

            if (temaUsuario === 'Oscuro') {
                // Cambia las clases a modo oscuro
                elementosConClase900.forEach(function(elemento) {
                    elemento.classList.remove('bg-gray-100');
                    elemento.classList.add('bg-gray-900');
                });
                elementosConClase100.forEach(function(elemento) {
                    elemento.classList.remove('text-gray-900');
                    elemento.classList.add('text-gray-100');
                });
            }
        });
    </script>
    {{-- MENSAJE --}}
    <script>
       /* document.getElementById('aparecermensaje').style.display = "none";
        function copiarAlPortapapeles(id_elemento) {
            var aux = document.createElement("input");
            aux.setAttribute("value", document.getElementById(id_elemento).innerHTML);
            document.body.appendChild(aux);
            aux.select();
            document.execCommand("copy");
            document.body.removeChild(aux);
            document.getElementById('aparecermensaje').style.display = "initial";
        }*/
    </script>
    {{-- No clic 2 --}}
    {{-- <script type='text/javascript'>
        document.oncontextmenu = function(){return false}
    </script> --}}
</body>
</html>
