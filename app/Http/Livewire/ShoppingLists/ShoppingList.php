<?php

namespace App\Http\Livewire\ShoppingLists;

use App\Models\ShoppingList as ShoppingListModel;
use Livewire\Component;
use App\Models\Item;

class ShoppingList extends Component
{
    public $showHave = false;
    public $sort = 'asc';
    public $activeItem;
    public $activeList;
    public $search;

    protected $listeners = [
        'itemDeleted' => '$refresh',
        'itemSaved' => '$refresh',
    ];

    public function mount($id = null)
    {
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

    public function getShoppingListsProperty()
    {
        return ShoppingListModel::all();
    }

    public function getEmptyMessageProperty()
    {
        return match(true) {
            $this->search && ! $this->showHave   => "No matches in to shop for",
            ! $this->search && ! $this->showHave => "Nothing to shop for in this list",
            $this->search && ! $this->activeList => "No matching items",
            ! $this->search                      => "This list is empty",
            default                              => "No matches in this list",
        };
    }

    public function getItemsNotInListProperty()
    {
        return $this->itemDoesntExist()
            ? Item::where('name', 'LIKE', "%{$this->search}%")->get()
            : collect();
    }

    public function getItemsProperty()
    {
        $query = $this->activeList
            ? $this->activeList->items($this->sort)
            : Item::query();

        return $query
            ->where('name', 'LIKE', "%{$this->search}%")
            ->when( ! $this->showHave, fn ($q) => $q->where('have', false))
            ->get();
    }

    public function render()
    {
        return view('shopping-lists.shopping-list');
    }
}
