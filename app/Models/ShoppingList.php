<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ShoppingList extends Model
{
    use HasFactory;

	/*
	 * Relationships
	 */
    public function items($dir = 'asc'): BelongsToMany
    {
        return $this->belongsToMany(Item::class)
            ->withPivot('order')
            ->orderByPivot('order', $dir);
    }

	/*
	 * Scopes
	 */
	public function scopeSearch($query, $string)
	{
		return $query->where('name', 'LIKE', "%{$string}%");
	}

	public function scopeWithItemCounts($query)
	{
		return $query->withCount(['items',
			'items as items_needed_count' => fn ($q) => $q->where('have', false)
		]);

	}

	/*
	 * Methods
	 */
	public function isCurrent($list): bool
	{
		return $this->id == $list?->id;
	}

	public function hasItem($item): bool
	{
		return $this->items->contains($item);
	}
}
