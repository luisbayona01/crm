async function contarmensajesNoleido(idUsuario) {
  try {
    const response = await fetch(`/contarmensagesnoleidosPoruser/${idUsuario}`);
    if (!response.ok) {
      throw new Error(`Error de red: ${response.status}`);
    }

    const data = await response.json();

    // Aquí puedes trabajar con los datos recibidos
    let valor = 0;

    $(`#mensajesnoleidos${idUsuario}`).html("");
    if (data.contarmenssageUs !== 0) {
      $(`#mensajesnoleidos${idUsuario}`).addClass("badge-danger");
      $(`#mensajesnoleidos${idUsuario}`).html(" " + data.contarmenssageUs);
      valor = data.contarmenssageUs;
    }

    return valor;
  } catch (error) {
    // Manejo de errores aquí
    console.error("Error en la función de notificacion:", error);
    return 0; // Devuelve un valor predeterminado en caso de error
  }
}
async function obtenerMensajesSala(idsala) {
  let loading = `<div class="d-flex align-items-center" id="loadingsala">
                                                <strong>Loading...</strong>
                                                <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                                        </div>`;
  $(`#contenidomensajes-sala${idsala}`).html(loading);
  try {
    const response = await fetch(`/obtener-mensajes-sala/${idsala}`);
    if (!response.ok) {
      throw new Error(`Error de red: ${response.status}`);
    }

    const data = await response.json();
    // Aquí puedes trabajar con los datos recibidos

    $(`#contenidomensajes-sala${idsala}`).html("");
    data.menssagessala.forEach(mensajeS => {
      let username = mensajeS.user_name;
      let mensajeh = mensajeS.content;
      let urlimg = baseUrl + "/" + mensajeS.urlfotoperfil;
      let formatoHora = mensajeS.message_time;
      let contenidoadjunto = "";
      if (mensajeS.file_path) {
        let adjunto = baseUrl + "/" + mensajeS.file_path;
        let extension = mensajeS.file_path.split(".").pop().toLowerCase();
        let filename = mensajeS.file_path.split("/").pop();
        // Verificar la extensión para determinar el formato de imagen
        if (
          extension === "png" ||
          extension === "jpg" ||
          extension === "jpeg" ||
          extension === "svg"
        ) {
          contenidoadjunto = `<div class="flex-shrink-0">
        <img class="img-fluid" src="${adjunto}" alt="user img" id="" width="45">
                                                    </div>`;
          // Realizar acciones específicas para archivos de imagen (por ejemplo, mostrar en una etiqueta img)
        } else {
          contenidoadjunto = `<p class="card-text bg-light" style="transform: rotate(0);">
                  ${filename}
       <a href="${adjunto}" class="text-warning stretched-link">descargar</a>
    </p>`;
          //console.log('El archivo no es una imagen o tiene un formato no soportado');
          // Realizar acciones específicas para archivos no admitidos como imágenes
        }
      }

      //user_id
      let id_user = mensajeS.user_id;
      let auth = $(".auth").val();
      let froms = "col col-sm-7 ml-auto alert alert-info alert-chat shadow-sm";
      let recipiends = "col col-sm-7 alert alert-info alert-chat shadow-sm";
      /*col col-sm-7 ml-auto alert alert-info alert-chat shadow-sm*/
      console.log("auth", auth);
      let isAuthUser = auth == id_user;
      let mensaggehis = `<div class="${isAuthUser
        ? froms
        : recipiends}" role="alert"
        style="background-color: #ffff;">
   <div class="flex-shrink-0">
        <img class="img-fluid" src="${urlimg}" alt="user img" id="img-perfil" width="45">
                                                    </div>
        <h5 class="alert-heading">${username}</h5>
        <p>${mensajeh}</p>
       ${contenidoadjunto}
        <small style="color:black">${formatoHora}</small>
    </div>`;
      $(`#contenidomensajes-sala${idsala}`).append(mensaggehis);

      //console.log(mensajeS);
    });
  } catch (error) {
    // Maneja cualquier error que ocurra durante la solicitud
    console.error("Error de solicitud:", error);
  }
}
async function obtenerMensajesDirectos(recipientUserId) {
  console.log("entro en obtenre mensajes directos");

  let loading = `<div class="d-flex align-items-center" id="loadingsala">
                                                <strong>Loading...</strong>
                                                <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                                        </div>`;
  $(`#contenidomensajes-usuarios${recipientUserId}`).html(loading);
  try {
    const response = await fetch(`/obtener-mensajes-user/${recipientUserId}`);

    if (!response.ok) {
      throw new Error("Error al obtener mensajes");
    }

    const data = await response.json();

    $(`#contenidomensajes-usuarios${recipientUserId}`).html("");
    data.messages.forEach(mensajeU => {
      let fecha = mensajeU.message_date;
      let mensajeh = "";
      let username = mensajeU.sender_name;
      if (mensajeU.content === null) {
        mensajeh = "";
      } else {
        mensajeh = mensajeU.content;
      }
      let urlimg = baseUrl + "/" + mensajeU.senderurlperfil;
      let formatoHora = mensajeU.message_time;
      let id_user = mensajeU.user_id;
      let auth = $(".auth").val();

      let froms = "col col-sm-7 ml-auto alert alert-info alert-chat shadow-sm";
      let recipiends = "col col-sm-7 alert alert-info alert-chat shadow-sm";
      /*col col-sm-7 ml-auto alert alert-info alert-chat shadow-sm*/
      let contenidoadjunto = "";
      if (mensajeU.file_path) {
        let adjunto = baseUrl + "/" + mensajeU.file_path;
        let extension = mensajeU.file_path.split(".").pop().toLowerCase();
        let filename = mensajeU.file_path.split("/").pop();
        // Verificar la extensión para determinar el formato de imagen
        if (
          extension === "png" ||
          extension === "jpg" ||
          extension === "jpeg" ||
          extension === "svg"
        ) {
          contenidoadjunto = `<div class="flex-shrink-0">
        <img class="img-fluid" src="${adjunto}" alt="user img" id="" width="45">
                                                    </div>`;
          // Realizar acciones específicas para archivos de imagen (por ejemplo, mostrar en una etiqueta img)
        } else {
          contenidoadjunto = `<p class="card-text bg-light" style="transform: rotate(0);">
                  ${filename}
       <a href="${adjunto}" class="text-warning stretched-link">descargar</a>
    </p>`;
          //console.log('El archivo no es una imagen o tiene un formato no soportado');
          // Realizar acciones específicas para archivos no admitidos como imágenes
        }
      }

      console.log("auth", auth);
      let isAuthUser = auth == id_user;

      let mensaggehis = `  <div class="${isAuthUser
        ? froms
        : recipiends}" role="alert"
        style="background-color: #ffff;">
   <div class="flex-shrink-0">
        <img class="img-fluid" src="${urlimg}" alt="user img" id="img-perfil" width="45">
                                                    </div>
        <h5 class="alert-heading">${username}</h5>
        <p>${mensajeh}</p>
      ${contenidoadjunto}
        <small style="color:black">${formatoHora}</small>
    </div>`;
      $(`#contenidomensajes-usuarios${recipientUserId}`).append(mensaggehis);

      //console.log(mensajeS);
    });
  } catch (error) {
    console.error("Error:", error);
  }
}
async function obtenerCantidadMensajes(idsala) {
  try {
    //console.log("idsala", idsala);
    const response = await fetch(`/contarmenssagesala/${idsala}`);
    const data = await response.json();
    $(`#mensajes${idsala}`).text("mensajes: " + data.contarmenssage);
    //console.log("contarmensajes-sale", data.contarmenssage);
    // Retornar la cantidad de mensajes en lugar de imprimirlo
    //return data.contarmenssage;
  } catch (error) {
    console.error("Error al obtener la cantidad de mensajes:", error);
    // En caso de error, puedes retornar un valor predeterminado o lanzar una excepción
    return 0; // Valor predeterminado
    throw error; // Lanzar una excepción para manejar el error fuera de la función
  }
}
async function roomlistusers() {
  try {
    let miauth = $(".auth").val();

    const response = await fetch("/listrooms/users");

    if (!response.ok) {
      throw new Error(`Error de red: ${response.status}`);
    }

    const data = await response.json(); //usersListContainer.innerHTML = loading;
    //let usersListresenr = document.getElementById("chatlisrecientes");

    /*let loading = `<div class="d-flex align-items-center" id="loadincontenuser">
                                                            <strong>Loading...</strong>
                                                            <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                                                    </div>`*/
    /*for (const user of data.usersInRooms) {
                     const mensajesNoLeidos = await contarmensajesNoleido(user.iduser);

                     // Añade la propiedad message_count al usuario
                     user.message_count = mensajesNoLeidos;
                   }*/

    // Ordena el array data.usersInRooms según la propiedad message_count de cada usuario
    //data.usersInRooms.sort((a, b) => b.message_count - a.message_count);
    /*usersListresenr.innerHTML="";
        f
*/

    let usersListContainer = document.getElementById("chatlistuser");

    usersListContainer.innerHTML = "";
    const filtroNombre = $("#inlineFormInputGroup").val().toLowerCase();
    for (const user of data.usersInRooms) {
      if (
        user.iduser != miauth &&
        (!filtroNombre || user.name.toLowerCase().includes(filtroNombre))
      ) {
        const userElement = document.createElement("a");
        let span = "";

        if (user.user_status == "Online") {
          span = `<span class="active" id="active${user.iduser}" style="background-color: #00DB75"></span>`;
        } else {
          span = `<span class="active" id="active${user.iduser}"></span>`;
        }

        userElement.href = "#";
        userElement.className = "d-flex align-items-center";
        userElement.innerHTML = `
                    <div class="flex-shrink-0">
                        <img class="img-fluid" src="${user.urlfotoperfil}" alt="user img" width="45">
                         ${span}
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h3>${user.name} <input type="hidden" class="iduser" value ="${user.iduser}"></h3>
                        <p id="estado${user.iduser}">${user.username}<span class="badge  rounded-pill" id="mensajesnoleidos${user.iduser}"> </span> </p>
                       <p> </p>
                    </div>
                `;
        contarmensajesNoleido(user.iduser);
        userElement.addEventListener("click", function() {
          $("#chatbox-defauld").addClass("d-none");
          $(".chatbox-salas").addClass("d-none");
          $(".chatbox").removeClass("d-none");
          $(".chatbox").addClass("showbox");
          $(".name-usuario").html(user.name);
          $(".estado").html(user.user_status);
          $(".recipient_id").val(user.iduser);
          var imagenPerfil = document.getElementById("img-perfil");

          // Asigna la nueva URL al atributo src de la imagen
          imagenPerfil.src = user.urlfotoperfil;
          /*$("#contenidomensajes-usuarios" + $(".recipient_id").val()).append(mimensagge)*/
          //mensajesusers
          $(".mensajesusers").attr(
            "id",
            "contenidomensajes-usuarios" + user.iduser
          );
          obtenerMensajesDirectos(user.iduser);
          return false;
        });

        usersListContainer.appendChild(userElement);
      }
    }

    /**/

    /** */
    const filtroNombrecontact = $("#contactsearch").val().toLowerCase();
    let usersConatcsContainer = document.getElementById("contactos");

    usersConatcsContainer.innerHTML = "";
    for (const conactacuser of data.contacs) {
      if (
        conactacuser.iduser != miauth &&
        (!filtroNombrecontact ||
          conactacuser.name.toLowerCase().includes(filtroNombrecontact))
      ) {
        usersConatcsContainer.innerHTML += ` <li class="d-flex align-items-center" style="margin-bottom:15px; ">

                                        <div class="form-check">
                                            <input class="form-check-input" name="usersid[]" type="checkbox" value="${conactacuser.iduser}"
                                                id="userCheckbox">
                                            <label class="form-check-label" for="userCheckbox"></label>
                                        </div>

                                        <div class="flex-shrink-0">
                                            <img class="img-fluid"
                                                src="${conactacuser.urlfotoperfil}" alt="user img" width=45>

                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h3>${conactacuser.name}</h3>
                                            <p>${conactacuser.username}</p>
                                        </div>
                                    </li>`;
      }
    }

    /**/

    const chatlistrooms = document.getElementById("chatlistrooms");
    chatlistrooms.innerHTML = "";
    //let contar=0;
    //console.log("hola", data.rooms);
    for (const room of data.rooms) {
      messageCount = 0;
      // let messageCount = await
      //console.log('cunata',messageCount);
      //obtenerCantidadMensajes(room.id);
      //contar++
      const roomElement = document.createElement("a");
      roomElement.href = "#";
      roomElement.className = "d-flex align-items-center";
      roomElement.innerHTML = `
                <div class="flex-shrink-0">
                    <img class="img-fluid" src="https://static.thenounproject.com/png/2009825-200.png" alt="user img" width="45">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h3>${room.nombre} </h3>
                    <p> <span class="badge badge-primary rounded-pill">Participantes${room.user_count}</span></p>

                </div>
            `;
      //console.log('aqui ejecuco la funcion',)
      roomElement.addEventListener("click", async function() {
        $(".chatbox-defauld").addClass("d-none");
        $(".chatbox").addClass("d-none");
        $(".chatbox").removeClass("showbox");
        $(".chatbox-salas").removeClass("d-none");
        $(".chatbox-salas").addClass("showbox");
        $(".namesala").html("");
        $(".namesala").html(room.nombre);
        $(".salaid").val("");
        $(".salaid").val(room.id);
        $(".contenidomensaje").attr("id", "contenidomensajes-sala" + room.id);
        $("#participantes").text("Participantes:" + room.user_count);
        await obtenerMensajesSala(room.id);
      });

      chatlistrooms.appendChild(roomElement);
    }
    //console.log("contar", contar);
  } catch (error) {
    // Maneja cualquier error que ocurra durante la ejecución
    console.error("Error en la función roomlistusers:", error);
  }
}
async function confirmarMensage(id_userfrom, recipientid) {
  try {
    const response = await $.ajax({
      method: "POST",
      url: "/api/confirmarmensagge",
      data: {
        id_userfrom: id_userfrom,
        recipientid: recipientid
        // Agrega más datos según sea necesario
      },
      dataType: "json"
    });

    // Aquí puedes manejar la respuesta si es necesario
    console.log(response);
  } catch (error) {
    // Manejo de errores
    console.error("Error al confirmar el mensaje:", error);
  }
}

