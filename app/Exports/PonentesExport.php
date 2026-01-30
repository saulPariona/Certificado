<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PonentesExport implements FromCollection
{
    protected $ponentes;

    public function __construct($ponentes)
    {
        $this->ponentes = $ponentes;
    }
    public function collection()
    {
        return $this->ponentes;
    }
}
