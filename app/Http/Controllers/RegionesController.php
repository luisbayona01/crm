<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Pais;

/**
 * Class RegionController
 * @package App\Http\Controllers
 */
class RegionesController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $regions =  Region::join('pais as P', 'region.pais', '=', 'P.id')->select('region.id', 'region.nombre', 'P.pais  as nombre_pais')->paginate();
        //dd($regiones->pai()->id);
        return view('regiones.index', compact('regions'))->with('i', (request()->input('page', 1) - 1) * $regions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $region = new Region();
        $listaDePaises = Pais::pluck('pais', 'id');
        return view('regiones.create', compact('region','listaDePaises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //request()->validate(Region::$rules);
        $region = Region::create($request->all());
        return redirect()->route('regiones.index')->with('success', 'Region created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $region = Region::find($id);
        return view('regiones.show', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $region = Region::find($id);
         $listaDePaises = Pais::pluck('pais', 'id');
        return view('regiones.edit', compact('region','listaDePaises'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Region $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region,$id){
        //request()->validate(Region::$rules);
        $region=Region::find($id);
        $region->fill($request->all());
        $region->save();
        return redirect()->route('regiones.index')->with('success', 'Region updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id){
        $region = Region::find($id)->delete();
        return redirect()->route('regiones.index')->with('success', 'Region deleted successfully');
    }
}