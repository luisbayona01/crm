@extends('layouts.plantilla')

@section('template_title')
@endsection

@section('content')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTsc8BTf3HZi3UCud4ZbS6or3SKm1lrZg"></script>


    <script>
        const geocoder = new google.maps.Geocoder();

        // Geocodifica la dirección
        const address = "{{ $adrressC }}";
        geocoder.geocode({
            address: address,
        }, (results, status) => {
            // Verifica el estado de la respuesta
            if (status === google.maps.GeocoderStatus.OK) {
                // Obtén la latitud y la longitud
                const lat = results[0].geometry.location.lat();
                const lng = results[0].geometry.location.lng();

                // Crea un mapa
                const map = new google.maps.Map(document.getElementById("map"), {
                    center: {
                        lat,
                        lng
                    },
                    zoom: 18,
                });

                // Agrega el mercado al mapa
                const marker = new google.maps.Marker({
                    position: {
                        lat,
                        lng
                    },
                    title: "{{ $propiedad->titulo }}",
                    // Agrega una imagen al marcador
                    icon: {
                        url: "{{ asset(url('img/logo.png')) }}",
                        // Cambia el tamaño de la imagen
                        scaledSize: new google.maps.Size(50, 50),
                    },
                });
                marker.setMap(map);
                const streetView = new google.maps.StreetViewPanorama(
                    document.getElementById("streetView"), {
                        position: {
                            lat,
                            lng
                        },
                    },
                );
                streetView.setVisible(true);

                // Agrega información adicional al panorama
                streetView.getPano().setPanoMetadata({
                    // Título del panorama
                    title: "{{ $propiedad->titulo }}",
                    // Descripción del panorama
                    //description: "Este panorama muestra el mercado de Bogotá",
                });

            } else {
                // Muestra un error
                alert("Error de geocodificación: " + status);
            }



        });
    </script>
    <section class="content container">
        <!-- Inicio de la sección de contenido -->

        <div class="row">
            <!-- Inicio de la fila -->
            <div class="col-lg-10">
                <!-- Inicio de la columna de tamaño grande (10) -->

                <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
                    <!-- Inicio de la barra de navegación con píldoras -->
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"
                        aria-controls="v-pills-home" aria-selected="true">galeria</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab"
                        aria-controls="v-pills-profile" aria-selected="false">ubicacion</a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab"
                        aria-controls="v-pills-messages" aria-selected="false">recorrido</a>
                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab"
                        aria-controls="v-pills-settings" aria-selected="false">video</a>
                </div>
                <!-- Fin de la barra de navegación con píldoras -->

            </div>
            <!-- Fin de la columna de tamaño grande (10) -->
        </div>
        <!-- Fin de la fila -->

        <div class="tab-content" id="v-pills-tabContent">
            <!-- Inicio del contenido de píldoras -->

            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <!-- Contenido de la primera píldora (galería) -->

                <div class="container">
                    <!-- Inicio del contenedor dentro de la píldora -->
                    <img src="{{url('').'/'.$propiedad->galeriaImagenes }}" class="mx-auto d-block" style="width:50%">
                </div>
                <!-- Fin del contenedor dentro de la píldora -->

            </div>
            <!-- Fin del contenido de la primera píldora (galería) -->

            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <!-- Contenido de la segunda píldora (ubicación) -->

                <div id="map" class="container" style="height: 400px;"></div>

            </div>
            <!-- Fin del contenido de la segunda píldora (ubicación) -->

            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <!-- Contenido de la tercera píldora (recorrido) -->

                <div id="streetView" class="container" style="height: 400px;"></div>

            </div>
            <!-- Fin del contenido de la tercera píldora (recorrido) -->

            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                <!-- Contenido de la cuarta píldora (video) -->

                <div class="row align-items-center">
                    <!-- Inicio de la fila dentro de la píldora -->
                    <div class="col-12">
                        <!-- Inicio de la columna de tamaño 12 dentro de la píldora -->
                        <div class="card bg-dark text-white" style="max-width: 28rem;">
                            <!-- Inicio de la tarjeta dentro de la píldora -->
                            <video src="{{ $propiedad->urlvideo }}" class="card-img-top" muted autoplay loop></video>
                        </div>
                        <!-- Fin de la tarjeta dentro de la píldora -->
                    </div>
                    <!-- Fin de la columna de tamaño 12 dentro de la píldora -->
                </div>
                <!-- Fin de la fila dentro de la píldora -->

            </div>
            <!-- Fin del contenido de la cuarta píldora (video) -->

        </div>
        <!-- Fin del contenido de píldoras -->

    </section>
    <!-- Fin de la sección de contenido -->

    <div class="container">
        <!-- Inicio del contenedor fuera de la sección de contenido -->

        <div class="card">
            <!-- Inicio de la tarjeta -->
            <h5 class="card-header">Datos generales </h5>
            <div class="card-body">
                <!-- Inicio del cuerpo de la tarjeta -->
                <h5 class="card-title">{{ $propiedad->titulo }}</h5>

                <div class="form-group">
                    <h3>Valor de la propiedad </h3>
                    <p style="
    font-weight: 700;
    font-size: 30Px;
    color: black;
