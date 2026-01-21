<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tipo;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tipo::create([
            'tipo' => 'PreRegistrado',
        ]);
        Tipo::create([
            'tipo' => 'Asistente',
        ]);
        Tipo::create([
            'tipo' => 'Ponente',
        ]);
        Tipo::create([
            'tipo' => 'Organizador',
        ]);
    }
}
