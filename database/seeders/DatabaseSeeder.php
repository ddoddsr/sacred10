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
        $sets= new \Database\Seeders\SetSeeder;
        $sets->run();
        
        \App\Models\User::factory(10)->withPersonalTeam()->create();
        // \App\Models\Team::factory(4)->create();
        \App\Models\User::factory()->withPersonalTeam()->create([
            'name' => 'Dan Dodd',
            'email' => 'dd@dd.io',
            'password' => bcrypt('asdf'),
        ]);

        \App\Models\User::factory(10)->create();
    }
}
