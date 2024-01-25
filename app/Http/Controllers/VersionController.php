<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Version;

class VersionController extends Controller{
    public function index(){
        $versions =  Version::all();
        return view ('versions.index', compact('versions'));
    }
    public function show(Version $version){
        return view ('versions.show', compact('version'));
    }
    public function create(){
        return view ('versions.create');
    }
    public function store(Request $request){
        $version = Version::create([
            'version' => $request->version,
            'comentario' => $request->comentario,
        ]);
        $versions =  Version::all();
        return redirect()->route('versions.index', compact('versions'));
    }
    public function edit(Version $version){
        return view ('versions.edit', compact('version'));
    }
    public function update(Request $request, Version $version){
        $version->update($request->all());
        return redirect()->back()->with('info', 'version Actualizado');    
    }
    public function destroy(Version $version){
        $version->delete();
        $versions = Version::all();
        return redirect()->route('versions.index', compact('versions'));
    }
}