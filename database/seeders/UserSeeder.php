<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Importa DB correctamente
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'rol' => 'administrador',
            ],
            [
                'name' => 'Auditor',
                'email' => 'auditor@example.com',
                'password' => Hash::make('password'),
                'rol' => 'auditor',
            ],
            [
                'name' => 'Denunciante',
                'email' => 'denunciante@example.com',
                'password' => Hash::make('password'),
                'rol' => 'denunciante',
            ],
        ]);
    }
}
