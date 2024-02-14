<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Abierto',
            'En proceso',
            'Cerrado con éxito',
            'Cerrado perdido',
        ];

        foreach ($statuses as $status) {
            Status::updateOrCreate(['name' => $status]);
        }
    }
}
