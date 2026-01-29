<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5000; $i++) {
            User::create([

                'name' => 'name' . $i,
                'paternal_surname' => 'paternal' . $i,
                'maternal_surname' => 'maternal' . $i,
                'email' => 'email' . $i . '@fis.com',
                'password' => bcrypt('secreto'),
                'dni' => 10000000 + $i,
            ]);
        }
    }
}
