<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Bouncer;


class BouncerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bouncer::role()->firstOrCreate([ // la extencion de bouncer es para roles
            'name' => 'admin',
            'title' => 'Administrador'
        ]);

        for ($i = 1; $i <= 5; $i++) {
            $user = User::find($i);
            $user->assign('admin'); // la extencion de bouncer es para asignar roles
        }
    }
}
