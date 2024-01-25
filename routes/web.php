<?php

use Illuminate\Support\Facades\Route;
use App\Exports\ContactosExport;
use App\Http\Controllers\ContactanosController;
use App\Http\Controllers\EtiquetaController;
use App\Http\Controllers\SubetiquetaController;
use App\Http\Controllers\AsesoraController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\GruposfacebookController;
use App\Http\Controllers\IachatController;
use App\Http\Controllers\CapacitacionController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\PaginawebController;
use App\Http\Controllers\VersionController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ImportContactoPorSubetiquetaController;
use App\Http\Controllers\ImportContactoGooglePorEtiquetaController;
use App\Http\Controllers\ImportContactoGooglePorSubetiquetaController;

Route::get('/get-regiones/{pais_id}', [App\Http\Controllers\PropiedadController::class, 'obtenerRegiones'])->name('get-regiones');
Route::get('/get-ciudad/{regionId}', [App\Http\Controllers\PropiedadController::class, 'obtenerCiudades'])->name('get-ciudad');

Route::get('/obtener-mensajes-sala/{idsala}', [App\Http\Controllers\MessageController::class,'obtenerMensajesSala']);
Route::get('/obtener-mensajes-user/{recipientUserId}', [App\Http\Controllers\MessageController::class,'obtenermensajesdirectos']);
Route::get('/contarmensagesnoleidos/{iduser}', [App\Http\Controllers\MessageController::class,'contarmenssagesUsers']);
Route::get('/contarmensagesnoleidosPoruser/{iduser}', [App\Http\Controllers\MessageController::class,'contarmenssagesUsersporusuario']);
Route::get('/rooms/edit', [App\Http\Controllers\RoomController::class, 'edit'])->name('rooms.edit');
Route::post('/rooms/update', [App\Http\Controllers\RoomController::class, 'updateroomuser'])->name('rooms.update');
Route::get('/contarmenssagesala/{idsala}', [App\Http\Controllers\MessageController::class, 'contarmenssageSala']);
Route::get('/listrooms/users', [App\Http\Controllers\RoomController::class, 'listrooms'])->middleware(['auth', 'verified']);
Route::get('/room/create', [App\Http\Controllers\RoomController::class, 'create'])->name('room.create')->middleware(['auth', 'verified']);
Route::post('/rooms/store', [App\Http\Controllers\RoomController::class, 'store'])->name('rooms.store')->middleware(['auth', 'verified']);
Route::get('/rooms', [App\Http\Controllers\RoomController::class, 'index'])->name('rooms.index')->middleware(['auth', 'verified']);
Route::get('/prueba/listar', [App\Http\Controllers\PruebaController::class, 'index']);
Route::post('/adduserchat', [App\Http\Controllers\MessageController::class,'addcontactchat'])->name('addcontactchat')->middleware(['auth', 'verified']);
Route::get('/rooms/{idroom}/users', [App\Http\Controllers\RoomController::class, 'usersroms'])->name('rooms.users');

