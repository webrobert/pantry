<?php

namespace App\Http\Livewire\ShoppingLists;

use App\Models\ShoppingList as ShoppingListModel;
use Livewire\Component;
use App\Models\Item;

class ShoppingList extends Component
{
	public $show = 'shop';
    public $sort = 'asc';
    public $activeItem;
    public $activeList;
    public $search;
	public $recent;

    protected $listeners = [
        'itemDeleted' => '$refresh',
        'itemSaved' => '$refresh',
    ];

    public function mount($id = null)
    {
        $this->activeList = $this->shoppingLists->where('id', $id)->first();
    }

	public function getShoppingListsProperty()
    {
        return ShoppingListModel::query()
            ->withItemCounts()
            ->get();
    }

    public function getEmptyMessageProperty()
    {
        return match(true) {
            $this->search   && $this->show === 'shop'   => "No matches in to shop for",
            ! $this->search && $this->show === 'shop'   => "Nothing to shop for in this list",
            $this->search   && ! $this->activeList      => "No matching items",
            ! $this->search                             => "This list is empty",
            default                                     => "No matches in this list",
        };
    }

    public function getItemsNotInListProperty()
    {
        return $this->itemDoesntExist()
            ? Item::search($this->search)
		        ->notInList($this->activeList->id)
                ->get()
            : collect();
    }

    public function getItemsProperty()
    {
        $query = $this->activeList
            ? $this->activeList->items($this->sort)
            : Item::query();

        return $query
            ->search($this->search)
	        ->when($this->show === 'recent', fn($q) => $q->orderByDesc('updated_at')->take(10)->isChecked())
	        ->when(!$this->search && $this->show === 'shop', fn($q) => $q->toShopFor($this->activeList))
	        ->get();
    }

	public function checkItem($id)
	{
		Item::find($id)->toggleHave();

		if($this->show === 'recent') $this->reset(['show']);
	}

	public function buyLater($id)
	{
		Item::find($id)->buyLater();
		$this->browserToaster('we sent that one off to the fishes!');
	}

	public function updateItemOrder($items)
	{
		if (! $this->activeList) return;

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

    public function render()
    {
        return view('shopping-lists.shopping-list');
    }
}
