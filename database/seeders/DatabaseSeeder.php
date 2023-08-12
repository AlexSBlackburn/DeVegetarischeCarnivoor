<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory()->create([
             'name' => 'Saskia',
             'email' => 'saskia@devegetarischecarnivoor.nl',
             'password' => bcrypt('password'),
         ]);

        $this->call([
            RecipeSeeder::class,
        ]);
    }
}
