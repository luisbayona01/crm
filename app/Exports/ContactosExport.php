<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContactosExport implements FromCollection
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
            $newRow[0] = $row['nombre'];
            $newRow[11] = $row['status'];
            $newRow[16] = $row['pais'];
            $newRow[25] = $row['notas'];
            $newRow[30] = $row['correo'];
            $newRow[34] = $row['telefono'];
            return $newRow;
        })->toArray();

        array_unshift($data, array('Name', 'Given Name', 'Additional Name', 'Family Name', 'Yomi Name', 'Given Name Yomi', 'Additional Name Yomi', 'Family Name Yomi', 'Name Prefix', 'Name Suffix', 'Initials', 'Nickname', 'Short Name', 'Maiden Name', 'Birthday', 'Gender', 'Location', 'Billing Information', 'Directory Server', 'Mileage', 'Occupation', 'Hobby', 'Sensitivity', 'Priority', 'Subject', 'Notes', 'Language', 'Photo', 'Group Membership', 'E-mail 1 - Type', 'E-mail 1 - Value', 'E-mail 2 - Type', 'E-mail 2 - Value', 'Phone 1 - Type', 'Phone 1 - Value', 'Phone 2 - Type', 'Phone 2 - Value', 'Organization 1 - Type', 'Organization 1 - Name', 'Organization 1 - Yomi Name', 'Organization 1 - Title', 'Organization 1 - Department', 'Organization 1 - Symbol', 'Organization 1 - Location', 'Organization 1 - Job Description'));

        return collect($data);
    }
    
}
