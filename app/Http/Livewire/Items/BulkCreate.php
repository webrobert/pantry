<?php

namespace App\Http\Livewire\Items;

use App\Models\Item;
use Livewire\Component;

class BulkCreate extends Component
{
	public $items;

	public function save()
	{
		$lines = preg_split("/\r\n|\n|\r/", trim($this->items));

		collect($lines)->each( fn($item) => Item::firstOrCreate(['name' => $item]));

		$this->reset();

		$this->browserToaster('we sent that one off to the fishes!');
	}

    public function render()
    {
        return view('items.bulk-create');
    }
}
