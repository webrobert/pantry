<?php

namespace Database\Seeders;

use App\Models\ShoppingList;
use Illuminate\Database\Seeder;

class ShoppingListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = [
			'Costco',
	        'Safeway & Raley\'s',
	        'Whole Foods', 'Amazon',
	        'Persian Store',
	        'Trader Joe\'s',
	        'Vitamins',
	        'Bristol\'s',
	        'World Market',
	        'Raley\'s',
	        'Grassroots',
	        'Quick Daily Shop',
	        'Overland Butchers'
        ];

		collect($stores)->each( fn($store) => ShoppingList::create([
			'name' => $store,
			'team_id' => 1,
		]) );
    }
}
