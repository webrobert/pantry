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

	public function buyLater($id)
	{
		Item::find($id)->buyLater();
		$this->browserToaster('we send that one off to the fishes!');
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
        return ($this->activeList && $this->search);
    }

    public function getShoppingListsProperty()
    {
        return ShoppingListModel::query()
            ->withCount(['items',
	            'items as items_needed_count' => fn($q) => $q->where('have', false)
            ])
            ->get();
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
            ? Item::where('name', 'LIKE', "%{$this->search}%")
                ->whereDoesntHave('shoppingLists', function ($q) {
                    $q->where('id',$this->activeList->id);
                })
                ->get()
            : collect();
    }

    public function getItemsProperty()
    {
        $query = $this->activeList
            ? $this->activeList->items($this->sort)
            : Item::query();

        return $query
            ->where('name', 'LIKE', "%{$this->search}%")
            ->when( ! $this->search && ! $this->showHave,
	            fn ($q) => $q->where('have', false)
		                     ->where('buy_later', false)
	                         ->where(function ($query) {
					            return $query->where('buy_next_at_id', $this->activeList?->id)
					                         ->orWhere('buy_next_at_id', null);
				            })
            )
            ->get();
    }

    public function render()
    {
        return view('shopping-lists.shopping-list');
    }
}
