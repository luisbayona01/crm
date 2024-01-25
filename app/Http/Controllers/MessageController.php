<?php

namespace App\Http\Controllers;

use App\Models\Message;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

/**
 * Class MessageController
 * @package App\Http\Controllers
 */
class MessageController extends Controller
{



    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showmenssageporusuarios($idusuario)
    {
        //$message = Message::find($id);

        return view('message.show', compact('message'));
    }

    public function obtenermensajesdirectos($recipientUserId)
    {

        $authUserId = auth()->user()->id;

        $messages = DB::table('messages')
            ->join('users as sender', 'messages.user_id', '=', 'sender.id')
            ->join('users as recipient', 'messages.recipient_id', '=', 'recipient.id')
            ->select(
                'messages.*',
                'sender.name as sender_name',
                'recipient.name as recipient_name',
                'recipient.urlfotoperfil',
                'sender.urlfotoperfil as senderurlperfil',
                DB::raw('DATE(messages.created_at) as message_date'),
                DB::raw('TIME(messages.created_at) as message_time'),
                DB::raw("CASE WHEN messages.user_id = $authUserId THEN 'sent' ELSE 'received' END as message_direction")
            )
            ->where(function ($query) use ($authUserId, $recipientUserId) {
                $query->where('messages.user_id', $authUserId)
                    ->where('messages.recipient_id', $recipientUserId);
            })
            ->orWhere(function ($query) use ($authUserId, $recipientUserId) {
                $query->where('messages.user_id', $recipientUserId)
                    ->where('messages.recipient_id', $authUserId);
            })
            ->orderBy('messages.created_at', 'asc') // Orden ascendente por tiempo
            ->get();

        return response()->json([
            'messages' => $messages,
        ]);
    }
    public function obtenerMensajesSala($idsala)
    {
//dd($idsala);
        $messageDetails = DB::table('messages')
            ->join('users', 'messages.user_id', '=', 'users.id')
            ->join('rooms', 'messages.room_id', '=', 'rooms.id')
            ->select(
                'messages.*',
                'users.urlfotoperfil',
                'users.name as user_name',
                'rooms.nombre as room_name',
                DB::raw('DATE(messages.created_at) as message_date'),
                DB::raw('TIME(messages.created_at) as message_time')
            )
            ->where('messages.room_id', $idsala)
            ->orderBy('messages.created_at', 'desc')
            ->get();
        return response()->json([
            'menssagessala' => $messageDetails,

        ]);

    }

    public function contarmenssagesUsers($iduser)
    {
        $messageCount = Message::where('recipient_id', $iduser)->where('messages_status', 'Entregado')->count();
        return response()->json([
            'contarmenssageU' => $messageCount,

        ]);
    }

    public function contarmenssagesUsersporusuario($iduser)
    {
        $authUserId = auth()->user()->id;

        $messageCount = Message::where('recipient_id', $authUserId)->where('user_id', $iduser)->where('messages_status', 'Entregado')->count();
        return response()->json([
            'contarmenssageUs' => $messageCount,

        ]);
    }

    public function contarmenssageSala($idsala)
    {

        $messageCount = Message::where('room_id', $idsala)->count();
        return response()->json([
            'contarmenssage' => $messageCount,

        ]);

    }

    public function confirmarmensagge(Request $request)
    {

        $mess = Message::where('user_id', $request->id_userfrom)
            ->where('recipient_id', $request->recipientid)
            ->update([
                'messages_status' => 'Leido',
            ]);
        return response()->json(['success' => true]);
    }


  public function addsavemenssagesalafile(Request $request){
 try {
    $data = $request->all();

   if ($request->file('adjunto')) {
//dd('aqi',$data);
    $imagen = $request->file('adjunto');
    $nombreImagen = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME);  // Obtener el nombre del archivo sin la extensión
    $extension = $imagen->getClientOriginalExtension();  // Obtener la extensión del archivo

    // Concatenar el nombre y la extensión del archivo
    $nombreImagen = $nombreImagen . '.' . $extension;

    // Guardar la imagen en la carpeta "public/files"
    $imagen->storeAs('files', $nombreImagen, 'public');

    // Almacenar la ruta completa en la base de datos
    $data['file_path'] = 'files/' . $nombreImagen;
}

    $message = Message::create($data);

    // La inserción fue exitosa, $message contiene el modelo recién creado
    // Puedes realizar acciones adicionales si es necesario
    $idmensaje=$message->id;
    return response()->json(['success' => true, 'message' => $this->obtenermensajesalaid($idmensaje)]);
} catch (\Exception $e) {
    // La inserción o el manejo de archivos fallaron, puedes manejar el error según tus necesidades
    return response()->json(['success' => false, 'message' => 'Error al guardar el mensaje: '.$e->getMessage()]);
}




   }

