<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function toggleHave()
    {
        $this->have = ! $this->have;
        return $this->save();
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
}
