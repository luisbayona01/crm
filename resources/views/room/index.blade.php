@extends('layouts.plantilla')

@section('template_title')
    Rooms
@endsection

<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

<link rel="stylesheet" href="{{ asset('css/chat.css') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/roomchat.js') }}"></script>
<style>
    .alert-chat {
        color: #1c606a;
        background-color: #fff;
        border-color: #03a9f4;
    }

    small,
    .small-chat {

        color: #12191d;
    }
</style>



@section('content')
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script>
        var baseUrl = "{{ url('') }}";
    </script>

    <div class="container">
        <div class="row">
            <div class="col col col-sm-4">

                <a href="{{ route('room.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                    {{ __('Creacion de salas  y asignacion de usuarios') }}
                </a>

            </div>
            <div class="col col col-sm-4">

                <a href="{{ route('rooms.edit') }}" class="btn btn-info btn-sm float-right" data-placement="left">
                    {{ __(' asignacion de usuarios a salas') }}
                </a>

            </div>

        </div>
    </div>

    <section class="message-area">

        <div class="container">
            <input type="hidden" class="auth" value="{{ Auth::user()->id }}">
            <input type="hidden"class='username' value="{{ Auth::user()->name }}">
            <input type="hidden" class='imgusername'value="{{ Auth::user()->urlfotoperfil }}">
            <div class="row">
                <div class="col-12">
                    <div class="chat-area">
                        <!-- chatlist -->
                        <div class="chatlist">
                            <div class="modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="chat-header">
                                        <div class="msg-search">
                                            <input type="text" class="form-control" id="inlineFormInputGroup"
                                                placeholder="Search" aria-label="search">
                                            <a class="add" data-toggle="modal" data-target="#exampleModalCenter">
                                                <img class="img-fluid"
                                                    src="https://mehedihtml.com/chatbox/assets/img/add.svg" alt="add">
                                            </a>
                                        </div>


                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="Open-tab" data-toggle="tab"
                                                    data-target="#Users" type="button" role="tab" aria-controls="Open"
                                                    aria-selected="true">chats</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="Closed-tab" data-toggle="tab"
                                                    data-target="#Rooms" type="button" role="tab"
                                                    aria-controls="Closed" aria-selected="false">salas</button>
                                            </li>

                                        </ul>
                                    </div>

                                    <div class="modal-body">
                                        <!-- chat-list -->
                                        <div class="chat-lists">




                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="Users" role="tabpanel"
                                                    aria-labelledby="Open-tab">
                                                    <!-- chat-list -->
                                                    <div class="chat-list" id="chatlistuser">





                                                        <!-- User 1 -->




                                                    </div>
                                                    <!-- chat-list -->
                                                </div>
                                                <div class="tab-pane fade" id="Rooms" role="tabpanel"
                                                    aria-labelledby="Closed-tab">
                                                    <!-- chat-listsalas -->
                                                    <div class="chat-list-salas" id="chatlistrooms">





                                                    </div>
                                                    <!-- chat-list -->
                                                </div>
                                            </div>
                                        </div>

                                        <!-- chat-list -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- chatlist -->

                        <!-- chatbox -->
                        <div class="chatbox d-none">
                            <div class="modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="msg-head">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="d-flex align-items-center">
                                                    <span class="chat-icon">
                                                        <img class="img-fluid"
                                                            src="https://mehedihtml.com/chatbox/assets/img/arroleftt.svg"
                                                            alt="image title"></span>
                                                    <div class="flex-shrink-0">
                                                        <img class="img-fluid"
                                                            src="https://mehedihtml.com/chatbox/assets/img/user.png"
                                                            alt="user img" id="img-perfil" width="45">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h3 class="name-usuario"></h3>
                                                        <p class="estado"></p>
                                                        <input type="hidden" class="recipient_id" value="">

                                                    </div>
                                                </div>
                                            </div>
                                          <div class="col-4">
                                                <ul class="moreoption">
                                                    <li class="navbar nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle" role="button"
                                                            data-toggle="dropdown" aria-expanded="false"><i
                                                                class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                                        <ul class="dropdown-menu dropdown-menu-right">


                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="vaciarchatuser()"> Vaciar chat</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="msg-body">
                                            <ul class="mensajesusers">



                                            </ul>
                                        </div>
                                    </div>





                                    <div class="send-box">
                                        <div class="fomr">
                                            <input type="text" class="form-control" aria-label="message…"
                                                placeholder="Write message…" id="privatemensage">
                                            <button type="button" id="enviaruser"><i class="fa fa-paper-plane"
                                                    aria-hidden="true"></i>
                                                Send</button>
                                        </div>
                                        <div class="send-btns">
                                            <div class="attach">
                                                <div class="button-wrapper">
                                                    <span class="label">
                                                        <img class="img-fluid"
                                                            src="https://mehedihtml.com/chatbox/assets/img/upload.svg"
                                                            alt="image title"> attached file
                                                    </span>
                                                    <input type="file" name="upload" id="upload"
                                                        class="upload-box" placeholder="Upload File"
                                                        onchange="uploadFile(this,'namefiles')" aria-label="Upload File">
                                                    <p id="namefiles"> </p>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- chatbox -->

                        <!-- chatbox-salas -->
                        <div class="chatbox-salas d-none">
                            <div class="modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="msg-head">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="d-flex align-items-center">
                                                    <span class="chat-icon-salas"><img class="img-fluid"
                                                            src="https://mehedihtml.com/chatbox/assets/img/arroleftt.svg"
                                                            alt="image title"></span>
                                                    <div class="flex-shrink-0">
                                                        <img class="img-fluid"
                                                            src="https://static.thenounproject.com/png/2009825-200.png"
                                                            alt="user img" width="45">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">

                                                        <h3 class="namesala"> </h3>
                                                        <input type="hidden" class="salaid" value=''>
                                                        <p> <span
                                                                class="badge badge-primary rounded-pill"id="participantes"></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <ul class="moreoption">
                                                    <li class="navbar nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle" role="button"
                                                            data-toggle="dropdown" aria-expanded="false"><i
                                                                class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="editsala()">Editar sala</a></li>

                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="vaciarsala()"> Vaciar chat</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="msg-body">

                                            <ul class="contenidomensaje">


                                            </ul>

                                        </div>
                                    </div>
                                    <div class="send-box">
                                        <div class="fomr">
                                            <input type="text" class="form-control" aria-label="message…"
                                                placeholder="Write message…" id="menssage">


                                            <button type="button" id="btnsalageneral">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                Send</button>
                                        </div>

                               <div class="send-btns">
                                            <div class="attach">
                                                <div class="button-wrapper">
                                                    <span class="label">
                                                        <img class="img-fluid"
                                                            src="https://mehedihtml.com/chatbox/assets/img/upload.svg"
                                                            alt="image title"> attached file
                                                    </span>
                                                    <input type="file" name="upload" id="upload2"
                                                        class="upload-box" placeholder="Upload File"
                                                        onchange="uploadFile(this,'namefiles2')" aria-label="Upload File">
                                                    <p id="namefiles2"> </p>
                                                </div>


                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>
                        <!-- chatbox-salas -->
                        <!--el defaul-->

                        <div class="chatbox-defauld">
                            <div class="modal-dialog-scrollable">
                                <div class="modal-content">

                                    <div class="modal-body">
                                        <div class="msg-body">
                                            <div class="thread-not-selected empty"
                                                style="transform: translateX(0%) translateZ(0px);" bis_skin_checked="1">
                                                <div class="empty" bis_skin_checked="1">
                                                    <p class="bpbm-empty-icon"><svg stroke="currentColor"
                                                            fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                                                            height="1em" width="1em"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill="none" stroke-linecap="round"
                                                                stroke-miterlimit="10" stroke-width="32"
                                                                d="M431 320.6c-1-3.6 1.2-8.6 3.3-12.2a33.68 33.68 0 012.1-3.1A162 162 0 00464 215c.3-92.2-77.5-167-173.7-167-83.9 0-153.9 57.1-170.3 132.9a160.7 160.7 0 00-3.7 34.2c0 92.3 74.8 169.1 171 169.1 15.3 0 35.9-4.6 47.2-7.7s22.5-7.2 25.4-8.3a26.44 26.44 0 019.3-1.7 26 26 0 0110.1 2l56.7 20.1a13.52 13.52 0 003.9 1 8 8 0 008-8 12.85 12.85 0 00-.5-2.7z">
                                                            </path>
                                                            <path fill="none" stroke-linecap="round"
                                                                stroke-miterlimit="10" stroke-width="32"
                                                                d="M66.46 232a146.23 146.23 0 006.39 152.67c2.31 3.49 3.61 6.19 3.21 8s-11.93 61.87-11.93 61.87a8 8 0 002.71 7.68A8.17 8.17 0 0072 464a7.26 7.26 0 002.91-.6l56.21-22a15.7 15.7 0 0112 .2c18.94 7.38 39.88 12 60.83 12A159.21 159.21 0 00284 432.11">
                                                            </path>
                                                        </svg></p>
                                                    <p class="bpbm-empty-message">Select a conversation to display messages
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>



    </section>


    <div class="modal fade bd-example-modal-sm" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">contactos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="contactsearch" placeholder="Search "
                        aria-label="search">
                    <div class="container" style="margin-top: 20px">

                        <div class="row">

                            <div class="col">
                                <p> contactos para chatear </p>
                                <form id="agregracontacs">
                                    <input type="hidden" name="_token" id="csrf_token_input"
                                        value="{{ csrf_token() }}">
                                    <div class="chat-list" id="contactos">


                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="Irchatear">Ir a chatear</button>
                </div>
            </div>
        </div>
    </div>
@endsection
