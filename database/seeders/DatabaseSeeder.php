<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory()->create([
             'name' => 'Saskia',
             'email' => 'saskia@devegetarischecarnivoor.nl',
         ]);

        $this->call([
            RecipeSeeder::class,
        ]);
    }
}
