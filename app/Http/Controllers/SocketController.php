<?php

namespace App\WebSocket;

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\User;
use DB;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

use App\Http\Controllers\MessageController;
class SocketController  extends Controller implements MessageComponentInterface
{
    protected $clients;
    //protected $messageController;
    public function __construct( )
    {
        $this->clients = new \SplObjectStorage;

    }

    public function onOpen(ConnectionInterface $conn)
    {
        $querystring = $conn->httpRequest->getUri()->getQuery();
        parse_str($querystring, $queryarray);

        if (isset($queryarray['token'])) {
            $token = base64_decode($queryarray['token']);

            // Buscar el usuario en la base de datos
            $user = User::where('id', $token)->first();

            if ($user) {
                if ($user->connection_id != 0) {

                    $conn->resourceId = $user->connection_id;
                } else {
                    $uniqueId = crc32(uniqid());
                    $uniqueIdInt = abs($uniqueId);
                    $conn->resourceId = $uniqueIdInt;

                    $user->update(['connection_id' => $conn->resourceId]);

                }
                 $this->sendHeaders($conn);

                $user->update(['user_status' => 'Online']);
                $this->clients->attach($conn);
                $users = User::select('id', 'user_status')
                    ->where(function ($query) use ($token) {
                        $query->where('id', $token)
                            ->orWhere('user_status', 'Online');
                    })
                    ->get();
                $data = [
                    'type' => 'userstatus',
                    'user_data' => $users ? $users->toArray() : [], // Convertir la colección a un array
                ];
                //echo "online ->" . json_encode($data) . "\n";
                foreach ($this->clients as $client) {
                    $client->send(json_encode($data));
                }

            }
        }
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg);

