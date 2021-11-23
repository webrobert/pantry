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
        $stores = collect(['Costco', 'Ralphs', 'Whole Foods', 'Amazon', 'Persian Store', 'Trader Joe\'s', 'Vitamins'])
            ->each( function ($store) {
                ShoppingList::create(['name' => $store]);
            });
    }
}
