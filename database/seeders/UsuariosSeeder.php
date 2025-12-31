<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
    $usuarios = [
        ['name' => 'Nayeli', 'email' => 'ayemenis123@gmail.com'],
        ['name' => 'Frida', 'email' => 'frida@gmail.com'],
        ['name' => 'Johan', 'email' => 'johan@gmail.com'],
        ['name' => 'Mariela', 'email' => 'mariela@gmail.com'],
        ['name' => 'Brizaida Guiblia', 'email' => 'Brizaida@gmail.com'],
        ['name' => 'Administrador', 'email' => 'administrador@gmail.com'],
        ['name' => 'Secretaria', 'email' => 'secretaria@gmail.com'],
        ['name' => 'Personal', 'email' => 'personal@gmail.com'],
        ['name' => 'Encargado', 'email' => 'encargado@gmail.com'],
    ];
 
    foreach ($usuarios as $u) {
        \App\Models\User::create([
            'name' => $u['name'],
            'email' => $u['email'],
            'password' => bcrypt('12345678'), // Todos tendrán esta clave inicial
            'role' => 'admin'
        ]);
    }
}
}
