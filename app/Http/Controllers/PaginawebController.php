<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Paginaweb;

class PaginawebController extends Controller{
    public function index(){
        $paginaswebs = Paginaweb::with('user')->orderBy('created_at', 'desc')->get();
        return view ('paginaswebs.index', compact('paginaswebs'));
    }
    public function show(Paginaweb $paginaweb){
        return view ('paginaswebs.show', compact('paginaweb'));
    }
    public function create(){
        return view ('paginaswebs.create');
    }
    public function store(Request $request){
        // PORTADA
        if ($request->hasFile('urlportada')) {
            // Subir la imagen de portada al servidor
            $ruta_imagen = $request->file('urlportada')->store('public/img/img-paginaswebs');
            $ruta_imagen = str_replace('public', 'storage', $ruta_imagen);
        } else {
            $ruta_imagen = asset('img/portada-preview.png');
        }
        // LOGO
        if ($request->hasFile('urllogo')) {
            // Subir el logo al servidor
            $ruta_imagen2 = $request->file('urllogo')->store('public/img/img-paginaswebs');
            $ruta_imagen2 = str_replace('public', 'storage', $ruta_imagen2);
        } else {
            $ruta_imagen2 = asset('img/logo-preview.png');
        }
        // IMAGEN1
        if ($request->hasFile('urlimagen1')) {
            // Subir la imagen 1 al servidor
            $ruta_imagen3 = $request->file('urlimagen1')->store('public/img/img-paginaswebs');
            $ruta_imagen3 = str_replace('public', 'storage', $ruta_imagen3);
        } else {
            $ruta_imagen3 = asset('img/propiedad-preview.png');
        }
        // IMAGEN2
        if ($request->hasFile('urlimagen2')) {
            // Subir la imagen 2 al servidor
            $ruta_imagen4 = $request->file('urlimagen2')->store('public/img/img-paginaswebs');
            $ruta_imagen4 = str_replace('public', 'storage', $ruta_imagen4);
        } else {
            $ruta_imagen4 = asset('img/propiedad-preview.png');
        }
        $paginaweb = Paginaweb::create([
            'urlportada'=>$ruta_imagen,
            'urllogo'=>$ruta_imagen2,
            'urlimagen1'=>$ruta_imagen3,
            'urlimagen2'=>$ruta_imagen4,
            'userid'=>$request->userid,
            'titulo'=>$request->titulo,
            'slogan'=>$request->slogan,
            'quienessomos'=>$request->quienessomos,
            'mision'=>$request->mision,
            'vision'=>$request->vision,
            'iformacion'=>$request->iformacion,
            'informaciondelequipo'=>$request->informaciondelequipo,
            'tituloservicio1'=>$request->tituloservicio1,
            'tituloservicio2'=>$request->tituloservicio2,
            'tituloservicio3'=>$request->tituloservicio3,
            'descripcionservicio1'=>$request->descripcionservicio1,
            'descripcionservicio2'=>$request->descripcionservicio2,
            'descripcionservicio3'=>$request->descripcionservicio3,
            'urlfacebook'=>$request->urlfacebook,
            'urlinstagram'=>$request->urlinstagram,
            'telefono'=>$request->telefono,
            'correo'=>$request->correo,
            'direccion'=>$request->direccion,
        ]);
        $paginaswebs =  Paginaweb::all();
        return redirect()->route('paginaswebs.index', compact('paginaswebs'));
    }
    public function edit(Paginaweb $paginaweb){
        return view ('paginaswebs.edit', compact('paginaweb'));
    }
    public function update(Request $request, Paginaweb $paginaweb){
        // PORTADA
        if($request->hasFile('urlportada')){
            // Eliminar la portada anterior si se subió una nueva portada
            if($paginaweb->urlportada && Storage::exists(str_replace('storage', 'public', $paginaweb->urlportada))){
                Storage::delete(str_replace('storage', 'public', $paginaweb->urlportada));
            }
            // Subir la portada al servidor
            $ruta_imagen = $request->file('urlportada')->store('public/img/img-paginaswebs');
            $ruta_imagen = str_replace('public', 'storage', $ruta_imagen);
        } else {
            $ruta_imagen = $paginaweb->urlportada;
        }
        // LOGO
        if($request->hasFile('urllogo')){
            // Eliminar logo anterior si se subió un nuevo logo
            if($paginaweb->urllogo && Storage::exists(str_replace('storage', 'public', $paginaweb->urllogo))){
                Storage::delete(str_replace('storage', 'public', $paginaweb->urllogo));
            }
            // Subir el logo al servidor
            $ruta_imagen2 = $request->file('urllogo')->store('public/img/img-paginaswebs');
            $ruta_imagen2 = str_replace('public', 'storage', $ruta_imagen2);
        } else {
            $ruta_imagen2 = $paginaweb->urllogo;
        }
        // IMAGEN 1
        if($request->hasFile('urlimagen1')){
            // Eliminar la imagen 1 anterior si se subió una nueva imagen 1
            if($paginaweb->urlimagen1 && Storage::exists(str_replace('storage', 'public', $paginaweb->urlimagen1))){
                Storage::delete(str_replace('storage', 'public', $paginaweb->urlimagen1));
            }
            // Subir la imagen 1 al servidor
            $ruta_imagen3 = $request->file('urlimagen1')->store('public/img/img-paginaswebs');
            $ruta_imagen3 = str_replace('public', 'storage', $ruta_imagen3);
        } else {
            $ruta_imagen3 = $paginaweb->urlimagen1;
        }
        // IMAGEN 2
        if($request->hasFile('urlimagen2')){
            // Eliminar la imagen 2 anterior si se subió una nueva imagen 2
            if($paginaweb->urlimagen2 && Storage::exists(str_replace('storage', 'public', $paginaweb->urlimagen2))){
                Storage::delete(str_replace('storage', 'public', $paginaweb->urlimagen2));
            }
            // Subir la imagen 2 al servidor
            $ruta_imagen4 = $request->file('urlimagen2')->store('public/img/img-paginaswebs');
            $ruta_imagen4 = str_replace('public', 'storage', $ruta_imagen4);
        } else {
            $ruta_imagen4 = $paginaweb->urlimagen2;
        }
        //Actualizar Página web
        $paginaweb->update([
            'urlportada'=>$ruta_imagen,
            'urllogo'=>$ruta_imagen2,
            'urlimagen1'=>$ruta_imagen3,
            'urlimagen2'=>$ruta_imagen4,
            'userid'=>$request->userid,
            'titulo'=>$request->titulo,
            'slogan'=>$request->slogan,
            'quienessomos'=>$request->quienessomos,
            'mision'=>$request->mision,
            'vision'=>$request->vision,
            'iformacion'=>$request->iformacion,
            'informaciondelequipo'=>$request->informaciondelequipo,
            'tituloservicio1'=>$request->tituloservicio1,
            'tituloservicio2'=>$request->tituloservicio2,
            'tituloservicio3'=>$request->tituloservicio3,
            'descripcionservicio1'=>$request->descripcionservicio1,
            'descripcionservicio2'=>$request->descripcionservicio2,
            'descripcionservicio3'=>$request->descripcionservicio3,
            'urlfacebook'=>$request->urlfacebook,
            'urlinstagram'=>$request->urlinstagram,
            'correo'=>$request->correo,
            'telefono'=>$request->telefono,
            'direccion'=>$request->direccion,
        ]);
        return redirect()->back()->with('info', 'Página actualizada');    
    }
    public function destroy(Paginaweb $paginaweb){
        // Verificar si la portada asociada al paginaweb existe en el almacenamiento
        if (Storage::exists(str_replace('storage', 'public', $paginaweb->urlportada))) {
            // Eliminar la portada del almacenamiento
            Storage::delete(str_replace('storage', 'public', $paginaweb->urlportada));
        }
        // Verificar si el logo asociada al paginaweb existe en el almacenamiento
        if (Storage::exists(str_replace('storage', 'public', $paginaweb->urllogo))) {
            // Eliminar el logo del almacenamiento
            Storage::delete(str_replace('storage', 'public', $paginaweb->urllogo));
        }
        // Verificar si la imagen 1 asociada al paginaweb existe en el almacenamiento
        if (Storage::exists(str_replace('storage', 'public', $paginaweb->urlimagen1))) {
            // Eliminar la imagen 1 del almacenamiento
            Storage::delete(str_replace('storage', 'public', $paginaweb->urlimagen1));
        }
        // Verificar si la imagen 2 asociada al paginaweb existe en el almacenamiento
        if (Storage::exists(str_replace('storage', 'public', $paginaweb->urlimagen2))) {
            // Eliminar la imagen 2 del almacenamiento
            Storage::delete(str_replace('storage', 'public', $paginaweb->urlimagen2));
        }
        $paginaweb->delete();
        $paginaswebs = Paginaweb::all();
        return redirect()->route('paginaswebs.index', compact('paginaswebs'));
    }
}