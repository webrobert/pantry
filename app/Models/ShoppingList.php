<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ShoppingList extends Model
{
    use HasFactory;

    public function items($dir = 'asc'): BelongsToMany
    {
        return $this->belongsToMany(Item::class)
            ->withPivot('order')
            ->orderByPivot('order', $dir);
    }

	public function isCurrent($list): bool
	{
		return $this->id == $list?->id;
	}

	public function hasItem($item): bool
	{
		return $this->items->contains($item);
	}
}
