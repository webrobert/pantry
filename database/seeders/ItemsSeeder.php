<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShoppingList;
use Illuminate\Support\Str;
use App\Models\Item;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShoppingList::all()->each(function ($store) {
            $store->slug = str::slug($store->name);

            if (file_exists($file = base_path("database/items/{$store->slug}.txt"))) {
                $items = collect(file($file));

                $items->map(function ($item) {
                    return trim($item);
                })->filter()->each(function ($item) use ($store) {
                    $item = $this->addItem($item);
                    $item->shoppingLists()->syncWithoutDetaching($store->id);
                });
            }
        });
    }

    protected function addItem($string)
    {
        $pos      = 5;
        $checkbox = substr($string, 0, $pos+1);
        $name     = substr($string, $pos+1);

        return Item::firstOrCreate([
	        'team_id' => 1,
	        'name' => $name,
            'have' => str_contains('- [x] ', $checkbox)
        ]);
    }
}