//const filtroNombreContact = $("#contactsearch").val().toLowerCase();
$("#contactsearch").on("input", roomlistusers);

jQuery(document).ready(function() {
  $("#user-salas").multiselect({
    enableFiltering: true,
    includeFilterClearBtn: false
  });

  $("#usuarios").multiselect({
    enableFiltering: true,
    includeFilterClearBtn: false
  });
  $("#privatemensage").focus(function() {
    confirmarMensage($(".recipient_id").val(), $(".auth").val());
    contarmensajesNoleido($(".recipient_id").val());
    notificacion();
  });
  if (document.getElementById("chatlistuser")) {
    roomlistusers();
  }
  /*if (document.getElementById("chatlistrooms")) {
      //updateMessageCount();
    }*/

  $(".chat-icon").click(function() {
    $(".chatbox").removeClass("showbox");
  });

  $(".chat-icon-salas").click(function() {
    $(".chatbox-salas").removeClass("showbox");
  });
});

function vaciarchatuser() {
 let url ='/api/user/mensajes/delete'
const  data= new FormData();


  data.append('recipiend_id',$(".recipient_id").val());
  data.append('userid',$(".auth").val())

ajaxcrud(url, data)
$(`#contenidomensajes-usuarios${$(".recipient_id").val()}`).html("")
}

