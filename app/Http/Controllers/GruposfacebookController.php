<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gruposfacebook;
use App\Models\Country;

class GruposfacebookController extends Controller{
    public function index(){
        $gruposfacebooks =  Gruposfacebook::all();
        return view ('gruposfacebook.index', compact('gruposfacebooks'));
    }
    public function show(Gruposfacebook $gruposfacebook){
        return view ('gruposfacebook.show', compact('gruposfacebook'));
    }
    public function create(){
        $paises =  Country::all();
        return view ('gruposfacebook.create', compact('paises'));
    }
    public function store(Request $request){
        $gruposfacebook = Gruposfacebook::create([
            'urlgrupo' => $request->urlgrupo,
            'nombre' => $request->nombre,
            'pais' => $request->pais,
            'cantidadmiembros' => $request->cantidadmiembros,
        ]);
        $gruposfacebooks =  Gruposfacebook::all();
        return redirect()->route('gruposfacebook.index', compact('gruposfacebooks'));
    }
    public function edit(Gruposfacebook $gruposfacebook){
        $paises =  Country::all();
        return view ('gruposfacebook.edit', compact('gruposfacebook', 'paises'));
    }
    public function update(Request $request, Gruposfacebook $gruposfacebook){
        $gruposfacebook->update($request->all());
        return redirect()->back()->with('info', 'Grupo actualizado');    
    }
    public function destroy(Gruposfacebook $gruposfacebook){
        $gruposfacebook->delete();
        $gruposfacebooks = Gruposfacebook::all();
        return redirect()->route('gruposfacebook.index', compact('gruposfacebooks'));
    }
}