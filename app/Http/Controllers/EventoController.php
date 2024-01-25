<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Evento;
use App\Models\Country;
use App\Models\User;
use App\Models\Contacto;
use Carbon\Carbon;

class EventoController extends Controller{
    public function index(){
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $eventos = Evento::orderByRaw('CASE WHEN fecha > NOW() THEN 0 ELSE 1 END, fecha ASC')->paginate(100);
        } else {
            $eventos = Evento::where('userid', $user->id)->orderByRaw('CASE WHEN fecha > NOW() THEN 0 ELSE 1 END, fecha ASC')->paginate(100);
        }
        $contactos = Contacto::all();
        return view('eventos.index', compact('eventos', 'contactos'));
    }
    public function show(Evento $evento){
        $evento->fecha = Carbon::parse($evento->fecha);
        return view ('eventos.show', compact('evento'));
    }
    public function create(){
        $paises = Country::all();
        return view('eventos.create', compact('paises'));
    }
    public function store(Request $request){
        // IMAGEN
        if ($request->hasFile('urlimagen')) {
            // Subir la imagen de perfil al servidor
            $ruta_imagen = $request->file('urlimagen')->store('public/img/img-eventos');
            $ruta_imagen = str_replace('public', 'storage', $ruta_imagen);
        } else {
            $ruta_imagen = asset('img/evento-preview.png');
        }
        $evento = Evento::create([
            'urlimagen' => $ruta_imagen,
            'userid' => $request->userid,
            'nombre' => $request->nombre,
            'fecha' => $request->fecha,
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'pais' => $request->pais,
            'urldeacceso' => $request->urldeacceso,
            'destacado' => $request->destacado,
        ]);
        $eventos = Evento::all();
        return redirect()->route('eventos.index', compact('eventos'));
    }    
    public function edit(Evento $evento){
        $paises = Country::all();
        $fecha = Carbon::parse($evento->fecha)->format('Y-m-d\TH:i');
        return view ('eventos.edit', compact('evento', 'paises', 'fecha'));
    }
    public function update(Request $request, Evento $evento){
        // IMAGEN
        if($request->hasFile('urlimagen')){
            // Eliminar la imagen anterior si se subió una nueva imagen
            if($evento->urlimagen && Storage::exists(str_replace('storage', 'public', $evento->urlimagen))){
                Storage::delete(str_replace('storage', 'public', $evento->urlimagen));
            }
            // Subir la imagen al servidor
            $ruta_imagen = $request->file('urlimagen')->store('public/img/img-eventos');
            $ruta_imagen = str_replace('public', 'storage', $ruta_imagen);
        } else {
            $ruta_imagen = $evento->urlimagen;
        }
        //Actualizar evento
        $evento->update([
            'userid' => $request->userid,
            'nombre' => $request->nombre,
            'fecha' => $request->fecha,
            'tipo' => $request->tipo,
            'urlimagen' => $ruta_imagen,
            'descripcion' => $request->descripcion,
            'pais' => $request->pais,
            'urldeacceso' => $request->urldeacceso,
            'destacado' => $request->destacado,
        ]);
        return redirect()->back()->with('info', 'Evento Actualizado');    
    }
    public function destroy(Evento $evento){
        // Verificar si la imagen asociada al evento existe en el almacenamiento
        if (Storage::exists(str_replace('storage', 'public', $evento->urlimagen))) {
            // Eliminar la imagen del almacenamiento
            Storage::delete(str_replace('storage', 'public', $evento->urlimagen));
        }
        $evento->delete();
        $eventos = Evento::all();
        return redirect()->route('eventos.index', compact('eventos'));
    }
}