document.getElementById("menssage").addEventListener("keypress", function(e) {
  if (e.which === 13 || e.keyCode === 13) {
    document.getElementById("btnsalageneral").click();
  }
});

$("#select-sala").change(function() {
  // Obtiene el valor seleccionado en el elemento select
  var selectedValue = $(this).val();

  // Realiza acciones adicionales según el valor seleccionado
  console.log("Valor seleccionado:", selectedValue);

  fetch(`/rooms/${selectedValue}/users`)
    .then(response => response.json())
    .then(data => {
      let selectUsuarios = $("#usuarios");
      selectUsuarios.multiselect("destroy");
      // Vacía el contenido actual del select (por si acaso)
      selectUsuarios.empty();

      // Añade la opción predeterminada

      // Recorre el array de objetos y añade opciones al select
      $.each(data, function(index, usuario) {
        var option = $("<option>", {
          value: usuario.id,
          text: usuario.name
        });

        // Si usuariosala no es null, marca la opción como seleccionada
        if (usuario.usuariosala !== null && usuario.idroom == selectedValue) {
          option.prop("selected", true);
        }

        selectUsuarios.append(option);
      });
      selectUsuarios.multiselect({
        enableFiltering: true,
        includeFilterClearBtn: false
      });
    })
    .catch(error => {
      console.error("Error:", error);
    });
});

