<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/confirmarmensagge', [App\Http\Controllers\MessageController::class,'confirmarmensagge'])->name('confirmarmensagge');

Route::post('/savemenssageprivateconadjunto', [App\Http\Controllers\MessageController::class,'savemenssageprivateconadjunto'])->name('savemenssageprivateconadjunto');



/*addcontactchat*/


Route::get('/mensajes/{idmensajeid}', [App\Http\Controllers\MessageController::class, 'obtnermensajes_id'])->name('obtnermensajes_id');


Route::post('/salas/edit', [App\Http\Controllers\RoomController::class, 'updatesala'])->name('salas.id');

Route::post('/salas/menssagesdelete', [App\Http\Controllers\MessageController::class,'elimnarmenssagesala'])->name('salas.menssagesdelete');
Route::post('/salas/createadjunto', [App\Http\Controllers\MessageController::class,'addsavemenssagesalafile'])->name('salas.createadjunto');

route::post('/user/mensajes/delete',[App\Http\Controllers\MessageController::class,'elimnarmenssagesuser']);

//

/*contarmenssagesUsers*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
URL::forceScheme('https');
