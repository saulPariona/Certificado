<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\User;
use Illuminate\Support\Facades\DB; // la transaccion es para que si algo falla se deshaga todo lo que se hizo
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsuariosImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     */
    public function model(array $row)
    {
        DB::transaction(function () use ($row) {
            User::create([
                'dni' => $row['dni'],
                'paternal_surname' => $row['paternal_surname'],
                'maternal_surname' => $row['maternal_surname'],
                'name' => $row['nombres'],
                'email' => $row['dni'] . '@fis.edu',
                'password' => bcrypt('secreto'),
            ]);
        });
    }
}
