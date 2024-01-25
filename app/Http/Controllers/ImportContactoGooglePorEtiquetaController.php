<?php
namespace App\Http\Controllers;
use App\Models\Contacto;
use Illuminate\Http\Request;

class ImportContactoGooglePorEtiquetaController extends Controller{
    public function index(){
        $contactosgoogleporetiqueta =  Contacto::all();
        return view ('contactosgoogleporetiqueta.index', compact('contactosgoogleporetiqueta'));
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