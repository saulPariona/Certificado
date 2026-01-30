<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AsistentesExport implements FromCollection
{
    protected $asistentes;

    public function __construct($asistentes)
    {
        $this->asistentes = $asistentes;
    }
    public function collection()
    {
        return $this->asistentes;
    }
}