public function  obtenermensajesalaid($idmensaje){

$messageDetails = DB::table('messages')
            ->join('users', 'messages.user_id', '=', 'users.id')
            ->join('rooms', 'messages.room_id', '=', 'rooms.id')
            ->select(
                'messages.*',
                'users.urlfotoperfil',
                'users.name as user_name',
                'rooms.nombre as room_name',
                DB::raw('DATE(messages.created_at) as message_date'),
                DB::raw('TIME(messages.created_at) as message_time')
            )
            ->where('messages.id', $idmensaje)
            ->get()->toArray();

return  $messageDetails;
}

    public  function savemenssageprivateconadjunto(Request $request){
    try {
    $data = $request->all();

   if ($request->file('adjunto')) {

    $imagen = $request->file('adjunto');
    $nombreImagen = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME);  // Obtener el nombre del archivo sin la extensión
    $extension = $imagen->getClientOriginalExtension();  // Obtener la extensión del archivo

    // Concatenar el nombre y la extensión del archivo
    $nombreImagen = $nombreImagen . '.' . $extension;

    // Guardar la imagen en la carpeta "public/files"
    $imagen->storeAs('files', $nombreImagen, 'public');

    // Almacenar la ruta completa en la base de datos
    $data['file_path'] = 'files/' . $nombreImagen;
}

    $message = Message::create($data);

    // La inserción fue exitosa, $message contiene el modelo recién creado
    // Puedes realizar acciones adicionales si es necesario

    return response()->json(['success' => true, 'message' => $message]);
} catch (\Exception $e) {
    // La inserción o el manejo de archivos fallaron, puedes manejar el error según tus necesidades
    return response()->json(['success' => false, 'message' => 'Error al guardar el mensaje: '.$e->getMessage()]);
}


      }

  public function  obtnermensajes_id($idmensajeid){

   $messageDetails = DB::table('messages')
        ->join('users as sender', 'messages.user_id', '=', 'sender.id')
        ->join('users as recipient', 'messages.recipient_id', '=', 'recipient.id')
        ->select(
            'messages.*',
            'sender.name as sender_name',
            'recipient.name as recipient_name',
            'sender.urlfotoperfil',
            DB::raw('DATE(messages.created_at) as message_date'),
            DB::raw('TIME(messages.created_at) as message_time')
        )
        ->where('messages.id', $idmensajeid)
        ->get();
return response()->json([
            'messages' => $messageDetails,
        ]);

  }

 public function addcontactchat(Request $request){
   //dd(Auth::user());
 $messages = [];
  for ($i=0; $i <count($request->usersid) ; $i++) {
  $message = Message::create(["user_id"=>Auth::user()->id, "recipient_id"=>$request->usersid[$i],"content"=> "Hola como estas mi nombre es ".Auth::user()->name." quiero chatear contigo"  ]);
  $messages[] = $message;
  } ;

  return response()->json(['messages' => $messages]);
  }

public function elimnarmenssagesala(Request $request){
$room_id = $request->idroom;

// Realizar la eliminación basándote en el nombre de usuario
Message::where('room_id', $room_id)->delete();
 return response()->json(['respuesta' => 'mensajes eliminados correctamente']);
}

/**eliminar mensajes  solo user */

public function elimnarmenssagesuser(Request $request){
try {
$user_id = $request->userid;
$recipient_id=$request->recipiend_id;

Message::where(function ($query) use ($user_id, $recipient_id) {
    $query->where('user_id', $user_id)
          ->where('recipient_id', $recipient_id);
})->orWhere(function ($query) use ($user_id, $recipient_id) {
    $query->where('user_id', $recipient_id)
          ->where('recipient_id', $user_id);
})->delete();


$this->deletearchivos();

 return response()->json(['respuesta' => 'mensajes eliminados correctamente']);
}catch(\Exception $e){

 return response()->json(['success' => false, 'message' => 'Error al guardar el mensaje: '.$e->getMessage()]);
}

}

  public function  deletearchivos(){

$archivosEnCarpeta = File::files(public_path('files'));

// Paso 2: Obtener la Lista de Archivos Referenciados en la Tabla de Mensajes
$archivosEnDB = Message::pluck('file_path')->toArray();

// Paso 3: Comparar y Eliminar Archivos No Referenciados
$archivosNoReferenciados = array_diff($archivosEnCarpeta, $archivosEnDB);

foreach ($archivosNoReferenciados as $archivo) {
    // Obtener la ruta relativa desde la carpeta 'public'
    $rutaRelativa = str_replace(public_path(), '', $archivo);

    // Eliminar el archivo del sistema de archivos
    File::delete($archivo);
}
  }

}