function editsala() {
  console.log("entro a edit");
  currentQuantity = $(".namesala").text();
  var newQuantity = prompt("nombre de la sala:", currentQuantity);

  // Validate if the user entered a non-empty string
  if (newQuantity !== null && newQuantity.trim() !== "") {
    // Update the quantity in the table
    console.log("cantidad", newQuantity);
    let idsala = $(".salaid").val();
    let url = "/api/salas/edit";
    const formdata = new FormData();
    formdata.append("id", idsala);
    formdata.append("nombre", newQuantity.trim()); // trim para eliminar espacios en blanco al principio y al final
    ajaxcrud(url, formdata);
    $(".namesala").html(newQuantity);
  }
}

function eliminarsala() {
  console.log("aqui");
}

function vaciarsala() {
  let url = "/api/salas/menssagesdelete";
  const formdata = new FormData();
  let idsala = $(".salaid").val();
  formdata.append("idroom", idsala);
  ajaxcrud(url, formdata);
  $(`#contenidomensajes-sala${idsala}`).html("");
}

function ajaxcrud(url, data) {
  console.log("ajaxcrud");
  fetch(url, {
    method: "POST",
    body: data
  })
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      //console.log('Respuesta del servidor:', data);
      toastr.success(data["respuesta"]);
      roomlistusers();
    })
    .catch(error => {
      console.error("Error:", error);
    });
}

$("#Irchatear").click(function() {
  //console.log('aqui',$("#agregracontacs").serialize())

  var csrfToken = $("#csrf_token_input").val();

  // Combina los datos del formulario serializado y los datos adicionales
  var postData = $("#agregracontacs").serialize() + "&_token=" + csrfToken;

  // Realiza la solicitud POST
  $.post("/adduserchat", postData, "json")
    .done(function(data) {
      //console.log(data.messages);
      for (const mensajes of data.messages) {
        conn.send(
          JSON.stringify({
            type: "msgadduserchat",
            idmensaje: mensajes.id,
            recipientid: mensajes.recipient_id
          })
        );
      }

      $("#exampleModalCenter").modal("hide");
      roomlistusers();
    })
    .fail(function(error) {
      console.error("Error en la solicitud:", error);
    });
});

