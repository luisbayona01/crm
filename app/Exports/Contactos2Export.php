<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class Contactos2Export implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $etiqueta = request()->input('etiqueta');
        $subetiqueta = request()->input('subetiqueta'); // Nueva entrada para subetiqueta

        if ($subetiqueta) {
            $data = DB::table('contacto_subetiqueta') // Cambia a la tabla 'contacto_subetiqueta'
                ->join('contactos', 'contactos.id', '=', 'contacto_subetiqueta.contacto_id')
                ->select('contactos.nombre', 'contactos.status', 'contactos.pais', 'contactos.notas', 'contactos.correo', 'contactos.telefono')
                ->where('contacto_subetiqueta.subetiqueta_id', $subetiqueta) // Consulta por subetiqueta
                ->orderBy('contactos.nombre')
                ->get();
        } else {
            $data = DB::table('contacto_etiqueta')
                ->join('contactos', 'contactos.id', '=', 'contacto_etiqueta.contacto_id')
                ->select('contactos.nombre', 'contactos.status', 'contactos.pais', 'contactos.notas', 'contactos.correo', 'contactos.telefono')
                ->where('contacto_etiqueta.etiqueta_id', $etiqueta)
                ->orderBy('contactos.nombre')
                ->get();
        }

        $data = $data->map(function ($row) {
            $row = (array)$row;
            $row['telefono'] = "'" . $row['telefono'];
            $newRow = array_fill(0, 34, null);
            $newRow[2] = $row['nombre'];
            $newRow[10] = $row['status'];
            $newRow[5] = $row['pais'];
            $newRow[13] = $row['notas'];
            $newRow[3] = $row['correo'];
            $newRow[4] = $row['telefono'];
            return $newRow;
        })->toArray();

        array_unshift($data, array( 'urlfotoperfil', 'urlidentificacion', 'nombre', 'correo', 'telefono', 'pais', 'ciudad', 'segurosocial', 'profesion', 'fechadecumpleanios', 'status', 'referencia', 'etiqueta', 'notas', 'created_at', 'updated_at', 'ndi', 'tipodeafiliacion', 'notasdeperfil', 'fechadeafiliacionintreasso', 'urlhojadevida', 'evento', 'referenciafuente', 'seguimiento', 'userid'));

        return collect($data);
    }
}