//HOME
Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
Route::get('home/search', [HomeController::class, 'search'])->middleware(['auth', 'verified'])->name('home.search');
//IMPORTAR CONTACTOS CSV
Route::get('contactos/importar', [ContactoController::class, 'importar'])->middleware(['auth', 'verified'])->name('contactos.importar');
Route::post('import-list-excel', [ContactoController::class,'importExcel'])->name('users.import.excel');
// USUARIOS
Route::get('agentes', [UserController::class, 'agentes'])->middleware(['auth', 'verified'])->name('agentes.index');
Route::get('agentes/search', [UserController::class, 'agentessearch'])->middleware(['auth', 'verified'])->name('agentes.agentessearch');
Route::get('usuarios', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('usuarios.index');
Route::get('usuarios/{user}', [UserController::class, 'show'])->middleware(['auth', 'verified'])->name('usuarios.show');
Route::get('usuarios/{user}/edit', [UserController::class, 'edit'])->middleware(['auth', 'verified'])->name('usuarios.edit');
Route::put('usuarios/{user}', [UserController::class, 'update'])->middleware(['auth', 'verified'])->name('usuarios.update');
Route::delete('usuarios/{user}', [UserController::class, 'destroy'])->middleware(['auth', 'verified'])->name('usuarios.destroy');
// PROPIEDADES
Route::resource('propiedades', App\Http\Controllers\PropiedadController::class)->middleware(['auth', 'verified']);
Route::resource('categorias', App\Http\Controllers\CategoriaController::class)->middleware(['auth', 'verified']);
Route::resource('regiones', App\Http\Controllers\RegionesController::class)->middleware(['auth', 'verified']);
Route::resource('paises', App\Http\Controllers\PaisController::class)->middleware(['auth', 'verified']);
Route::resource('ciudades', App\Http\Controllers\CiudadesController::class)->middleware(['auth', 'verified']);
// CONTACTOS
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('contactos', ContactoController::class);
    Route::get('/search', [ContactoController::class, 'search'])->name('contactos.search');

});
// PUBLICACIONES
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('publicacions', PublicacionController::class);
});
// ASESORAS
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('asesoras', AsesoraController::class);
});
// ETIQUETAS
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('etiquetas', EtiquetaController::class);
});
// SUB ETIQUETAS
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('subetiquetas', SubetiquetaController::class);
});
// CAMPUS
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('campus', CampusController::class);
});
// EVENTOS
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('eventos', EventoController::class);
});
// GRUPOS DE FACEBOOK
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('gruposfacebook', GruposfacebookController::class);
});
// IA CHAT
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('iachat', IachatController::class);
});
// CAPACITACIONES
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('capacitaciones', CapacitacionController::class, ['parameters' => [
        'capacitaciones' => 'capacitacion'  // Especifica el nombre singular para evitar la pluralización
    ]]);
});
// PAGINASWEBS
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('paginaswebs', PaginawebController::class, ['parameters' => [
        'paginaswebs' => 'paginaweb'  // Especifica el nombre singular para evitar la pluralización
    ]]);
});
// VERSIONES
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('versions', VersionController::class);
});
// PAISES
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('countries', CountryController::class);
});
//EXPORTAR CONTACTOS CSV
Route::get('/index/contactos', [ContactoController::class, 'exportAllContactos'])->name('index.contactos');
//EXPORTAR CONTACTOS TAL Y CUAL ESTAN LAS CALUMNAS EN LA BASE DE DATOS
Route::get('/index/contactos2', [ContactoController::class, 'exportAllContactos2'])->name('index.contactos2');
//IMPORTAR POR ETIQUETA
Route::post('/import', [ContactoController::class, 'import1Excel'])->name('index.contacts');
//IMPORTAR POR SUBETIQUETA
Route::post('/importsub', [ContactoController::class, 'import2Excel'])->name('index.contactosporsubetiqueta');
//IMPORTAR CONTACTOS DE GOOGLE  POR ETIQUETA
Route::post('/import2', [ContactoController::class, 'import3Excel'])->name('index.contactosgoogleporetiqueta');
//IMPORTAR CONTACTOS DE GOOGLE  POR ETIQUETA
Route::post('/import3', [ContactoController::class, 'import4Excel'])->name('index.contactosgoogleporsubetiqueta');
//VISTA IMPORTAR POR ETIQUETA
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('contacts', ImportController::class);
});
//VISTA IMPORTAR POR SUBETQUETA
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('contactosporsubetiqueta', ImportContactoPorSubetiquetaController::class);
});
//VISTA IMPORTAR CONTACTOS DE GOOGLE  POR ETIQUETA
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('contactosgoogleporetiqueta', ImportContactoGooglePorEtiquetaController::class);
});
//VISTA IMPORTAR CONTACTOS DE GOOGLE  POR SUBETIQUETA
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('contactosgoogleporsubetiqueta', ImportContactoGooglePorSubetiquetaController::class);
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/prueba', [ContactoController::class, 'index1'])->name('prueba.contactos');
});


// EMAIL
Route::get('contactanos', [ContactanosController::class, 'index'])->middleware(['auth', 'verified'])->name('contactanos.index');
Route::post('contactanos', [ContactanosController::class, 'store'])->middleware(['auth', 'verified'])->name('contactanos.store');
// NOTIFICACIONES
Route::get('contactanos/notificacion', [ContactanosController::class, 'notificacion'])->middleware(['auth', 'verified'])->name('contactanos.notificacion');
Route::post('contactanos/notificacion', [ContactanosController::class, 'storenotificacion'])->middleware(['auth', 'verified'])->name('contactanos.storenotificacion');

require __DIR__.'/auth.php';
URL::forceScheme('https');
