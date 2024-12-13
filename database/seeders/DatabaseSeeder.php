<?php

namespace Database\Seeders;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
	    (new CreateNewUser)->create([
		    'name' => 'Admin',
		    'email' => 'test@example.com',
		    'password' => 'password',
		    'password_confirmation' => 'password'
	    ]);

        $this->call([
            ShoppingListSeeder::class, // create default lists
            ItemsSeeder::class         // add items
        ]);
    }
}
