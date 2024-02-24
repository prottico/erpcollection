<?php

namespace Database\Seeders;

use App\Models\IdentityType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdentityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'national',
            'foreigner'
        ];

        foreach ($statuses as $status) {
            IdentityType::updateOrCreate(['name' => $status]);
        }
    }
}