">{{ '$' . $propiedad->precio }}
                    </p>
                </div>
                <p> El inmueble cuenta con: </p>
                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label>Total Area</label>
                            <p>
                                <span class="fas fa-ruler-combined" aria-hidden="true"></span>

                                <span>{{ $propiedad->metroscuadradostotal }} m<sup>2</sup></span>
                            </p>
                        </div>

                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Total Construido</label>
                            <p>
                                <span class="fas fa-ruler-combined" aria-hidden="true"></span>

                                <span>{{ $propiedad->metroscuadradosconstruccion }} m<sup>2</sup></span>
                            </p>
                        </div>


                    </div>
                    <div class="col">
                        <div class="form-group">
                            <span class="fas fa-bed" aria-hidden="true"></span>

                            <p style="margin-bottom: 0;">habitaciones</p>
                            <!-- Aplicar un margen inferior más pequeño al párrafo -->

                            <label style="margin-top: 0;">{{ $propiedad->habitaciones }}</label>
                            <!-- Aplicar un margen superior más pequeño al label -->
                        </div>


                    </div>
                    <div class="col">
                        <div class="form-group">
                            <span class="fas fa-toilet" aria-hidden="true"></span>

                            <p style="margin-bottom: 0;">baños</p>
                            <!-- Aplicar un margen inferior más pequeño al párrafo -->

                            <label style="margin-top: 0;">{{ $propiedad->banos }}</label>


                            <!-- Aplicar un margen superior más pequeño al label -->
                        </div>


                    </div>
                    <div class="col">
                        <span class="fas fa-car" aria-hidden="true"></span>

                        <p style="margin-bottom: 0;">garajes</p>
                        <!-- Aplicar un margen inferior más pequeño al párrafo -->

                        <label style="margin-top: 0;">{{ $propiedad->garages }}</label>


                        <!-- Aplicar un margen superior más pequeño al label -->
                    </div>

                </div>


   <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label>piscina</label>
                            <p>
                                <span class="fas fa-swimmer" aria-hidden="true"></span>

                              <span>{{ $propiedad->piscina == 1 ? 'Sí' : 'No' }}</span>
                            </p>
                        </div>

                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Parqueadero</label>
                            <p>
                                <span class="fas fa-parking" aria-hidden="true"></span>

                                <span>{{ $propiedad->parqueadero== 1 ? 'Sí' : 'No' }}</span>
                            </p>
                        </div>


                    </div>
                    <div class="col">
                        <div class="form-group">
                            <span class="fas fa-thermometer-three-quarters" aria-hidden="true"></span>

                            <p style="margin-bottom: 0;">calefaccion</p>
                            <!-- Aplicar un margen inferior más pequeño al párrafo -->

                            <label style="margin-top: 0;">{{ $propiedad->calefaccion== 1 ? 'Sí' : 'No' }}</label>
                            <!-- Aplicar un margen superior más pequeño al label -->
                        </div>


                    </div>
                    <div class="col">
                        <div class="form-group">
                            <span class="fas fa-user-secret" aria-hidden="true"></span>

                            <p style="margin-bottom: 0;">Seguridad</p>
                            <!-- Aplicar un margen inferior más pequeño al párrafo -->

                            <label style="margin-top: 0;">{{ $propiedad->seguridad == 1 ? 'Sí' : 'No' }}</label>


                            <!-- Aplicar un margen superior más pequeño al label -->
                        </div>


                    </div>
                    <div class="col">
                        <span  class="fas fa-refrigerator" aria-hidden="true"></span>

                        <p style="margin-bottom: 0;">Refrigeracion</p>
                        <!-- Aplicar un margen inferior más pequeño al párrafo -->

                        <label style="margin-top: 0;">{{ $propiedad->refrigeracion== 1 ? 'Sí' : 'No' }}</label>


                        <!-- Aplicar un margen superior más pequeño al label -->
                    </div>

                </div>


            </div>





            <!-- Inicio de la fila dentro del cuerpo de la tarjeta -->

            <!-- Fin de la fila dentro del cuerpo de la tarjeta -->

        </div>
        <!-- Fin del cuerpo de la tarjeta -->
    </div>
    <!-- Fin de la tarjeta -->

    </div>
@endsection
