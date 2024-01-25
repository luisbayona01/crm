<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Country;
use App\Models\Publicacion;


class UserController extends Controller{
    public function index(){
        $users = User::all();
        return view ('usuarios.index', compact('users'));
    }
    public function agentes(){
        $users = User::query();
        $paises = Country::all();
        $users = $users->orderBy('created_at', 'desc')->paginate(30);
        return view ('agentes.index', compact('users','paises'));
    }
    public function agentessearch(Request $request){
        $paises = Country::all();
        // BUSCADOR
        $query = $request->input('query');
        $name = $request->input('name');
        $pais = $request->input('pais');
        $email = $request->input('email');
        $intreassonumber = $request->input('intreassonumber');
        
        // Dividir los valores ingresados por el usuario en un arreglo
        $keywords = preg_split("/[\s,]+/", $query);
        $users = User::query();
        // Aplicar filtros para cada palabra clave
        foreach ($keywords as $keyword) {
            $users->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%$keyword%")
                    ->orWhere('pais', 'LIKE', "%$keyword%")
                    ->orWhere('telefono', 'LIKE', "%$keyword%")
                    ->orWhere('email', 'LIKE', "%$keyword%")
                    ->orWhere('intreassonumber', 'LIKE', "%$keyword%")
                    ->orWhere('updated_at', 'LIKE', "%$keyword%");
            });
        }
        // Agregar filtros adicionales si se proporcionaron
        $users = $users->when($name, function ($query, $name) {
            return $query->where('name', 'LIKE', "%$name%");
        })
        ->when($pais, function ($query, $pais) {
            return $query->where('pais', 'LIKE', "%$pais%");
        })
        ->when($email, function ($query, $email) {
            return $query->where('email', 'LIKE', "%$email%");
        })
        ->when($intreassonumber, function ($query, $intreassonumber) {
            return $query->where('intreassonumber', 'LIKE', "%$intreassonumber%");
        });
        // Ordenar por created_at en orden descendente
        $users = $users->orderBy('created_at', 'desc')->paginate(30);

        return view ('agentes.index', compact('users', 'paises', 'query'));
    }
    public function show(User $user){
        // Obtén las publicaciones asociadas al usuario actual
        $publicacions = Publicacion::where('userid', $user->id)->orderBy('created_at', 'desc')->take(30)->get();
        return view ('usuarios.show', compact('user','publicacions'));
    }
    public function edit(User $user){
        $paises = Country::all();
        $roles = Role::orderBy('id', 'desc')->get();
        return view('usuarios.edit', compact('user','paises','roles'));
    }
    public function update(Request $request, User $user){
        // FOTO DE PEFIL
        if($request->hasFile('urlfotoperfil')){
            // Eliminar la imagen Perfil anterior si se subió una nueva imagen
            if($user->urlfotoperfil && Storage::exists(str_replace('storage', 'public', $user->urlfotoperfil))){
                Storage::delete(str_replace('storage', 'public', $user->urlfotoperfil));
            }
            // Subir la imagen de perfil al servidor
            $ruta_imagen = $request->file('urlfotoperfil')->store('public/img/img-usuarios');
            $ruta_imagen = str_replace('public', 'storage', $ruta_imagen);
        } else {
            $ruta_imagen = $user->urlfotoperfil;
        }
        // FOTO DE PORTADA
        if($request->hasFile('urlfotoportada')){
            // Eliminar la imagen Perfil anterior si se subió una nueva imagen
            if($user->urlfotoportada && Storage::exists(str_replace('storage', 'public', $user->urlfotoportada))){
                Storage::delete(str_replace('storage', 'public', $user->urlfotoportada));
            }
            // Subir la imagen de perfil al servidor
            $ruta_imagen2 = $request->file('urlfotoportada')->store('public/img/img-usuarios');
            $ruta_imagen2 = str_replace('public', 'storage', $ruta_imagen2);
        } else {
            $ruta_imagen2 = $user->urlfotoportada;
        }
        // IDENTIFICACIÓN
        if($request->hasFile('urlidentificacion')){
            // Eliminar la imagen Perfil anterior si se subió una nueva imagen
            if($user->urlidentificacion && Storage::exists(str_replace('storage', 'public', $user->urlidentificacion))){
                Storage::delete(str_replace('storage', 'public', $user->urlidentificacion));
            }
            // Subir la imagen de perfil al servidor
            $ruta_imagen3 = $request->file('urlidentificacion')->store('public/img/img-usuarios');
            $ruta_imagen3 = str_replace('public', 'storage', $ruta_imagen3);
        } else {
            $ruta_imagen3 = $user->urlidentificacion;
        }
        //Actualizar usuario
        $user->update([
            'urlfotoperfil' => $ruta_imagen,
            'urlfotoportada' => $ruta_imagen2,
            'urlidentificacion' => $ruta_imagen3,
            'temaplantilla' => $request->temaplantilla,
            'name' => $request->name,
            'email' => $request->email,
            'intreassonumber' => $request->intreassonumber,
            'numeroidentificacion' => $request->numeroidentificacion,
            'estado' => $request->estado,
            'fechadenacimiento' => $request->fechadenacimiento,
            'descripcionperfil' => $request->descripcionperfil,
            'telefono' => $request->telefono,
            'pais' => $request->pais,
            'region' => $request->region,
            'ciudad' => $request->ciudad,
            'direccion' => $request->direccion,
            'referencia1' => $request->referencia1,
            'referencia2' => $request->referencia2,
            'urlfacebook' => $request->urlfacebook,
            'urlinstagram' => $request->urlinstagram,
            'otraredsocial' => $request->otraredsocial,
            'paginaweb' => $request->paginaweb,
        ]);
        $user->syncRoles($request->input('roles', [])); // Actualiza los roles del usuario
        return redirect()->back()->with('info', 'Contacto Actualizado');
    }
    public function destroy(User $user){
        // FOTO DE PERFIL
        if (Storage::exists(str_replace('storage', 'public', $user->urlfotoperfil))) {
            // Eliminar la imagen del almacenamiento
            Storage::delete(str_replace('storage', 'public', $user->urlfotoperfil));
        }
        // FOTO DE PORTADA
        if (Storage::exists(str_replace('storage', 'public', $user->urlfotoportada))) {
            // Eliminar la imagen del almacenamiento
            Storage::delete(str_replace('storage', 'public', $user->urlfotoportada));
        }
        // IDENTIFICACIÓN
        if (Storage::exists(str_replace('storage', 'public', $user->urlidentificacion))) {
            // Eliminar la imagen del almacenamiento
            Storage::delete(str_replace('storage', 'public', $user->urlidentificacion));
        }
        $user->delete();
        return redirect()->route('usuarios.index');
    }
}