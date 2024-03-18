<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([RolesSeeder::class]);
        $this->call([AdminUserSeeder::class]);
        $this->call([UserTypeSeeder::class]);
        $this->call([ClientTypeSeeder::class]);
        $this->call([IdentityTypeSeeder::class]);
        $this->call([UserSeeder::class]);

        $this->call([ConversationSeeder::class]);
        $this->call([MessageSeeder::class]);

        $this->call([TypeCaseSeeder::class]);
        // $this->call([PersonSeeder::class]);
        $this->call([ClientSeeder::class]);
        $this->call([StatusSeeder::class]);
        $this->call([TypePaymentSeeder::class]);
        $this->call([CurrencySeeder::class]);
        // $this->call([QuotationSeeder::class]);
        // $this->call([LegalCaseSeeder::class]);
    }
}
