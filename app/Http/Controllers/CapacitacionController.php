<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capacitacion;
use App\Models\Country;

class CapacitacionController extends Controller{
    public function index(){
        // Obtener la última capacitación
        $ultimaCapacitacion = Capacitacion::latest('created_at')->first(); 
        // Verificar si se obtuvo una última capacitación
        if($ultimaCapacitacion) {
            // Obtener todas las capacitaciones excluyendo la última
            $capacitaciones = Capacitacion::whereNotIn('id', [$ultimaCapacitacion->id])->orderBy('created_at', 'desc')->paginate(30);
        }else {
            // Si no hay última capacitación, obtener todas las capacitaciones
            $capacitaciones = Capacitacion::orderBy('created_at', 'desc')->paginate(30);
        }
        return view('capacitaciones.index', compact('capacitaciones', 'ultimaCapacitacion'));
    }
    public function show(Capacitacion $capacitacion){
        return view ('capacitaciones.show', compact('capacitacion'));
    }
    public function create(){
        $paises = Country::all();
        return view ('capacitaciones.create', compact('paises'));
    }
    public function store(Request $request){
        $capacitacion = Capacitacion::create([
            'titulo'=> $request->titulo,
            'urlvideo'=> $request->urlvideo,
            'pais'=> $request->pais,
            'tipo'=> $request->tipo,
            'destacar'=> $request->destacar,
        ]);
        $capacitaciones =  Capacitacion::all();
        return redirect()->route('capacitaciones.index', compact('capacitaciones'));
    }
    public function edit(Capacitacion $capacitacion){
        $paises = Country::all();
        return view ('capacitaciones.edit', compact('capacitacion', 'paises'));
    }
    public function update(Request $request, Capacitacion $capacitacion){
        $capacitacion->update($request->all());
        return redirect()->back()->with('info', 'capacitacion Actualizada');    
    }
    public function destroy(Capacitacion $capacitacion){
        $capacitacion->delete();
        $capacitaciones = Capacitacion::all();
        return redirect()->route('capacitaciones.index', compact('capacitaciones'));
    }
}