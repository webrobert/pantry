<?php

namespace App\Actions;

use App\Models\Item;

class ClearBuyLaterItems
{
	public function __invoke()
	{
		Item::where('buy_later', true)->update(['buy_later' => false]);
	}
}
