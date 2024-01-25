<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaccion;

use App\Mail\ContactanosMailable;
use Illuminate\Support\Facades\Mail;

class ContactanosController extends Controller{
    public function index(){
        return view ('contactanos.index');
    }
    public function store(Request $request){
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email',
            'mensaje' => 'required',
        ]);
        $correo = new ContactanosMailable($request->all());
        Mail::to('correodeformulariosdecontacto@gmail.com')->send($correo);
        return redirect()->route('contactanos.index')->with('info', 'Mensaje enviado');
    }
    // NOTIFICACIÓN
    public function notificacion(){
        $transacciones = Transaccion::all();
        return view ('contactanos.notificacion', compact('transacciones'));
    }
    public function storenotificacion(Request $request){
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required',
            'mensaje' => 'required',
        ]);
        $correo = new ContactanosMailable($request->all());
        Mail::to('correodeformulariosdecontacto@gmail.com')->send($correo);
        return redirect()->route('home');
    }
}