<?php

namespace App\Http\Controllers;
use App\Models\Contacto;
use Illuminate\Http\Request;

class ImportContactoGooglePorSubetiquetaController extends Controller{
    public function index(){
        $contactosgoogleporsubetiqueta =  Contacto::all();
        return view ('contactosgoogleporsubetiqueta.index', compact('contactosgoogleporsubetiqueta'));
    }
    public function create(){
    }
    public function store(Request $request){
    }
    public function show(Contacto $contacto){
    }
    public function edit(Contacto $contacto){
    }
    public function update(Request $request, Contacto $contacto){
    }
    public function destroy(Contacto $contacto){
    }
}