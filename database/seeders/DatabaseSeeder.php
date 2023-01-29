<?php

namespace Database\Seeders;

use App\Actions\Jetstream\CreateTeam;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ]);

        (New CreateTeam)->create($user, [
            'name' => "{$user->name}'s Team"
        ]);

        $this->call([
            ShoppingListSeeder::class, // create default lists
            ItemsSeeder::class         // add items
        ]);
    }
}
