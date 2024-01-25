<?php

namespace App\Imports;

use App\Models\Contacto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UsersImport implements ToModel, WithChunkReading
{
    public function model(array $row)
    {
        $name = !empty($row[0]) ? $row[0] : '.';
        $status = !empty($row[1]) ? $row[1] : 'CONTACTOSABC';
        $notes = !empty($row[2]) ? $row[2] : '.';
        $email = !empty($row[3]) ? $row[3] : 'sin@correo.com';
        $phone = !empty($row[4]) ? $row[4] : '+9901';
        

        return new Contacto([
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
    }

    public function chunkSize(): int
    {
        return 1000; // Ajusta el tamaño del bloque según tus necesidades
    }
}