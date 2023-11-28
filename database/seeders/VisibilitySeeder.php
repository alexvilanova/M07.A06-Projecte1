<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisibilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $visibilities = [
            ['name' => 'public'],
            ['name' => 'contacts'],
            ['name' => 'private'],
        ];

        // Utilitza DB::table per insertar datos a tabla
        \DB::table('visibilities')->insert($visibilities);
    }
}
