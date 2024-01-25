<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomUser;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class RoomController
 * @package App\Http\Controllers
 */
class RoomController extends Controller
{
    public function index()
    {

        return view('room.index');
    }
    public function listrooms()
    {
        $user = Auth::user();
        //dd($user);
        //$fullStoragePath = storage_path('app\public');
        //dd($fullStoragePath);

        $roomIds = DB::table('room_user')
            ->where('iduser', '=', $user->id)
            ->distinct()
            ->pluck('idroom')
            ->toArray();



        $userId =  $user->id;

  $usersChattedWith = DB::table('messages')
    ->select('user_id as usersid')
    ->where('recipient_id', '=',$userId)
    ->whereNotNull('user_id')
    ->union(
        DB::table('messages')
            ->select('recipient_id as usersid')
            ->where('user_id', '=', $userId)
            ->whereNotNull('recipient_id')
    )
    ->pluck('usersid')
    ->toArray();


$contactsWithMessages = DB::table('users')
    ->join('room_user', 'users.id', '=', 'room_user.iduser')
    ->whereIn('room_user.idroom', $roomIds)
   ->whereIn('users.id', $usersChattedWith) // Aplicar filtro con el resultado de la primera consulta
    ->groupBy('room_user.iduser')
    ->select([
        'users.id as iduser',
        'users.urlfotoperfil',
        'users.name',
        'users.username',
        'users.user_status',
        DB::raw('COUNT(messages.id) as message_count'), // Agrega el conteo de mensajes
    ])
    ->leftJoin('messages', function ($join) {
        $join->on('users.id', '=', 'messages.user_id')
            ->where('messages.recipient_id', '=', auth()->id())
            ->where('messages.messages_status', '=', 'Entregado');
    })
    ->orderByDesc('message_count');

$contactsWithSentMessages = clone $contactsWithMessages;

$contactsWithSentMessages
    ->leftJoin('messages as sent_messages', function ($join) {
        $join->on('users.id', '=', 'sent_messages.recipient_id')
            ->where('sent_messages.user_id', '=', Auth::user()->id)
            ->where('sent_messages.messages_status', '=', 'Entregado');
    });

$finalResult = $contactsWithMessages->union($contactsWithSentMessages)
    ->orderByDesc('message_count')
    ->get();



// Consulta para obtener las salas a las que perteneces
        $rooms = DB::table('rooms')
            ->select('rooms.id', 'rooms.nombre', DB::raw('COUNT(DISTINCT room_user.iduser) as user_count'))
            ->join('room_user', 'rooms.id', '=', 'room_user.idroom')
            ->where('room_user.idroom','!=','2')
             ->whereIn('room_user.idroom', $roomIds)
            ->groupBy('rooms.id', 'rooms.nombre')
            ->get();


    $contacts = DB::table('users')
    ->join('room_user', 'users.id', '=', 'room_user.iduser')
    ->whereIn('room_user.idroom', $roomIds)
    ->whereNotIn('users.id', $usersChattedWith)
    ->groupBy('room_user.iduser')
    ->get();




        return response()->json([
            'usersInRooms' => $finalResult,
            'rooms' => $rooms,
            'contacs'=>$contacts

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $room = new Room();
        $usuarios = User::where('id', '!=', auth()->user()->id)->pluck('name', 'id');
        return view('room.create', compact('room', 'usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //request()->validate(Room::$rules);
        //dd($request->input('nombre'));

        $room = Room::create(["nombre" => $request->input('nombre')]);
        for ($i = 0; $i < count($request->usuarios); $i++) {
            RoomUser::create(["idroom" => $room->id, "iduser" => $request->usuarios[$i]]);
            RoomUser::create(["idroom" => $room->id, "iduser" => auth()->user()->id]);
        }
        //dd($request->usuarios);
        //die();
        //$roomuser= RoomUser::create();

        return redirect()->route('rooms.index')
            ->with('success', 'Room created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::find($id);
        $usuarios = User::pluck('name', 'id');

        return view('room.show', compact('room', 'usuarios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $rooms = Room::pluck('nombre', 'id');

        return view('room.edit', compact('rooms'));
    }


    public function updatesala(Request $request)
    {
        //request()->validate(Room::$rules);
        $id=$request->id;
        $room= Room::find($id);
        $data=$request->all();
        unset($data['id']);
        $room->fill($data);

        // Guarda los cambios en la base de datos
        $room->save();

       return response()->json([
                        'ok' => true,
                        'respuesta' => 'Se edito la sala',
                    ]);

    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $room = Room::find($id)->delete();

        return response()->json([
                        'ok' => true,
                        'respuesta' => 'Se elimino la sala',
                    ]);

    }


  public function usersroms($idroom)
{
    $authUserId = auth()->id();

    $result = DB::table('users as U')
    ->leftJoin('room_user as rmU', 'U.id', '=', 'rmU.iduser')
    ->select('U.id', 'U.name', 'rmU.iduser as usuariosala', 'rmU.idroom')
    ->where(function ($query) use ($authUserId) {
        $query->where('rmU.iduser', '!=', $authUserId)
              ->orWhereNull('rmU.idroom');
    })
    ->groupBy('U.id')
    ->get();
  //dd($usersWithRoom);

    return $result;
}

 public function  updateroomuser(Request $request){

$room_id = $request->idroom;

//$authUserId = auth()->id();
//dd($request->iduser);


// Realizar la eliminación basándote en el nombre de usuario
RoomUser::where('idroom', $room_id)->delete();
for ($i = 0; $i < count($request->iduser); $i++) {
            RoomUser::create(["idroom" => $room_id, "iduser" => $request->iduser[$i]]);
            RoomUser::create(["idroom" => $room_id, "iduser" => auth()->user()->id]);
        }
   return redirect()->route('rooms.index')
            ->with('success', 'Roomuser upadte  successfully.');

}


/* RoomUser:: logica  para agregar usuarios  ala  sala creada*/

}
