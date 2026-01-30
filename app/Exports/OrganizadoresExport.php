<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrganizadoresExport implements FromCollection
{
    protected $organizadores;

    public function __construct($organizadores)
    {
        $this->organizadores = $organizadores;
    }
    public function collection()
    {
        return $this->organizadores;
    }
}
