<?php

namespace App\Http\Controllers;

use App\Models\Ciudades;
use App\Models\Pais;
use Illuminate\Http\Request;
use App\Models\Region;
use  DB;
/**
 * Class CiudadeController
 * @package App\Http\Controllers
 */
class CiudadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciudades = Ciudades::join('region as R', 'ciudades.region', '=', 'R.id')
            ->select('ciudades.id', 'ciudades.nombre', 'R.nombre as nameregion')
            ->paginate();


        return view('ciudades.index', compact('ciudades'))
            ->with('i', (request()->input('page', 1) - 1) * $ciudades->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciudade = new Ciudades();
        $listaDePaises = Pais::pluck('pais', 'id');
        $idpais='';
        $listaDeRegiones = [];

        return view('ciudades.create', compact('ciudade','listaDePaises','idpais','listaDeRegiones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //request()->validate(Ciudade::$rules);

        $ciudade = Ciudades::create($request->all());
           return redirect()->route('ciudades.index')
            ->with('success', 'Ciudad created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ciudade = Ciudades::find($id);

        return view('ciudades.show', compact('ciudade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ciudade = Ciudades::find($id);

        $paisregion = DB::table('region as R')
            ->select('R.pais', 'R.id')
            ->join('ciudades as C', 'C.region', '=', 'R.id')
            ->where('C.id', '=', $id)
            ->get();
        $idpais = $paisregion[0]->pais;
        //$idregion = $paisregion[0]->id;
        // dd( $paisregion);

        $listaDePaises = Pais::where('id', '=', $paisregion[0]->pais)->pluck('pais', 'id');

        $listaDeRegiones = Region::where('id', '=', $paisregion[0]->id)->pluck('nombre', 'id');

        return view('ciudades.edit', compact('ciudade','listaDePaises','idpais','listaDeRegiones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ciudades $ciudade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ciudades $ciudade)
    {
        //request()->validate(Ciudade::$rules);

        $ciudade->update($request->all());

        return redirect()->route('ciudades.index')
            ->with('success', 'Ciudade updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ciudade = Ciudades::find($id)->delete();

        return redirect()->route('ciudades.index')
            ->with('success', 'Ciudade deleted successfully');
    }
}
