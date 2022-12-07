<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();



        if (count(User::all()) == 0) {
            \App\Models\User::factory()->create([
                'name' => 'Test User',
            ]);
        }
        $this->call(LocationsSeeder::class);
        $this->call(PostsSeeder::class);
    }
}
