<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define roles a insertar en la BD
        $roles = [
            ['name' => 'author'],
            ['name' => 'editor'],
            ['name' => 'admin'],
        ];

        // Utilitza DB::table per insertar datos a tabla
        \DB::table('roles')->insert($roles);
    }
}
