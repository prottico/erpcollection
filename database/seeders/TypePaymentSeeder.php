<?php

namespace Database\Seeders;

use App\Models\TypePayment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypePaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Judicial', 'Extrajudicial'];

        foreach ($types as $type) {
            TypePayment::updateOrCreate(['name' => $type]);
        }
    }
}
