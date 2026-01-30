<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsuariosImport;

class UsuarioExcelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new UsuariosImport, database_path('curso_web.xlsx'));
        //Excel::import(new UsuariosImport, request()->file('curso_web.xlsx')); // para importar desde un archivo que se sube desde el navegador
    }
}
