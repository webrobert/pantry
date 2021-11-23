<?php

namespace App\Http\Livewire\ShoppingLists;

use App\Models\ShoppingList as ShoppingListModel;
use Livewire\Component;
use App\Models\Item;

class ShoppingList extends Component
{
    public $showHave = true;
    public $itemsNotInList;
    public $shoppingLists;
    public $sort = 'asc';
    public $activeItem;
    public $activeList;
    public $search;
    public $items;

    protected $listeners = [
        'itemDeleted' => '$refresh',
        'itemSaved' => '$refresh',
    ];

    public function mount($id = null)
    {
        $this->shoppingLists = ShoppingListModel::all();
        $this->activeList = $this->shoppingLists->where('id', $id)->first();
    }

    public function checkItem($id)
    {
        Item::find($id)->toggleHave();
    }

    public function updateItemOrder($items)
    {
        if (! $this->activeList ) return;

        collect($items)->each( function($item) {
            $this->activeList->items()->updateExistingPivot( $item['value'], [
                'order' => $item['order'],
            ]);
        });
    }

    protected function itemDoesntExist() : bool
    {
        return ($this->activeList && $this->search && $this->items->isEmpty());
    }

    public function render()
    {
        $query = $this->activeList
            ? $this->activeList->items($this->sort)
            : Item::query();

        $this->items = $query
            ->where('name', 'LIKE', "%{$this->search}%")
            ->when( ! $this->showHave, fn ($q) => $q->where('have', false))
            ->get();

        $this->itemsNotInList = $this->itemDoesntExist()
            ? Item::where('name', 'LIKE', "%{$this->search}%")->get()
            : collect();

        return view('shopping-lists.shopping-list');
    }
}
