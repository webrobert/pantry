<?php

namespace App\Http\Livewire\ShoppingLists;

use App\Models\ShoppingList;
use Livewire\Component;

class ShoppingLists extends Component
{
    public $search;

    protected $listeners = [
        'shoppingListSaved' => '$refresh',
        'listDeleted' => '$refresh'
    ];

    public function getShoppingListsProperty()
    {
        return ShoppingList::query()
            ->search($this->search)
            ->withItemCounts()
            ->get();
    }

    public function render()
    {
        return view('shopping-lists.shopping-lists');
    }
}
