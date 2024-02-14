<?php

namespace Database\Seeders;

use App\Models\TypeCase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Proceso Sumario'],
            ['name' => 'Proceso Monitor'],
            ['name' => 'Proceso Ejecutivo Hipotecario'],
            ['name' => 'Ejecución de Sentencia'],
            ['name' => 'Fideicomiso'],
        ];

        foreach ($data as $type) {
            TypeCase::updateOrCreate($type);
        }
    }
}
