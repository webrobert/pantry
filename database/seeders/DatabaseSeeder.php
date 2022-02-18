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
            'name' => 'Robert',
            'email' => 'robertw@hey.com',
            'password' => '$2y$10$3AcHh8eujSwLVtEyl88MVeRYyIWHY8ofZ00WQoFxrpW5dmWjmXRYC'
        ]);

        (New CreateTeam)->create($user, [
            'name' => "{$user->name}'s Team"
        ]);

        $this->call([
            ShoppingListSeeder::class,
            ItemsSeeder::class
        ]);
    }
}