$("#btnsalageneral").click(function() {
  // console.log("ok");

  //obtenerCantidadMensajes($(".salaid").val());

  //var formData = new FormData();

  // Agregar campos clave/valor al FormData

  let username = $(".username").val();
  let mensajeenvi = $("#menssage").val();
  let fecha = new Date();
  let hora = fecha.getHours();
  let minutos = fecha.getMinutes();
  let formatoHora =
    (hora < 10 ? "0" : "") + hora + ":" + (minutos < 10 ? "0" : "") + minutos;
  let urlimg = baseUrl + "/" + $(".imgusername").val();
  let url = "/api/salas/createadjunto";

  const archivoSeleccionado = $("#upload2")[0].files[0];
  const formData = new FormData();

  if (!mensajeenvi && archivoSeleccionado) {
    /*user_id
                recipient_id*/
    formData.append("adjunto", archivoSeleccionado);
    formData.append("room_id", $(".salaid").val());
    formData.append("user_id", $(".auth").val());
    formData.append("content", "");

    salamenssage_ajax(url, formData);

    console.log("Caso 1: Campo de texto vacío pero se seleccionó un archivo");
    return false;
  } else if (!mensajeenvi && !archivoSeleccionado) {
    // Caso 2: Ambos campos están vacíos
    // Realiza la acción correspondiente
    console.log("Caso 2: Ambos campos están vacíos");
    return false;
  } else if (mensajeenvi && !archivoSeleccionado) {
    // Caso 3: Solo el campo de texto tiene contenido
    let data = JSON.stringify({
      type: "mensajessala",
      menssage: $("#menssage").val().trim(),
      salaid: $(".salaid").val(),
      idusuario: $(".auth").val()
    });
    conn.send(data);

    let mimensagge = `<div class="col col-sm-7 alert alert-info alert-chat shadow-sm" role="alert"
        style="background-color: #ffff;">
      <div class="flex-shrink-0" bis_skin_checked="1">
        <img class="img-fluid" src="${urlimg}" alt="user img" id="img-perfil" width="45">
                                                    </div>

        <h5 class="alert-heading">${username}</h5>
        <p>${mensajeenvi}</p>
        <small style="color:black">${formatoHora}</small>
    </div>`;

    $("#contenidomensajes-sala" + $(".salaid").val()).append(mimensagge);
    $("#menssage").val("");
    return false;
    //console.log('Caso 3: Solo el campo de texto tiene contenido');
  } else if (mensajeenvi && archivoSeleccionado) {
    // Caso 4: Ambos campos tienen contenido

    formData.append("adjunto", archivoSeleccionado);
    formData.append("room_id", $(".salaid").val());
    formData.append("user_id", $(".auth").val());
    formData.append("content", mensajeenvi);
    salamenssage_ajax(url, formData);
  } else {
    // Caso inesperado o no manejado
    console.log("Caso inesperado o no manejado");
    return false;
  }
});

function salamenssage_ajax(url, formData) {
  $.ajax({
    url: url,
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function(response) {
      console.log(response.message[0]);
      //var campoFile = $("#upload")[0];

      // Establece el valor del campo a una cadena vacía
      $("#upload2").val("");
      //console.log('filesval', campoFile.val);
      $("#namefiles2").html("");
      $("#menssage").val("");
      let receivedmessagesSala = response.message[0];

      recibechatboxsalasocket(receivedmessagesSala);
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.error("Error al enviar la solicitud:", textStatus, errorThrown);
    },
    complete: function() {
      // Restablecer el estado del botón después de completar la acción
      //otonClickeado = false;
    }
  });
}

// Agrega eventos de cambio e input al campo de búsqueda
$("#inlineFormInputGroup").on("input", roomlistusers);

$("#privatemensage").on("keypress", function(e) {
  // Verifica si la tecla presionada es "Enter" (código 13)
  if (e.which === 13) {
    // Evita que se propague el evento y realiza la acción correspondiente
    e.preventDefault();
    $("#enviaruser").click(); // Llama a la función al presionar "Enter"
  }
});

