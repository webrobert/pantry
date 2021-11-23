<?php

namespace App\Http\Livewire\ShoppingLists;

use Livewire\Component;

class ShoppingLists extends Component
{
    public $shoppingLists;
    public $search;

    protected $listeners = [
        'shoppingListSaved' => '$refresh',
        'listDeleted' => '$refresh'
    ];

    public function render()
    {
        $this->shoppingLists = \App\Models\ShoppingList::query()
            ->where('name', 'LIKE', "%{$this->search}%")
            ->get();

        return view('shopping-lists.shopping-lists');
    }
}
