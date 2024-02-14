<?php

namespace Database\Seeders;

use App\Models\ClientType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'company'],
            ['name' => 'independent'],
        ];

        foreach ($data as $type) {
            ClientType::updateOrCreate($type);
        }
    }
}