$("#enviaruser").click(function() {
  const mensajePrivado = $("#privatemensage").val();
  const archivoSeleccionado = $("#upload")[0].files[0];
  const formData = new FormData();

  if (!mensajePrivado && archivoSeleccionado) {
    /*user_id
                recipient_id*/
    formData.append("adjunto", archivoSeleccionado);
    formData.append("recipient_id", $(".recipient_id").val());
    formData.append("user_id", $(".auth").val());
    formData.append("content", "");
    console.log("Caso 1: Campo de texto vacío pero se seleccionó un archivo");
    //return false;
  } else if (!mensajePrivado && !archivoSeleccionado) {
    // Caso 2: Ambos campos están vacíos
    // Realiza la acción correspondiente
    console.log("Caso 2: Ambos campos están vacíos");
    return false;
  } else if (mensajePrivado && !archivoSeleccionado) {
    // Caso 3: Solo el campo de texto tiene contenido
    let mensajeprovado = $("#privatemensage").val();
    conn.send(
      JSON.stringify({
        type: "mensagedirect",
        menssage: mensajeprovado,
        recipientid: $(".recipient_id").val(),
        fromuser: $(".auth").val()
      })
    );

    let username = $(".username").val();
    let mensajeenvi = mensajeprovado;
    let fecha = new Date();
    let hora = fecha.getHours();
    let minutos = fecha.getMinutes();

    let formatoHora =
      (hora < 10 ? "0" : "") + hora + ":" + (minutos < 10 ? "0" : "") + minutos;
    let urlimg = baseUrl + "/" + $(".imgusername").val();

    let mimensagge = `<div class="col col-sm-7 ml-auto alert alert-info alert-chat shadow-sm" role="alert"
        style="background-color: #ffff;">
     <div class="flex-shrink-0" bis_skin_checked="1">
        <img class="img-fluid" src="${urlimg}" alt="user img" id="img-perfil" width="45">
    </div>
        <h5 class="alert-heading">${username}</h5>
        <p>${mensajeenvi}</p>
        <small style="color:black">${formatoHora}</small>
    </div>`;

    $("#contenidomensajes-usuarios" + $(".recipient_id").val()).append(
      mimensagge
    );
    $("#privatemensage").val("");

    return false;
    //console.log('Caso 3: Solo el campo de texto tiene contenido');
  } else if (mensajePrivado && archivoSeleccionado) {
    // Caso 4: Ambos campos tienen contenido

    formData.append("adjunto", archivoSeleccionado);
    formData.append("recipient_id", $(".recipient_id").val());
    formData.append("user_id", $(".auth").val());
    formData.append("content", mensajePrivado);
  } else {
    // Caso inesperado o no manejado
    console.log("Caso inesperado o no manejado");
  }

  $.ajax({
    url: "/api/savemenssageprivateconadjunto",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function(response) {
      console.log(response.message);
      var campoFile = $("#upload")[0];

      // Establece el valor del campo a una cadena vacía
      $("#upload").val("");
      //console.log('filesval', campoFile.val);
      $("#namefiles").html("");
      $("#privatemensage").val("");
      //console.log(response)
      obtenerMensajesDirectos_id(response.message);

      /*
 console.log("entro en obtenre mensajes directos id", mensages.id);

    //$(`#contenidomensajes-usuarios${recipientUserId}`).html(loading);
    let recipientUserId = mensages.recipient_id
*/
      //let mensajeprovado = $("#privatemensage").val();

      console.log(response.message.recipient_id);
      conn.send(
        JSON.stringify({
          type: "fileUpload",
          recipientid: $(".recipient_id").val(),
          idmensaje: response.message.id
        })
      );
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.error("Error al enviar la solicitud:", textStatus, errorThrown);
    },
    complete: function() {
      // Restablecer el estado del botón después de completar la acción
      //otonClickeado = false;
    }
  });
});

conn.addEventListener("message", function(event) {
  const data = JSON.parse(event.data);
  console.log("data adevne", data);
  if (data.type == "userstatus") {
    for (const userData of data.user_data) {
      const userId = userData.id;
      const userStatus = userData.user_status;
      datauserestus(userId, userStatus);
      //console.log('mensaje array objer',`UserID: ${userId}, UserStatus: ${userStatus}`);
    }
  }
  if (data.type == "retornamesnajesala") {
    receivedmessagesSala = data.mensajesrecibidos[0];
    recibechatboxsalasocket(receivedmessagesSala);
  }
  if (data.type == "mensajedirecto") {
    receivedmessagesdirecto = data.mensajeprivado[0];
    mensajesprivados(receivedmessagesdirecto);
    //mensajesprivados(data)
  }
  if (data.type == "adduserchat") {
    receivedmessagesdirecto = data.mensajeprivado[0];
    mensajesprivadoscontactchat(receivedmessagesdirecto);
    //mensajesprivados(data)
  }

  if (data.type == "mensajedirecto2") {
    let menssageaenviar = data.mensajeprivado[0];

    toastr.success(
      menssageaenviar.sender_name + " te ah enviado un nuevo mensaje"
    );
    obtenerMensajesDirectos_id(menssageaenviar);
    //console.log(data);

    //data.
  }
});

