<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Evento;
use App\Models\Gruposfacebook;
use App\Models\Publicacion;
use Carbon\Carbon;

class PublicacionController extends Controller{
    public function index(){
        $publicacions = Publicacion::with('user')->orderBy('created_at', 'desc')->get();
        return view ('publicacions.index', compact('publicacions'));
    }
    public function show(Publicacion $publicacion){
        return view ('publicacions.show', compact('publicacion'));
    }
    public function create(){
        return view ('publicacions.create');
    }
    public function store(Request $request){
        // IMAGEN
        if ($request->hasFile('urlimagen')) {
            // Subir la imagen de perfil al servidor
            $ruta_imagen = $request->file('urlimagen')->store('public/img/img-posts');
            $ruta_imagen = str_replace('public', 'storage', $ruta_imagen);
        } else {
            $ruta_imagen = asset('img/propiedad-preview.png');
        }
        $publicacion = Publicacion::create([
            'userid' => $request->userid,
            'urlimagen' => $ruta_imagen,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'pais' => $request->pais,
            'ubicacion' => $request->ubicacion,
            'precio' => $request->precio,
            'comision' => $request->comision,
        ]);
        $users = User::all();
        $eventos = Evento::where('fecha', '>', Carbon::now())->get();
        $gruposfacebooks = Gruposfacebook::all();
        $publicacions = Publicacion::with('user')->orderBy('created_at', 'desc')->get();
        return redirect()->route('home', compact('publicacions', 'users', 'gruposfacebooks', 'eventos'));
    }
    public function edit(Publicacion $publicacion){
        return view ('publicacions.edit', compact('publicacion'));
    }
    public function update(Request $request, Publicacion $publicacion){
        // IMAGEN
        if($request->hasFile('urlimagen')){
            // Eliminar la imagen anterior si se subió una nueva imagen
            if($publicacion->urlimagen && Storage::exists(str_replace('storage', 'public', $publicacion->urlimagen))){
                Storage::delete(str_replace('storage', 'public', $publicacion->urlimagen));
            }
            // Subir la imagen al servidor
            $ruta_imagen = $request->file('urlimagen')->store('public/img/img-posts');
            $ruta_imagen = str_replace('public', 'storage', $ruta_imagen);
        } else {
            $ruta_imagen = $publicacion->urlimagen;
        }
        //Actualizar Publicación
        $publicacion->update([
            'userid' => $request->userid,
            'urlimagen' => $ruta_imagen,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'pais' => $request->pais,
            'ubicacion' => $request->ubicacion,
            'precio' => $request->precio,
            'comision' => $request->comision,
        ]);
        return redirect()->back()->with('info', 'Grupo actualizado');    
    }
    public function destroy(Publicacion $publicacion){
        // Verificar si la imagen asociada a la publicacion existe en el almacenamiento
        if (Storage::exists(str_replace('storage', 'public', $publicacion->urlimagen))) {
            // Eliminar la imagen del almacenamiento
            Storage::delete(str_replace('storage', 'public', $publicacion->urlimagen));
        }
        $publicacion->delete();
        $publicacions = Publicacion::all();
        return view ('publicacions.index', compact('publicacions'));
    }
}