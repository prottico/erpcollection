<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'company'],
            ['name' => 'independent'],
            ['name' => 'abogado'],
        ];

        foreach ($data as $type) {
            UserType::updateOrCreate($type);
        }
    }
}
