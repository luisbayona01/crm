<?php

namespace App\Http\Controllers;
use App\Models\Contacto;
use Illuminate\Http\Request;

class ImportController extends Controller{
    public function index(){
        $contacts =  Contacto::all();
        return view ('contacts.index', compact('contacts'));
    }   
}