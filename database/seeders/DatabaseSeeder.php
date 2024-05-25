<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Publisher;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(150)->create();


        $users = User::all()->shuffle();
        for($i = 0; $i < 15; $i++)
        {
            Publisher::factory()->create([
                'user_id' => $users->pop()->id
            ]);
        }


        $publishers = Publisher::all();
        for($i = 0; $i < 100; $i++)
        {
            Book::factory()->create([
                'publisher_id' => $publishers->random()->id
            ]);
        }

    }
}