        if ($data->type) {
            switch ($data->type) {
                case 'logout':
                    $userId = $data->userId;
                    $this->closeconexion($userId, $from);
                    break;
                case 'mensajessala':

                    $menssage = $data->menssage;
                    $salaid = $data->salaid;
                    $idusario = $data->idusuario;

                    $this->envaiarmensajesalas($menssage, $salaid, $idusario, $from);
                    break;
                case 'mensagedirect':
                    $menssage = $data->menssage;
                    $recipientid = $data->recipientid;
                    $id_userfrom = $data->fromuser;
                    $this->Priavatemenssage($id_userfrom, $menssage, $recipientid, $from);
                    break;
                case 'estadomensaje':
                    $recipientid = $data->recipientid;
                    $id_userfrom = $data->fromuser;
                    $this->estadomensagge($id_userfrom, $recipientid, $from);
                    break;
                case 'fileUpload':
                    $recipientid = $data->recipientid;
                    $idmensaje = $data->idmensaje;

                    $this->menssageconadjunto($recipientid, $idmensaje, $from);
                    break;
                case 'msgadduserchat':

                    $recipientid = $data->recipientid;
                    $idmensaje = $data->idmensaje;
                    $this->msgadduserchat($idmensaje, $recipientid, $from);
                    break;
               case 'fileUploadsala':
                $idmensaje=$data->idmensaje;
             $this->mennsagesalafile($idmensaje,$from);
               default:

                    break;
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }

    private function closeConexion($id, ConnectionInterface $conn)
    {
        $this->clients->detach($conn);

        $token = base64_decode($id);

        // Actualizar estado y conexión del usuario
        User::where('id', $token)->update(['connection_id' => 0, 'user_status' => 'Offline']);

        // Obtener datos actualizados del usuario
        $userData = User::select('id', 'user_status')->where('id', $token)->get();

        $data = [
            'type' => 'userstatus',
            'user_data' => $userData ? $userData->toArray() : [],
        ];

        echo json_encode($data);
        // Enviar mensaje a todos los clientes conectados
        foreach ($this->clients as $client) {
            $client->send(json_encode($data));
        }
    }

    private function envaiarmensajesalas($menssage, $roomid, $iduser, ConnectionInterface $from)
    {
        /* procesar los mensajes guardar en bd  y retornar */

        $message = Message::create([
            'user_id' => $iduser,
            'room_id' => $roomid,
            'content' => $menssage,
        ]);

        // Realizar inner join con la tabla 'users' para obtener el nombre del usuario
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
            ->where('messages.id', $message->id)
            ->get()->toArray();

//var_dump($messageDetails);
        //$datos['mennsage']=$menssage;
        $responsesalauser = [
            'type' => 'retornamesnajesala',
            'mensajesrecibidos' => $messageDetails,
        ];
        //echo json_encode($responsesalauser);
        foreach ($this->clients as $client) {
            // Verificar si el cliente actual no es el mismo que el remitente
            if ($client !== $from) {
                // Obtener el resourceId del cliente actual
                $clientResourceId = $client->resourceId;
                //echo "bucle client" . $clientResourceId . "\n";
                // Puedes comparar los resourceId para asegurarte de que no estás enviando el mensaje al remitente
                //echo "from" . $from->resourceId . "\n";
                if ($clientResourceId !== $from->resourceId) {

                    $client->send(json_encode($responsesalauser));
                }
            }
        }
    }
    private function Priavatemenssage($id_userfrom, $message, $recipientid, ConnectionInterface $from)
    {

        $connRecipientResourceId = User::select('id', 'connection_id')
            ->where('id', $recipientid)
            ->first();

        if ($connRecipientResourceId) {

            $recipientResourceId = $connRecipientResourceId->connection_id;

        }

        $mess = Message::create([
            'user_id' => $id_userfrom,
            'recipient_id' => $recipientid,
            'content' => $message,
        ]);
        //var_dump($mess->id);
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
            ->where('messages.id', $mess->id)
            ->get()
            ->toArray();
        //var_dump($messageDetails);
        $data = [
            'type' => 'mensajedirecto',
            'mensajeprivado' => $messageDetails, // Convertir la colección a un array
        ];

        foreach ($this->clients as $client) {

            if ($client !== $from) {
                // Obtener el resourceId del cliente actual
                $clientResourceId = $client->resourceId;

                // Verificar si el cliente es el destinatario del mensaje
                if ($clientResourceId === $recipientResourceId) {

                    $client->send(json_encode($data));
                }
            }
        }

    }

    private function msgadduserchat($idmensaje, $recipientid, ConnectionInterface $from)
    {
        //var_dump()
        $connRecipientResourceId = User::select('id', 'connection_id')
            ->where('id', $recipientid)
            ->first();

        if ($connRecipientResourceId) {
           //echo "al if en true ";
            $recipientResourceId = $connRecipientResourceId->connection_id;

        }else{
     echo "al if en false ";
       $recipientResourceId=0;
      }

        //var_dump($mess->id);
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
            ->where('messages.id', $idmensaje)
            ->get()
            ->toArray();
        //var_dump($messageDetails);
        $data = [
            'type' => 'adduserchat',
            'mensajeprivado' => $messageDetails, // Convertir la colección a un array
        ];

        foreach ($this->clients as $client) {

            if ($client !== $from) {
                // Obtener el resourceId del cliente actual
                $clientResourceId = $client->resourceId;

                // Verificar si el cliente es el destinatario del mensaje
                if ($clientResourceId === $recipientResourceId) {
                    //echo  json_encode($data);
                    $client->send(json_encode($data));
                }
            }
        }

    }

    private function estadomensagge($id_userfrom, $recipientid, ConnectionInterface $from)
    {

        $mess = Message::where('user_id', $id_userfrom)
            ->where('recipient_id', $recipientid)
            ->update([
                'messages_status' => 'Leido',
            ]);

        $data = [
            'type' => 'confirmacionlectura',
            'data' => 'lectura',
        ];
        foreach ($this->clients as $client) {
            $client->send(json_encode($data));
        }
        /*estadomensaje*/

    }
    private function saveFile($filename, $fileType, $base64Data)
    {
        // Usar el nombre original del archivo o generar uno único si no está disponible
        $filename = ($filename) ? $filename : $this->generateUniqueFilename($fileType, $base64Data);

        // Decodificar la cadena Base64 y guardar el archivo en la carpeta correspondiente
        $directory = ($fileType === 'image') ? 'images/' : 'files/';
        $fileContent = base64_decode($base64Data);
        $filePath = public_path($directory) . $filename;

        if (file_put_contents($filePath, $fileContent) !== false) {
            return $filename;
        }

        return null; // Devuelve null si hay un error al guardar el archivo
    }
    private function menssageconadjunto($recipientid, $idmensaje, ConnectionInterface $from)
    {

        //$savedFilename = $this->saveFile($filename, $fileType, $base64Data);
        $connRecipientResourceId = User::select('id', 'connection_id')
            ->where('id', $recipientid)
            ->first();

        if ($connRecipientResourceId) {
            $recipientResourceId = $connRecipientResourceId->connection_id;
        }

//var_dump($mess);
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
            ->where('messages.id', $idmensaje)
            ->get()
            ->toArray();

        $data = [
            'type' => 'mensajedirecto2',
            'mensajeprivado' => $messageDetails,
        ];

        foreach ($this->clients as $client) {
            if ($client !== $from) {
                $clientResourceId = $client->resourceId;
                if ($clientResourceId === $recipientResourceId) {
                    $client->send(json_encode($data));
                }
            }
        }
    }

   private function mennsagesalafile($messageid, ConnectionInterface $from){

  $messageController = app(messageController::class);

    $messageDetails=$messageController->obtenermensajesalaid($messageid);

//print_r(json_encode($messageDetails,true));
//die();
        //$datos['mennsage']=$menssage;
        $responsesalauser = [
            'type' => 'retornamesnajesala',
            'mensajesrecibidos' => $messageDetails,
        ];
        //echo json_encode($responsesalauser);
        foreach ($this->clients as $client) {
            // Verificar si el cliente actual no es el mismo que el remitente
            if ($client !== $from) {
                // Obtener el resourceId del cliente actual
                $clientResourceId = $client->resourceId;
                //echo "bucle client" . $clientResourceId . "\n";
                // Puedes comparar los resourceId para asegurarte de que no estás enviando el mensaje al remitente
                //echo "from" . $from->resourceId . "\n";
                if ($clientResourceId !== $from->resourceId) {

                    $client->send(json_encode($responsesalauser));
                }
            }
        }
   }
    protected function sendHeaders(ConnectionInterface $conn)
    {
        // Configurar las cabeceras CORS necesarias
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Headers' => 'Origin, Content-Type, X-Auth-Token',
            'Access-Control-Allow-Credentials' => 'true',
        ];

        foreach ($headers as $key => $value) {
            $conn->send(json_encode(['header' => [$key => $value]]));
        }
    }

}
