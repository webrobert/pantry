<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

	public function buyLater(): bool
	{
		$this->buy_later = true;
		return $this->save();
	}

	public function toggleHave(): bool
    {
        $this->have = ! $this->have;
		$this->buy_next_at_id = null;
        return $this->save();
    }

	public function isUnsaved(): bool
	{
		return ! $this->id;
	}

    public function isOnList($list)
    {
        return $this->shoppingLists->contains($list->id);
    }

    public function shoppingLists()
    {
        return $this->belongsToMany(ShoppingList::class)
                    //->using(ItemStorePivot::class)
                    ->withPivot('order')
                    ->orderByPivot('order','asc');
    }

	public function buyNextAt()
	{
		return $this->belongsTo(ShoppingList::class, 'buy_next_at_id');
	}
}
