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
use App\Models\Gruposfacebook;
use App\Models\Publicacion;
use Carbon\Carbon;
use DateTime;

class HomeController extends Controller{
    public function index(Request $request){
        $users = User::all();
        $paises = Country::all();
        $gruposfacebooks = Gruposfacebook::all();
        $publicacions = Publicacion::with('user')->orderBy('created_at', 'desc')->take(30)->get();
        $adminUserIds = User::role('admin')->pluck('id');
        $eventos = Evento::whereIn('userid', $adminUserIds)->where('fecha', '>', Carbon::now())->get();
        // Aplicar la búsqueda de texto si se proporciona un parámetro de búsqueda
        $query = $request->input('query');
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
        return view('home', compact('users', 'paises', 'eventos', 'gruposfacebooks', 'publicacions', 'query'));
    }
    public function search(Request $request){
        $users = User::all();
        $paises = Country::all();
        $gruposfacebooks = Gruposfacebook::all();
        $adminUserIds = User::role('admin')->pluck('id');
        $eventos = Evento::whereIn('userid', $adminUserIds)->where('fecha', '>', Carbon::now())->get();
        // Aplicar la búsqueda de texto si se proporciona un parámetro de búsqueda
        $query = $request->input('query');
        // BUSCADOR
        $query = $request->input('query');
        $descripcion = $request->input('descripcion');
        $pais = $request->input('pais');
        $precio = $request->input('precio');
        $comision = $request->input('comision');
        
        // Dividir los valores ingresados por el usuario en un arreglo
        $keywords = preg_split("/[\s,]+/", $query);
        $publicacions = Publicacion::query();
        // Aplicar filtros para cada palabra clave
        foreach ($keywords as $keyword) {
            $publicacions->where(function ($query) use ($keyword) {
                $query->where('descripcion', 'LIKE', "%$keyword%")
                    ->orWhere('pais', 'LIKE', "%$keyword%")
                    ->orWhere('precio', 'LIKE', "%$keyword%")
                    ->orWhere('comision', 'LIKE', "%$keyword%")
                    ->orWhere('updated_at', 'LIKE', "%$keyword%");
            });
        }
        // Agregar filtros adicionales si se proporcionaron
        $publicacions = $publicacions->when($descripcion, function ($query, $descripcion) {
            return $query->where('descripcion', 'LIKE', "%$descripcion%");
        })
        ->when($pais, function ($query, $pais) {
            return $query->where('pais', 'LIKE', "%$pais%");
        })
        ->when($precio, function ($query, $precio) {
            return $query->where('precio', 'LIKE', "%$precio%");
        })
        ->when($comision, function ($query, $comision) {
            return $query->where('comision', 'LIKE', "%$comision%");
        });
        // Ordenar por created_at en orden descendente
        $publicacions = $publicacions->orderBy('created_at', 'desc')->paginate(30);

        return view ('home', compact('users', 'paises', 'eventos', 'gruposfacebooks', 'publicacions', 'query'));
    }
    public function getContactosDuplicados(){
    $contactosDuplicados = Contacto::select('telefono', 'correo')
        ->groupBy('telefono', 'correo')
        ->havingRaw('COUNT(*) > 1')
        ->get();
        return $contactosDuplicados;
    }
}