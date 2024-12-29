<?php

namespace App\Http\Livewire\Items;

use App\Models\Item;
use Livewire\Component;

class BulkCreate extends Component
{
	public $items;

	public function save()
	{
		collect(array_filter(preg_split("/\r\n|\n|\r/", trim($this->items))))
			->each( fn($item) => Item::firstOrCreate(['name' => $item]));

		$this->reset();

		$this->browserToaster('Items added!');
	}

    public function render()
    {
        return view('items.bulk-create');
    }
}