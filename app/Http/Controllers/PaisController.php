<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;

/**
 * Class PaiController
 * @package App\Http\Controllers
 */
class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pais = Pais::paginate();
        return view('pais.index', compact('pais'))->with('i', (request()->input('page', 1) - 1) * $pais->perPage());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $pai = new Pais();
        return view('pais.create', compact('pai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //request()->validate(Pai::$rules);
        $pai = Pais::create($request->all());
        return redirect()->route('paises.index')->with('success', 'Pais created successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $pai = Pais::find($id);
        return view('pais.show', compact('pai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $pai = Pais::find($id);
        return view('pais.edit', compact('pai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Pais $pai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pais $pai,$id){
        //dd($request->all());
        //request()->validate(Pai::$rules);
        $pais=Pais::find($id);
        $pais->fill($request->all());
        $pais->save();
        return redirect()->route('paises.index')->with('success', 'Pais updated successfully');
    }
    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id){
        $pai = Pais::find($id)->delete();
        return redirect()->route('paises.index')->with('success', 'Pais deleted successfully');
    }
}
