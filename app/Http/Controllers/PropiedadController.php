<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Categoria;
use App\Models\Ciudades;
use App\Models\Pais;
use App\Models\Propiedad;
use App\Models\Region;
use DB;

/**
 * Class PropiedadController
 * @package App\Http\Controllers
 */
class PropiedadController extends Controller{
    public function index(Request $request){
        $query = DB::table('propiedad as P')
            ->join('ciudades as C', 'C.id', '=', 'P.ciudad')
            ->join('region as R', 'R.id', '=', 'C.region')
            ->join('pais as Pa', 'Pa.id', '=', 'R.pais')
            ->join('categorias as Ca', 'Ca.id', '=', 'P.categoria_id');

        // Añadir condiciones según los parámetros enviados
        if ($request->filled('pais_id')) {
            $query->where('Pa.id', $request->input('pais_id'));
        }

        if ($request->filled('region_id')) {
            $query->where('R.id', $request->input('region_id'));
        }

        if ($request->filled('categoria_id')) {
            $query->where('Ca.id', $request->input('categoria_id'));
        }

        if ($request->filled('precio')) {
            $query->where('P.precio', 'like', '%' . $request->input('precio') . '%');
        }

        if ($request->filled('precio-titulo')) {
            $query->orWhere('P.titulo', 'like', '%' . $request->input('precio-titulo') . '%')
                ->orWhere('P.precio', 'like', '%' . $request->input('precio-titulo') . '%');

        }

        if ($request->filled('estado')) {
            $query->where('P.estado', $request->input('estado'));
        }

        $propiedad = $query->select('P.id', 'P.titulo', 'P.precio', 'P.estado', 'P.galeriaImagenes')->paginate();

        //dd($propiedad);

        $listaDePaises = Pais::pluck('pais', 'id');
        $categorias = Categoria::pluck('categoria', 'id');
        $regioneslist= Region::Pluck('nombre','id');
        $opcionesEstado = [
            'Venta' => 'Venta',
            'Renta' => 'Renta',
        ];
        return view('propiedad.index', compact('propiedad', 'listaDePaises', 'opcionesEstado', 'categorias','regioneslist'))->with('i', (request()->input('page', 1) - 1) * $propiedad->perPage());
    }
    public function create(){
        $propiedad = new Propiedad();
        $listaDePaises = Pais::pluck('pais', 'id');
        $listaDeRegiones = [];
        $listaDeCiudades = [];
        $idpais = '';
        $idregion = '';
        $categorias = Categoria::pluck('categoria', 'id');
        $opcionesEstado = [
            'venta' => 'venta',
            'alquiler' => 'alquiler',
        ];
        return view('propiedad.create', compact('propiedad', 'categorias', 'listaDePaises', 'listaDeRegiones', 'listaDeCiudades', 'idpais', 'idregion', 'opcionesEstado'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // IMAGEN
        // if ($request->hasFile('urlimagen')) {
        //     // Subir la imagen de perfil al servidor
        //     $ruta_imagen = $request->file('urlimagen')->store('public/img/img-propiedades');
        //     $ruta_imagen = str_replace('public', 'storage', $ruta_imagen);
        // } else {
        //     $ruta_imagen = asset('img/propiedad-preview.png');
        // }
        $data = $request->all();
        unset($data['pais_id']);
        unset($data['region_id']);

        // Manejar la carga de la imagen
        if ($request->hasFile('galeriaImagenes')) {
            $imagen = $request->file('galeriaImagenes');
           $nombreImagen = Str::slug($imagen->getClientOriginalName(), '_');
           //dd($nombreImagen);
            // Guardar la imagen en la carpeta "public/galeria"
            $imagen->storeAs('galeria', $nombreImagen, 'public');

            // Almacenar la ruta completa en la base de datos
            $data['galeriaImagenes'] = 'galeria/' . $nombreImagen;
        }
        //dd($data);
        // Crear la propiedad con los datos actualizados
        $propiedad = Propiedad::create($data);
        //dd($propiedad);
        return redirect()->route('propiedades.index')
            ->with('success', 'Propiedad created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $properties = DB::table('propiedad as Pr')
            ->join('ciudades as C', 'Pr.ciudad', '=', 'C.id')
            ->join('region as rg', 'rg.id', '=', 'C.region')
            ->join('pais as pa', 'rg.pais', '=', 'pa.id')
            ->where('Pr.id', '=', $id)
            ->select('Pr.*', 'C.nombre as nameciudad', 'rg.nombre as nombreregion', 'pa.pais as namepais')
            ->get();

//dd($properties);
        $propiedad = $properties[0];
        $adrressC = $propiedad->direccion . ',' . $propiedad->nameciudad . ',' . $propiedad->namepais;
//dd($adrressC);
        return view('propiedad.show', compact('propiedad', 'adrressC'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {$propiedad = Propiedad::find($id);
        //dd($propiedad->ciudad);
        $listaDeCiudades = Ciudades::where('id', '=', $propiedad->ciudad)->pluck('nombre', 'id');
        $paisregion = DB::table('region as R')
            ->select('R.pais', 'R.id')
            ->join('ciudades as C', 'C.region', '=', 'R.id')
            ->where('C.id', '=', $propiedad->ciudad)
            ->get();
        $idpais = $paisregion[0]->pais;
        $idregion = $paisregion[0]->id;
        // dd( $paisregion);
        $opcionesEstado = [
            'Venta' => 'Venta',
            'Renta' => 'Renta',
        ];
        $listaDePaises = Pais::where('id', '=', $paisregion[0]->pais)->pluck('pais', 'id');

        $listaDeRegiones = Region::where('id', '=', $paisregion[0]->id)->pluck('nombre', 'id');

        $categorias = Categoria::pluck('categoria', 'id');
        //$idpropiedad=$id;
        return view('propiedad.edit', compact('propiedad', 'categorias', 'listaDePaises', 'listaDeRegiones', 'listaDeCiudades', 'idpais', 'idregion', 'opcionesEstado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Propiedad $propiedades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Propiedad $propiedad, $id){ 
        //dd($id);
        //request()->validate(Propiedad::$rules);

        $data = $request->all();
        //dd($propiedad->id);
        unset($data['pais_id']);
        unset($data['region_id']);
//$id=$request->id;
        // Manejar la carga de la imagen
        if ($request->hasFile('galeriaImagenes')) {
            $imagen = $request->file('galeriaImagenes');
             $nombreImagen = Str::slug($imagen->getClientOriginalName(), '_');
//dd($imagen);
            // Guardar la imagen en la carpeta "public/galeria"
            $imagen->storeAs('galeria', $nombreImagen, 'public');

            // Almacenar la ruta completa en la base de datos
            $data['galeriaImagenes'] = 'galeria/' . $nombreImagen;
        }
        $propiedad = Propiedad::find($id);

        $propiedad->fill($data);

        // Guarda los cambios en la base de datos
        $propiedad->save();
        //var_dump()
        return redirect()->route('propiedades.index')
            ->with('success', 'Propiedad updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id){
        $propiedad = Propiedad::find($id)->delete();
        return redirect()->route('propiedades.index')->with('success', 'Propiedad deleted successfully');
    }
    public function obtenerRegiones($pais_id){
        $regiones = Region::where('pais', $pais_id)->pluck('nombre', 'id');
        return response()->json($regiones);
    }
    public function obtenerCiudades($regionId){
        $ciudades = Ciudades::where('region', $regionId)->pluck('nombre', 'id');
        return response()->json($ciudades);
    }

}
