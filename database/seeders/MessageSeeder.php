<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conversations = Conversation::pluck('id');
        $users = User::pluck('id');

        Message::factory(50)->create([
            'transmitter_id' => function () use ($users) {
                return $users->random();
            },
            'conversation_id' => function () use ($conversations) {
                return $conversations->random();
            },
            'receiver_id' => function () use ($users) {
                return $users->random();
            },
        ]);
    }
}
