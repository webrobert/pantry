<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    use HasFactory, BelongsToTeam;

	/*
	 * Relationships
	 */
	public function shoppingLists(): BelongsToMany
	{
		return $this->belongsToMany(ShoppingList::class)
		            ->withPivot('order')
		            ->orderByPivot('order','asc');
	}

	public function buyNextAt(): BelongsTo
	{
		return $this->belongsTo(ShoppingList::class, 'buy_next_at_id');
	}

	/*
	 * Scopes
	 */
	public function scopeSearch($query, $string)
	{
		return $query->where('name', 'LIKE', "%{$string}%");
	}

	public function scopeToShopFor($query, $activeList)
	{
		return $query
			->where('have', false)
			->where('buy_later', false)
			->where( fn($q) => $q->where('buy_next_at_id', $activeList?->id)
			                     ->orWhere('buy_next_at_id', null)
			);
	}

	public function scopeNotInList($query, $listId)
	{
		return $query->whereDoesntHave('shoppingLists', fn($q) => $q->where('id', $listId) );
	}

	public function scopeIsChecked($query)
	{
		return $query->where('have', true);
	}

	/*
	 * Methods
	 */
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

    public function isOnList($list): bool
    {
        return $this->shoppingLists->contains($list->id);
    }
}