function validastatus(userId, userStatus) {
  console.log("entre a objet");
  console.log("obejet", $(`#active${userId}`).length);
  if ($("#active" + userId).length && userStatus == "Online") {
    console.log("active", $("#active1"));
    console.log("aquientro", $("#active" + userId));
    $(`#active${userId}`).css("background", "#00DB75");
    $(".estado").html(userStatus);
  } else {
    console.log("aquientro2", $("#active" + userId));
    $(`#active${userId}`).css("background", "#db0000");
    $(".estado").html(userStatus);
  }
}

function mensajesprivados(data) {
  if (document.getElementById("chatlistuser")) {
    roomlistusers();
  }
  //contarmensajesNoleido(data.user_id);
  toastr.success(data.sender_name + " te ah enviado un nuevo mensaje");
  notificacion();
  if ($(`#contenidomensajes-usuarios${data.user_id}`).length) {
    //console.log("if mensajes privados");

    let username = data.sender_name;
    let mensares = data.content;
    let fecha = new Date();
    let hora = fecha.getHours();
    let minutos = fecha.getMinutes();
    let formatoHora =
      (hora < 10 ? "0" : "") + hora + ":" + (minutos < 10 ? "0" : "") + minutos;
    let urlimg = "/" + data.urlfotoperfil;
    let recibidmensagge = `<div class="col col-sm-7 alert alert-info alert-chat shadow-sm"   role="alert"
   style= "background-color: #ffff;"
 >
<div class="flex-shrink-0" bis_skin_checked="1">
        <img class="img-fluid" src="${urlimg}" alt="user img" id="img-perfil" width="45">
                                                    </div>
                <h5 class="alert-heading">${username}</h5>
                <p>${mensares}</p>
                <small style="color:black">${formatoHora}</small>
            </div> `;

    $(`#contenidomensajes-usuarios${data.user_id}`).append(recibidmensagge);
    //let messageCount = await obtenerCantidadMensajes(data.room_id);
    // Marcar la función como async
  }
}

function mensajesprivadoscontactchat(data) {
  if (document.getElementById("chatlistuser")) {
    roomlistusers();
  }
  //contarmensajesNoleido(data.user_id);
  toastr.success(data.sender_name + " te ah enviado un nuevo mensaje");
  notificacion();
  if ($(`#contenidomensajes-usuarios${data.user_id}`).length) {
    //console.log("if mensajes privados");

    let username = data.sender_name;
    let mensares = data.content;
    let fecha = new Date();
    let hora = fecha.getHours();
    let minutos = fecha.getMinutes();
    let formatoHora =
      (hora < 10 ? "0" : "") + hora + ":" + (minutos < 10 ? "0" : "") + minutos;
    let urlimg = "/" + data.urlfotoperfil;
    let recibidmensagge = `<div class="col col-sm-7 alert alert-info alert-chat shadow-sm"   role="alert"
   style= "background-color: #ffff;"
 >
<div class="flex-shrink-0" bis_skin_checked="1">
        <img class="img-fluid" src="${urlimg}" alt="user img" id="img-perfil" width="45">
                                                    </div>
                <h5 class="alert-heading">${username}</h5>
                <p>${mensares}</p>
                <small style="color:black">${formatoHora}</small>
            </div> `;

    $(`#contenidomensajes-usuarios${data.user_id}`).append(recibidmensagge);
    //let messageCount = await obtenerCantidadMensajes(data.room_id);
    // Marcar la función como async
  }
}

function recibechatboxsalasocket(data) {
  if ($("#contenidomensajes-sala" + data.room_id).length) {
    let username = data.user_name;
    let mensares = data.content;
    let fecha = new Date();
    let hora = fecha.getHours();
    let minutos = fecha.getMinutes();
    let formatoHora =
      (hora < 10 ? "0" : "") + hora + ":" + (minutos < 10 ? "0" : "") + minutos;
    let urlimg = baseUrl + "/" + data.urlfotoperfil;

    let contenidoadjunto = "";
    if (data.file_path) {
      let adjunto = baseUrl + "/" + data.file_path;
      let extension = data.file_path.split(".").pop().toLowerCase();
      let filename = data.file_path.split("/").pop();
      // Verificar la extensión para determinar el formato de imagen
      if (
        extension === "png" ||
        extension === "jpg" ||
        extension === "jpeg" ||
        extension === "svg"
      ) {
        contenidoadjunto = `<div class="flex-shrink-0">
        <img class="img-fluid" src="${adjunto}" alt="user img" id="" width="45">
                                                    </div>`;
        // Realizar acciones específicas para archivos de imagen (por ejemplo, mostrar en una etiqueta img)
      } else {
        contenidoadjunto = `<p class="card-text bg-light" style="transform: rotate(0);">
                  ${filename}
       <a href="${adjunto}" class="text-warning stretched-link">descargar</a>
    </p>`;
        //console.log('El archivo no es una imagen o tiene un formato no soportado');
        // Realizar acciones específicas para archivos no admitidos como imágenes
      }
    }

    let recibidmensagge = `<div class="col col-sm-7 alert alert-info alert-chat shadow-sm"   role="alert"
   style= "background-color: #ffff;"
 >
<div class="flex-shrink-0" bis_skin_checked="1">
        <img class="img-fluid" src="${urlimg}" alt="user img" id="img-perfil" width="45">
                                                    </div>
                <h5 class="alert-heading">${username}</h5>
                <p>${mensares}</p>
           ${contenidoadjunto}
                <small style="color:black">${formatoHora}</small>
            </div> `;

    $("#contenidomensajes-sala" + data.room_id).append(recibidmensagge);
  }
}

