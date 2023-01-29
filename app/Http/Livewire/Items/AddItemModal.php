<?php

namespace App\Http\Livewire\Items;

use App\Models\ShoppingList;
use Livewire\Component;
use App\Models\Item;

class AddItemModal extends Component
{
	public $showItemShoppingListsModal;
	public $showItemModal = false;
    public $item;

    protected $listeners = [
        'createItemFromSearch' => 'create',
        'editItem' => 'edit',
    ];

	protected $rules = [ 'item.name' => 'required', ];

    public function mount($shoppingList = null)
    {
        $this->shoppingList = $shoppingList;
        $this->item = new Item();
    }

	public function getShoppingListsProperty()
	{
		return ShoppingList::all();
	}

	public function getItemShoppingListsProperty()
	{
		return $this->item->shoppinglists;
	}

	public function showOn($list)
	{
		return $list->hasItem($this->item) ||
		       $list->isCurrent($this->shoppingList) && $this->item->isUnsaved();
	}

    public function toggleList($id)
    {
        if (! $this->item->id) {
            $this->save();
            $this->showItemModal = true;
        }

        $this->item->shoppingLists()->toggle($id);
	    $this->item->refresh();
    }

	public function buyNextAt($input)
	{
		$listId = $input != 'clear' ? $input : null;
		$this->item->update(['buy_next_at_id' => $listId]);
		$this->item->refresh();
	}

    public function create($name = null)
    {
        $this->item = new Item();
        $this->item->fill(['name' => $name]);
        $this->emit('itemActive', $this->item );
        $this->showItemModal = true;
    }

    public function edit($id)
    {
        $this->item = Item::find($id);
        $this->emit('itemActive', $this->item);
        $this->showItemModal = true;
    }

    public function delete()
    {
        $this->item->delete();

	    $this->emit('itemDeleted');

	    $this->showItemModal = false;
    }

    public function save()
    {
        $this->validate();
        $this->item->save();

        if ($this->item->wasRecentlyCreated && $this->shoppingList) {
            $this->item->shoppingLists()->attach($this->shoppingList->id);
        }

        $this->emit('itemSaved', $this->item);

	    $this->showItemModal = false;
    }

    public function render()
    {
        return view('items.add-item-modal');
    }
}
