<?php

namespace App\Imports;

use App\Models\Contacto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use Illuminate\Support\Facades\Request;

class ContactosPorSubetiquetaImport implements ToModel, WithHeadingRow
{
   
     public function model(array $row)
    {
        $contacto = new Contacto([
            
            'urlfotoperfil' => ' ',
            'urlidentificacion' => ' ',
            'nombre' => $row['nombre'],
            'correo' => $row['correo'],
            'telefono' => $row['telefono']= str_replace("'", "", $row['telefono']),
            'pais' => $row['pais'],
            'ciudad' => ' ',
            'segurosocial' => ' ',
            'profesion' => ' ',
            'fechadecumpleanios' => ' ',
            'status' => $row['status'],
            'referencia' => ' ',
            'etiqueta' => ' ',
            'notas' => $row['notas'],
            'created_at' => '.',
            'updated_at' => '.',
            'ndi' => ' ',
            'tipodeafiliacion' => ' ',
            'notasdeperfil' => ' ',
            'fechadeafiliacionintreasso' => ' ',
            'urlhojadevida' => ' ',
            'evento' => ' ',
            'referenciafuente' => ' ',
            'seguimiento' => ' ',
            'userid' => ' ',
        ]);

        $contacto->save();

        $subetiqueta = Request::input('subetiqueta'); // Obtiene el valor de 'etiqueta' de la URL

        if (!is_null($subetiqueta)) { // Verifica que 'etiqueta' no sea nulo
            DB::table('contacto_subetiqueta')->insert([
                'contacto_id' => $contacto->id,
                'subetiqueta_id' => $subetiqueta, // Usa el valor de 'etiqueta' obtenido de la URL
            ]);
        }

        return $contacto;
    }
}