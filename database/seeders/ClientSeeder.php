<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $people = Person::whereNotIn('id', [2])->get();

        $people->each(function ($person) {
            Client::factory()->create([
                'person_id' => $person->id
            ]);
        });
    }
}
