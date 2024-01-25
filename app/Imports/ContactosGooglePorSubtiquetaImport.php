<?php

namespace App\Imports;

use App\Models\Contacto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use DB;
use Illuminate\Support\Facades\Request;

class ContactosGooglePorSubtiquetaImport   implements ToModel, WithChunkReading{
    public function model(array $row)
    {
        $name = !empty($row[0]) ? $row[0] : '.';
        $status = !empty($row[11]) ? $row[11] : 'CONTACTOSiv';
        $notes = !empty($row[25]) ? $row[25] : '.';
        $email = !empty($row[30]) ? $row[30] : 'sin@correo.com';
        $phone = !empty($row[34]) ? str_replace("'", "", $row[34]) : '+9901'; // Aquí se ha modificado el código para eliminar los apóstrofes

        $contacto = new Contacto([
            'userid' =>'.',
            'urlfotoperfil' => 'https://www.intreasso.org/wp-content/uploads/user-4.png',
            'urlidentificacion' => 'https://www.intreasso.org/wp-content/uploads/imagen-identificacion.png',
            'urlhojadevida' => '.',
            'nombre' => $name,
            'correo' => $email,
            'telefono' => $phone,
            'pais' => '.',
            'ciudad' => '.',
            'segurosocial' => '.',
            'profesion' => '.',
            'fechadecumpleanios' => '.',
            'status' => $status,
            'seguimiento' => '.',
            'referencia' => '.',
            'referenciafuente' => '.',
            'etiqueta' => '',
            'tipodeafiliacion' => '.',
            'fechadeafiliacionintreasso' => '.',
            'notasdeperfil' => '.',
            'notas' => $notes,
            'ndi' => '.',
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

    public function chunkSize(): int
    {
        return 1000; // Ajusta el tamaño del bloque según tus necesidades
    }
}