function datauserestus(id, user_status) {
  if ($(`#active${id}`).length && user_status == "Online") {
    //console.log("active", $("#active1"));
    //console.log("aquientro", $("#active" + elemento.id));
    $(`#active${id}`).css("background", "#00DB75");
  } else {
    //console.log("aquientro2", $("#active" + elemento.id));
    $(`#active${id}`).css("background", "#db0000");
  }
}

function uploadFile(filesinput, id) {
  const fileInput = filesinput;
  //console.log(fileInput);
  //return  false;
  const file = fileInput.files[0];
  const maxSizeBytes = 5 * 1024 * 1024; // 5 MB
  if (file) {
    // Verificar el tamaño del archivo
    if (file.size > maxSizeBytes) {
      toastr.error("El archivo supera el tamaño máximo permitido (5 MB).");
      // Puedes restablecer el valor del input file para que el usuario pueda seleccionar otro archivo.
      fileInput.value = "";
      $(`#${id}`).html("");
    } else {
      $(`#${id}`).html(file.name);
    }
  } else {
    console.error("Selecciona un archivo antes de enviar.");
  }
}

async function obtenerMensajesDirectos_id(mensages) {
  let recipientUserId = $(".recipient_id").val();
  try {
    const response = await fetch(`/api/mensajes/${mensages.id}`);

    if (!response.ok) {
      throw new Error("Error al obtener mensajes");
    }

    const data = await response.json();

    //$(`#contenidomensajes-usuarios${recipientUserId}`).html("");
    data.messages.forEach(mensajeU => {
      let fecha = mensajeU.message_date;
      let username = mensajeU.sender_name;
      let mensajeh = "";
      if (mensajeU.content === null) {
        mensajeh = "";
      } else {
        mensajeh = mensajeU.content;
      }

      let urlimg = baseUrl + "/" + mensajeU.urlfotoperfil;
      let formatoHora = mensajeU.message_time;
      let id_user = mensajeU.user_id;
      let auth = $(".auth").val();

      let froms = "col col-sm-7 ml-auto alert alert-info alert-chat shadow-sm";
      let recipiends = "col col-sm-7 alert alert-info alert-chat shadow-sm";
      /*col col-sm-7 ml-auto alert alert-info alert-chat shadow-sm*/
      let contenidoadjunto = "";
      if (mensajeU.file_path) {
        let adjunto = baseUrl + "/" + mensajeU.file_path;
        let extension = mensajeU.file_path.split(".").pop().toLowerCase();
        let filename = mensajeU.file_path.split("/").pop();
        // Verificar la extensión para determinar el formato de imagen
        if (
          extension === "png" ||
          extension === "jpg" ||
          extension === "jpeg" ||
          extension === "svg"
        ) {
          contenidoadjunto = `<div class="flex-shrink-0">
        <img class="img-fluid" src="${adjunto}" alt="user img" id="" width="45">
                                                    </div><a href="${adjunto}" class="text-warning stretched-link">descargar</a>
   `;
          // Realizar acciones específicas para archivos de imagen (por ejemplo, mostrar en una etiqueta img)
        } else {
          contenidoadjunto = `<p class="card-text bg-light" style="transform: rotate(0);">
                  ${filename}
       <a href="${adjunto}" class="text-warning stretched-link">descargar</a>
    </p>`;
          //console.log('El archivo no es una imagen o tiene un formato no soportado');
          // Realizar acciones específicas para archivos no admitidos como imágenes
        }
      }

      console.log("auth", auth);
      let isAuthUser = auth == id_user;

      let mensaggehis = `  <div class="${isAuthUser
        ? froms
        : recipiends}" role="alert"
        style="background-color: #ffff;">
   <div class="flex-shrink-0">
        <img class="img-fluid" src="${urlimg}" alt="user img" id="img-perfil" width="45">
                                                    </div>
        <h5 class="alert-heading">${username}</h5>
        <p>${mensajeh}</p>
      ${contenidoadjunto}
        <small style="color:black">${formatoHora}</small>
    </div>`;
      $(`#contenidomensajes-usuarios${recipientUserId}`).append(mensaggehis);

      //console.log(mensajeS);
    });
  } catch (error) {
    console.error("Error:", error);
  }
}
