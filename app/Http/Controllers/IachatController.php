<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IachatController extends Controller{
    public function index(){
        return view ('iachat.index');
    }
    public function show(Version $version){
        
    }
    public function create(){
        
    }
    public function store(Request $request){

    }
    public function edit(Version $version){
    }
    public function update(Request $request, Version $version){
            
    }
    public function destroy(Version $version){
        
    }
}
