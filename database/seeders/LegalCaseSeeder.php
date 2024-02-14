<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Conversation;
use App\Models\LegalCase;
use App\Models\Quotation;
use App\Models\Status;
use App\Models\TypeCase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function App\Helpers\generateCorrelativeCode;

class LegalCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::all();
        $typeCases = TypeCase::all();
        $statuses = Status::all();
        $quotations = Quotation::all();
        $conversations = Conversation::all();

        for ($i = 0; $i < 25; $i++) {
            $client = $clients->random();
            $typeCase = $typeCases->random();
            $status = $statuses->random();
            $quotation = $quotations->random();
            $conversation = $conversations->random();

            LegalCase::updateOrCreate([
                'code' => generateCorelativeCode(),
                'client_id' => $client->id,
                'type_case_id' => $typeCase->id,
                'conversation_id' => $conversation->id,
                'status_id' => $status->id,
                'quotation_id' => $quotation->id,
            ]);
        }
    }
}
