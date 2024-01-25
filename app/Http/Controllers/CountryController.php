<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Country;

class CountryController extends Controller{
    public function index(){
        $countries =  Country::all();
        return view ('countries.index', compact('countries'));
    }
    public function show(Country $country){
        return view ('countries.show', compact('country'));
    }
    public function create(){
        return view('countries.create');
    }
    public function store(Request $request){ 
        // BAMDERA
        if ($request->hasFile('urlbandera')) {
            // Subir la imagen de perfil al servidor
            $ruta_imagen = $request->file('urlbandera')->store('public/img/img-paises');
            $ruta_imagen = str_replace('public', 'storage', $ruta_imagen);
        } else {
            $ruta_imagen = asset('img/pais-preview.png');
        }
        $country = Country::create([
            'nombre' => $request->nombre,
            'urlbandera' => $ruta_imagen,
            'codigotelefono' => $request->codigotelefono,
        ]);
        $countries = Country::all();
        return redirect()->route('countries.index', compact('countries'));
    }    
    public function edit(Country $country){
        return view ('countries.edit', compact('country'));
    }
    public function update(Request $request, Country $country){
        // BAMDERA
        if($request->hasFile('urlbandera')){
            // Eliminar la imagen anterior si se subió una nueva imagen
            if($country->urlbandera && Storage::exists(str_replace('storage', 'public', $country->urlbandera))){
                Storage::delete(str_replace('storage', 'public', $country->urlbandera));
            }
            // Subir la imagen al servidor
            $ruta_imagen = $request->file('urlbandera')->store('public/img/img-paises');
            $ruta_imagen = str_replace('public', 'storage', $ruta_imagen);
        } else {
            $ruta_imagen = $country->urlbandera;
        }
        //Actualizar País
        $country->update([
            'nombre' => $request->nombre,
            'urlbandera' => $ruta_imagen,
            'codigotelefono' => $request->codigotelefono,
        ]);
        return redirect()->back()->with('info', 'pais Actualizado');    
    }
    public function destroy(Country $country){
        // BANDERA
        if (Storage::exists(str_replace('storage', 'public', $country->urlbandera))) {
            // Eliminar la imagen del almacenamiento
            Storage::delete(str_replace('storage', 'public', $country->urlbandera));
        }
        $country->delete();
        $countries = Country::all();
        return redirect()->route('countries.index', compact('countries'));
    }
}