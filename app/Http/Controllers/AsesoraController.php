<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asesora;

class AsesoraController extends Controller
{
    public function index(){
        $asesoras =  Asesora::all();
        return view ('asesoras.index', compact('asesoras'));
    }
    public function show(Asesora $asesora){
        return view ('asesoras.show', compact('asesora'));
    }
    public function create(){
        return view ('asesoras.create');
    }
    public function store(Request $request){
        $request->validate([
            'nombre' => 'required',
            'iniciales' => 'required',
        ]);
        
        $asesora = Asesora::create([
            'nombre' => $request->nombre,
            'iniciales' => $request->iniciales,
        ]);
        $asesoras =  Asesora::all();
        return redirect()->route('asesoras.index', compact('asesoras'));
    }
    public function edit(Asesora $asesora){
        return view ('asesoras.edit', compact('asesora'));
    }
    public function update(Request $request, Asesora $asesora){
        $asesora->update($request->all());
        return redirect()->back()->with('info', 'asesora Actualizado');    
    }
    public function destroy(Asesora $asesora){
        $asesora->delete();
        $asesoras = Asesora::all();
        return view ('asesoras.index', compact('asesoras'));
    }
}
