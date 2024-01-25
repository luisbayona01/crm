<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacto;
use App\Models\Subetiqueta;
use App\Models\Etiqueta;


class SubetiquetaController extends Controller{
    public function index(){
        $subetiquetas = Subetiqueta::all();
        return view('subetiquetas.index', compact('subetiquetas'));
    }
    public function create(){
        $etiquetas = Etiqueta::all();
        return view('subetiquetas.create', compact('etiquetas'));
    }
    public function store(Request $request){
        // Validar los datos enviados por el formulario
        $request->validate([
            'etiqueta_id' => 'required|exists:etiquetas,id',
            'nombre' => 'required|max:255',
        ]);
    
        // Crear la nueva subetiqueta con los datos del formulario
        $subetiqueta = new Subetiqueta();
        $subetiqueta->etiqueta_id = $request->etiqueta_id;
        $subetiqueta->nombre = $request->nombre;
        $subetiqueta->save();
    
        // Redirigir al usuario a la página de detalles de la subetiqueta recién creada
        return redirect()->route('subetiquetas.show', $subetiqueta);
    }
    public function show(Subetiqueta $subetiqueta){
        return view ('subetiquetas.show', compact('subetiqueta'));
    }
    public function edit(Subetiqueta $subetiqueta){
        return view ('subetiquetas.edit', compact('subetiqueta'));
    }
    public function update(Request $request, Subetiqueta $subetiqueta){
        $subetiqueta->update($request->all());
        return redirect()->back()->with('info', 'Subetiqueta Actualizado');
    }
    public function destroy(Subetiqueta $subetiqueta){
        $subetiqueta->contactos()->detach(); // Elimina todas las relaciones con contactos
        $subetiqueta->delete(); // Elimina la subetiqueta
        $etiquetas = Etiqueta::all();
        $subetiquetas =  Subetiqueta::all();
        return view ('etiquetas.index', compact('etiquetas', 'subetiquetas'));
    }
}