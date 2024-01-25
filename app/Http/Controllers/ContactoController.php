<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Asesora;
use App\Models\Contacto;
use App\Models\Country;
use App\Models\Etiqueta;
use App\Models\Subetiqueta;
use App\Models\Evento;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Imports\ContactosImport;
use App\Imports\ContactosPorEtiquetaImport;
use App\Imports\ContactosPorSubetiquetaImport;
use App\Imports\ContactosGooglePorEtiquetaImport;
use App\Imports\ContactosGooglePorSubtiquetaImport;
use App\Exports\ContactosExport;
use App\Exports\Contactos2Export;
use DateTime;

class ContactoController extends Controller{
    public function index(Request $request){
        $users = User::all();
        $asesoras = Asesora::all();
        $query = $request->input('query');
        // Obtener todos los contactos por defecto
        $contactos = Contacto::query();
        $numContactos = Contacto::count();
        // Filtrar los contactos que cumplen años en el día actual
        $contactoscumpleanios = Contacto::query()->whereRaw("SUBSTR(fechadecumpleanios, 1, 5) = SUBSTR('" . date('d-m') . "', 1, 5)");
        // Filtrar los contactos que cumplen años mañana
        // Crear un objeto DateTime con la fecha de hoy
        $hoy = new DateTime();
        $maniana = clone $hoy;
        $maniana->modify('+1 day');
        $diezdias = clone $hoy;
        $diezdias->modify('+10 day');
        // Convertir la fecha en formato 'd-m' y usarla en la consulta
        $maniana_str = $maniana->format('d-m');
        $diezdias_str = $diezdias->format('d-m');
        // Filtrar con la fecha de mañana
        $contactoscumpleaniosmaniana = Contacto::query()->whereRaw("SUBSTR(fechadecumpleanios, 1, 5) = SUBSTR('" . $maniana_str . "', 1, 5)");
        // Filtrar los Afiliados que se le vencen la Membresía en el día actual
        $vencemembresiahoy = Contacto::query()->whereRaw("SUBSTR(fechadeafiliacionintreasso, 1, 5) = SUBSTR('" . date('d-m') . "', 1, 5)");
        // Filtrar con la fecha de 10 días
        $vencemembresia10dias = Contacto::query()->whereRaw("SUBSTR(fechadeafiliacionintreasso, 1, 5) = SUBSTR('" . $diezdias_str . "', 1, 5)");


    
        // Filtrar los contactos por etiqueta si se proporciona un parámetro de etiqueta
        if ($request->filled('etiqueta')) {
            $etiqueta = Etiqueta::findOrFail($request->input('etiqueta'));
            $contactos = $etiqueta->contactos()->getQuery();
        }
        // Filtrar los contactos por subetiqueta si se proporciona un parámetro de subetiqueta
        if ($request->filled('subetiqueta')) {
            $subetiqueta = Subetiqueta::findOrFail($request->input('subetiqueta'));
            $contactos = $subetiqueta->contactos()->getQuery();
        }
        // Filtrar los contactos por etiqueta si se proporciona un parámetro de etiqueta
        if ($request->filled('evento')) {
            $evento = Evento::findOrFail($request->input('evento'));
            $contactos = $evento->contactos()->getQuery();
        }
        // Aplicar la búsqueda de texto si se proporciona un parámetro de búsqueda
        if ($query) {
            $contactos = $contactos->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('nombre', 'LIKE', "%$query%")
                    ->orWhere('correo', 'LIKE', "%$query%")
                    ->orWhere('pais', 'LIKE', "%$query%")
                    ->orWhere('telefono', 'LIKE', "%$query%")
                    ->orWhere('status', 'LIKE', "%$query%")
                    ->orWhere('notas', 'LIKE', "%$query%")
                    ->orWhere('referencia', 'LIKE', "%$query%")
                    ->orWhere('updated_at', 'LIKE', "%$query%")
                    ->orWhere('tipodeafiliacion', 'LIKE', "%$query%")
                    ->orWhereHas('etiquetas', function ($q) use ($query) {
                        $q->where('nombre', 'LIKE', "%$query%");
                    });
            });
        }
        //CUMPLEAÑOS
        $contactoscumpleanios = $contactoscumpleanios->orderByDesc('id')->paginate(100);
        $contactoscumpleaniosmaniana = $contactoscumpleaniosmaniana->orderByDesc('id')->paginate(100);
        //MEMBRESIA A VENCER
        $vencemembresiahoy = $vencemembresiahoy->orderByDesc('id')->paginate(100);
        $vencemembresia10dias = $vencemembresia10dias->orderByDesc('id')->paginate(100);
        //CONTACTOS
        $contactos = $contactos->orderByDesc('id')->paginate(100);
        $contactosDuplicados = $this->getContactosDuplicados();
        return view('contactos.index', compact('users', 'asesoras', 'contactos', 'query', 'numContactos', 'contactoscumpleanios', 'contactoscumpleaniosmaniana', 'contactosDuplicados', 'vencemembresiahoy', 'vencemembresia10dias'));
    }
    public function search(Request $request){
        $users = User::all();
        $asesoras = Asesora::all();
        $numContactos = Contacto::count();
        // Filtrar los contactos que cumplen años en el día actual
        $contactoscumpleanios = Contacto::query()->whereRaw("SUBSTR(fechadecumpleanios, 1, 5) = SUBSTR('" . date('d-m') . "', 1, 5)");
        // Filtrar los contactos que cumplen años mañana
        // Crear un objeto DateTime con la fecha de hoy
        $hoy = new DateTime();
        $maniana = clone $hoy;
        $maniana->modify('+1 day');
        $diezdias = clone $hoy;
        $diezdias->modify('+10 day');
        // Convertir la fecha en formato 'd-m' y usarla en la consulta
        $maniana_str = $maniana->format('d-m');
        $diezdias_str = $diezdias->format('d-m');
        // Filtrar con la fecha de mañana
        $contactoscumpleaniosmaniana = Contacto::query()->whereRaw("SUBSTR(fechadecumpleanios, 1, 5) = SUBSTR('" . $maniana_str . "', 1, 5)");
        // Filtrar los Afiliados que se le vencen la Membresía en el día actual
        $vencemembresiahoy = Contacto::query()->whereRaw("SUBSTR(fechadeafiliacionintreasso, 1, 5) = SUBSTR('" . date('d-m') . "', 1, 5)");
        // Filtrar con la fecha de 10 días
        $vencemembresia10dias = Contacto::query()->whereRaw("SUBSTR(fechadeafiliacionintreasso, 1, 5) = SUBSTR('" . $diezdias_str . "', 1, 5)");
        // BUSCADOR
        $query = $request->input('query');
        $nombre = $request->input('nombre');
        $pais = $request->input('pais');
        $status = $request->input('status');
        $seguimiento = $request->input('seguimiento');
        $referencia = $request->input('referencia');
        $referenciafuente = $request->input('referenciafuente');
        
        // Dividir los valores ingresados por el usuario en un arreglo
        $keywords = preg_split("/[\s,]+/", $query);
        $contactos = Contacto::query();
        // Aplicar filtros para cada palabra clave
        foreach ($keywords as $keyword) {
            $contactos->where(function ($query) use ($keyword) {
                $query->where('nombre', 'LIKE', "%$keyword%")
                    ->orWhere('correo', 'LIKE', "%$keyword%")
                    ->orWhere('pais', 'LIKE', "%$keyword%")
                    ->orWhere('telefono', 'LIKE', "%$keyword%")
                    ->orWhere('status', 'LIKE', "%$keyword%")
                    ->orWhere('seguimiento', 'LIKE', "%$keyword%")
                    ->orWhere('notas', 'LIKE', "%$keyword%")
                    ->orWhere('referencia', 'LIKE', "%$keyword%")
                    ->orWhere('referenciafuente', 'LIKE', "%$keyword%")
                    ->orWhere('updated_at', 'LIKE', "%$keyword%")
                    ->orWhereHas('etiquetas', function ($q) use ($keyword) {
                        $q->where('nombre', 'LIKE', "%$keyword%");
                    });
            });
        }
        // Agregar filtros adicionales si se proporcionaron
        $contactos = $contactos->when($nombre, function ($query, $nombre) {
            return $query->where('nombre', 'LIKE', "%$nombre%");
        })
        ->when($pais, function ($query, $pais) {
            return $query->where('pais', 'LIKE', "%$pais%");
        })
        ->when($status, function ($query, $status) {
            return $query->where('status', 'LIKE', "%$status%");
        })
        ->when($seguimiento, function ($query, $seguimiento) {
            return $query->where('seguimiento', 'LIKE', "%$seguimiento%");
        })
        ->when($referencia, function ($query, $referencia) {
            return $query->where('referencia', 'LIKE', "%$referencia%");
        })
        ->when($referenciafuente, function ($query, $referenciafuente) {
            return $query->where('referenciafuente', 'LIKE', "%$referenciafuente%");
        });
        $contactos = $contactos->paginate(100);

        //CUMPLEAÑOS
        $contactoscumpleanios = $contactoscumpleanios->orderByDesc('id')->paginate(100);
        $contactoscumpleaniosmaniana = $contactoscumpleaniosmaniana->orderByDesc('id')->paginate(100);
        //MEMBRESIA A VENCER
        $vencemembresiahoy = $vencemembresiahoy->orderByDesc('id')->paginate(100);
        $vencemembresia10dias = $vencemembresia10dias->orderByDesc('id')->paginate(100);
        //CONTACTOS
        $contactosDuplicados = $this->getContactosDuplicados();
        return view ('contactos.index', compact('users', 'asesoras', 'contactos', 'query', 'numContactos', 'contactoscumpleanios', 'contactoscumpleaniosmaniana', 'contactosDuplicados', 'vencemembresiahoy', 'vencemembresia10dias'));
    }
    public function show(Contacto $contacto){
        return view ('contactos.show', compact('contacto'));
    }
    public function create(){
        $etiquetas = Etiqueta::pluck('nombre', 'id');
        $subetiquetas = Subetiqueta::all();
        $paises = Country::all();
        // EVENTOS
        if(Auth::user()->hasRole('admin')){
            $eventos = Evento::pluck('nombre', 'id');
        }else{
            $eventos = Evento::where('userid', Auth::user()->id)->pluck('nombre', 'id');
        }
        // USUARIOS
        $users = User::all();
        return view('contactos.create', compact('etiquetas','subetiquetas', 'paises', 'eventos', 'users'));
    }
    public function store(Request $request){
        // Verifica si el campo "evento" está vacío
        if (empty($request->input('evento'))) {
            // Elimina completamente el campo "evento" de la solicitud
            $request->request->remove('evento');
        }
        // FOTO DE PEFIL
        if ($request->hasFile('urlfotoperfil')) {
            // Subir la imagen de perfil al servidor
            $ruta_imagen = $request->file('urlfotoperfil')->store('public/img/img-contactos');
            $ruta_imagen = str_replace('public', 'storage', $ruta_imagen);
        } else {
            $ruta_imagen = asset('img/foto-preview.png');
        }
        // IDENTIFICACIÓN
        if ($request->hasFile('urlidentificacion')) {
            // Subir la imagen de perfil al servidor
            $ruta_imagen2 = $request->file('urlidentificacion')->store('public/img/img-contactos');
            $ruta_imagen2 = str_replace('public', 'storage', $ruta_imagen2);
        } else {
            $ruta_imagen2 = asset('img/imagen-identificacion.png');
        }
        // HOJA DE VIDA
        $ruta_hojadevida = ''; // Define la variable con un valor predeterminado vacío
        if ($request->hasFile('urlhojadevida')) {
            // Subir el documento de perfil al servidor
            $ruta_hojadevida = $request->file('urlhojadevida')->store('public/documentos/documentos-contactos');
            $ruta_hojadevida = str_replace('public', 'storage', $ruta_hojadevida);
        }
        $etiquetas = $request->etiqueta;
        $subetiquetas = $request->subetiqueta;
        $eventos = $request->evento;
        $contacto = Contacto::create([
            'userid' => $request->userid,
            'urlfotoperfil' => $ruta_imagen,
            'urlidentificacion' => $ruta_imagen2,
            'urlhojadevida' => $ruta_hojadevida,
            'ndi' => $request->ndi,
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => implode($request->telefono),
            'pais' => $request->pais,
            'ciudad' => $request->ciudad,
            'segurosocial' => $request->segurosocial,
            'profesion' => $request->profesion,
            'fechadecumpleanios' => $request->fechadecumpleanios,
            'status' => $request->status,
            'seguimiento' => $request->seguimiento,
            'referencia' => $request->referencia,
            'referenciafuente' => $request->referenciafuente,
            'tipodeafiliacion' => $request->tipodeafiliacion,
            'fechadeafiliacionintreasso' => $request->fechadeafiliacionintreasso,
            'notasdeperfil' => $request->notasdeperfil,
            'notas' => $request->notas,
        ]);
    
        // Asociar las etiquetas al contacto
        $contacto->etiquetas()->sync($request->etiqueta);
        // Asociar las subetiquetas al contacto
        $contacto->subetiquetas()->attach($subetiquetas);
        // Asociar los eventos al contacto
        $contacto->eventos()->sync($request->evento);

        return redirect()->route('home');
    }
    public function edit(Contacto $contacto){
        // ETIQUETAS
        $etiquetasSeleccionadas = $contacto->etiquetas()->pluck('id')->toArray();
        $subetiquetasSeleccionadas = $contacto->subetiquetas()->whereHas('etiqueta', function ($query) use ($etiquetasSeleccionadas) {
            $query->whereIn('id', $etiquetasSeleccionadas);
        })->pluck('id')->toArray();
        $etiquetas = Etiqueta::pluck('nombre', 'id');
        $subetiquetas = [];
        foreach ($contacto->subetiquetas as $subetiqueta) {
            $subetiquetas[$subetiqueta->id] = $subetiqueta->nombre;
        }
        $paises = Country::all();
        // EVENTOS
        $eventosSeleccionados = $contacto->eventos()->pluck('id')->toArray();
        if(Auth::user()->hasRole('admin')){
            $eventos = Evento::pluck('nombre', 'id');
        }else{
            $eventos = Evento::where('userid', Auth::user()->id)->pluck('nombre', 'id');
        }
        // USUARIOS
        $users = User::orderBy('name', 'asc')->get();
        return view('contactos.edit', compact('contacto', 'etiquetas', 'etiquetasSeleccionadas', 'subetiquetas', 'subetiquetasSeleccionadas', 'paises', 'eventos', 'eventosSeleccionados', 'users'));
    }
    public function update(Request $request, Contacto $contacto){
        // FOTO DE PEFIL
        if($request->hasFile('urlfotoperfil')){
            // Eliminar la imagen Perfil anterior si se subió una nueva imagen
            if($contacto->urlfotoperfil && Storage::exists(str_replace('storage', 'public', $contacto->urlfotoperfil))){
                Storage::delete(str_replace('storage', 'public', $contacto->urlfotoperfil));
            }
            // Subir la imagen de perfil al servidor
            $ruta_imagen = $request->file('urlfotoperfil')->store('public/img/img-contactos');
            $ruta_imagen = str_replace('public', 'storage', $ruta_imagen);
        } else {
            $ruta_imagen = $contacto->urlfotoperfil;
        }
        // IDENTIFICAICÓN
        if($request->hasFile('urlidentificacion')){
            // Eliminar la imagen Identificación anterior si se subió una nueva imagen
            if($contacto->urlidentificacion && Storage::exists(str_replace('storage', 'public', $contacto->urlidentificacion))){
                Storage::delete(str_replace('storage', 'public', $contacto->urlidentificacion));
            }
            // Subir la imagen de identificación al servidor
            $ruta_imagen2 = $request->file('urlidentificacion')->store('public/img/img-contactos');
            $ruta_imagen2 = str_replace('public', 'storage', $ruta_imagen2);
        } else {
            $ruta_imagen2 = $contacto->urlidentificacion;
        }
        // HOJA DE VIDA
        if($request->hasFile('urlhojadevida')){
            // Eliminar el documento Hoja de vida anterior si se subió un nuevo documento
            if($contacto->urlhojadevida && Storage::exists(str_replace('storage', 'public', $contacto->urlhojadevida))){
                Storage::delete(str_replace('storage', 'public', $contacto->urlhojadevida));
            }
            // Subir documento de hoja de vida al servidor
            $ruta_hojadevida = $request->file('urlhojadevida')->store('public/documentos/documentos-contactos');
            $ruta_hojadevida = str_replace('public', 'storage', $ruta_hojadevida);
        } else {
            $ruta_hojadevida = $contacto->urlhojadevida;
        }

        // Actualizar etiquetas
        $contacto->etiquetas()->sync($request->input('etiqueta', []));
        // Actualizar subetiquetas
        $contacto->subetiquetas()->sync($request->input('subetiqueta', []));
        // Actualizar eventos
        $contacto->eventos()->sync($request->input('evento', []));
        
        //Actualizar contacto
        $contacto->update([
            'userid' => $request->userid,
            'urlfotoperfil' => $ruta_imagen,
            'urlidentificacion' => $ruta_imagen2,
            'urlhojadevida' => $ruta_hojadevida,
            'ndi' => $request->ndi,
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'pais' => $request->pais,
            'ciudad' => $request->ciudad,
            'segurosocial' => $request->segurosocial,
            'profesion' => $request->profesion,
            'fechadecumpleanios' => $request->fechadecumpleanios,
            'status' => $request->status,
            'seguimiento' => $request->seguimiento,
            'referencia' => $request->referencia,
            'referenciafuente' => $request->referenciafuente,
            'etiqueta' => $request->etiqueta,
            'evento' => 'Sin Evento',
            'tipodeafiliacion' => $request->tipodeafiliacion,
            'fechadeafiliacionintreasso' => $request->fechadeafiliacionintreasso,
            'notasdeperfil' => $request->notasdeperfil,
            'notas' => $request->notas,
        ]);

        return redirect()->back()->with('info', 'Contacto Actualizado');    
    }
    public function destroy(Contacto $contacto){
        // Eliminar las etiquetas asociadas al contacto
        $contacto->etiquetas()->detach();
        // Eliminar las subetiquetas asociadas al contacto
        $contacto->subetiquetas()->detach();
        // Eliminar las eventos asociadas al contacto
        $contacto->eventos()->detach();
    
        // Verificar si la imagen asociada al contacto existe en el almacenamiento
        if (Storage::exists(str_replace('storage', 'public', $contacto->urlfotoperfil))) {
            // Eliminar la imagen del almacenamiento
            Storage::delete(str_replace('storage', 'public', $contacto->urlfotoperfil));
        }
        if (Storage::exists(str_replace('storage', 'public', $contacto->urlidentificacion))) {
            // Eliminar la imagen del almacenamiento
            Storage::delete(str_replace('storage', 'public', $contacto->urlidentificacion));
        }
        if (Storage::exists(str_replace('storage', 'public', $contacto->urlhojadevida))) {
            // Eliminar la doumento del almacenamiento
            Storage::delete(str_replace('storage', 'public', $contacto->urlhojadevida));
        }
    
        $contacto->delete();
        return redirect()->route('home');
    }
    public function getContactosDuplicados(){
        $contactosDuplicados = Contacto::select('telefono', 'correo')
            ->groupBy('telefono', 'correo')
            ->havingRaw('COUNT(*) > 1')
            ->get();
    
        return $contactosDuplicados;
    }
    public function importar(){
        return view ('contactos.importar');
    }
    public function importExcel(Request $request){
        $file = $request->file('file');
        Excel::import(new ContactosImport, $file);
        return back();
    }
    // funcion exportar en formato de contactos de google
    public function exportAllContactos(){
        return Excel::download(new ContactosExport, 'contactos.csv', \Maatwebsite\Excel\Excel::CSV);
    }
    //funcion exporta tal y cual como esta la tabla de la base de datos
    public function exportAllContactos2(){
        return Excel::download(new Contactos2Export, 'contactos.csv', \Maatwebsite\Excel\Excel::CSV);
    }
    // funcion importar contacto por etiqueta
    public function import1Excel(Request $request){
        Excel::import(new ContactosPorEtiquetaImport, $request->file('tu_archivo_excel'));
        return redirect()->route('etiquetas.index')->with('success', 'Contactos importados con éxito.');
    }
    //funcion importar contacto por subetiqueta
    public function import2Excel(Request $request){
        Excel::import(new ContactosPorSubetiquetaImport, $request->file('tu_archivo_excel'));   
        return redirect()->route('etiquetas.index')->with('success', 'Contactos importados con éxito.');
    }
    //funcion importar contacto de google por etiqueta
    public function import3Excel(Request $request){
        Excel::import(new ContactosGooglePorEtiquetaImport, $request->file('tu_archivo_excel')); 
        return redirect()->route('etiquetas.index')->with('success', 'Contactos importados con éxito.');
    }
    public function import4Excel(Request $request){
        Excel::import(new ContactosGooglePorSubtiquetaImport, $request->file('tu_archivo_excel'));
        return redirect()->route('etiquetas.index')->with('success', 'Contactos importados con éxito.');
    }
    public function index1(){
        $contactos =  Contacto::all();
        return view ('contactos.prueba', compact('contactos'));
    }
    public function prueba(){
        $contactos =  Contacto::all();
        return view ('contactos.prueba', compact('contactos'));
    }
}