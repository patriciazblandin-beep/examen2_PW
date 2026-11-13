<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        User::create([
            'name' => 'Administrador Agrovalle',
            'email' => 'admin@agrovalle.hn',
            'password' => Hash::make('password123'), 
        ]);
    }
}