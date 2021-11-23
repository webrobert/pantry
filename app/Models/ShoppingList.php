<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    use HasFactory;

    public function items($dir = 'asc')
    {
        return $this->belongsToMany(Item::class)
            ->withPivot('order')
            ->orderByPivot('order', $dir);
    }
}
