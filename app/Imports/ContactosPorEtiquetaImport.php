<?php

namespace App\Imports;

use App\Models\Contacto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use Illuminate\Support\Facades\Request;

class ContactosPorEtiquetaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
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

        $etiqueta = Request::input('etiqueta'); // Obtiene el valor de 'etiqueta' de la URL

        if (!is_null($etiqueta)) { // Verifica que 'etiqueta' no sea nulo
            DB::table('contacto_etiqueta')->insert([
                'contacto_id' => $contacto->id,
                'etiqueta_id' => $etiqueta, // Usa el valor de 'etiqueta' obtenido de la URL
            ]);
        }

        return $contacto;
    }
}

