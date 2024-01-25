<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etiqueta;
use App\Models\Subetiqueta;
use App\Models\Contacto;

class EtiquetaController extends Controller{
    public function index(){
        $etiquetas = Etiqueta::all();
        $subetiquetas = Subetiqueta::all();
        $contactos = Contacto::all();
        return view('etiquetas.index', compact('etiquetas', 'subetiquetas', 'contactos'));
    }
    public function show(Etiqueta $etiqueta){
        return view ('etiquetas.show', compact('etiqueta'));
    }
    public function create(){
        return view ('etiquetas.create');
    }
    public function store(Request $request){
        $subetiquetas = Subetiqueta::all();

        $request->validate([
            'nombre' => 'required',
        ]);
        
        $etiqueta = Etiqueta::create([
            'nombre' => $request->nombre,
        ]);
        $etiquetas =  Etiqueta::all();
        return redirect()->route('etiquetas.index', compact('etiquetas', 'subetiquetas'));
    }
    public function edit(Etiqueta $etiqueta){
        return view ('etiquetas.edit', compact('etiqueta'));
    }
    public function update(Request $request, Etiqueta $etiqueta){
        $etiqueta->update($request->all());
        return redirect()->back()->with('info', 'etiqueta Actualizado');    
    }
    public function destroy(Etiqueta $etiqueta){
        $etiqueta->delete();
        $etiquetas = Etiqueta::all();
        $subetiquetas =  Subetiqueta::all();
        return view ('etiquetas.index', compact('etiquetas', 'subetiquetas'));
    }
}