<?php

namespace App\Http\Livewire\Items;

use App\Models\ShoppingList;
use Livewire\Component;
use App\Models\Item;

class AddItemModal extends Component
{
    public $showItemModal = false;
    public $itemShoppingLists;
    public $shoppingLists;
    public $item;

    protected $listeners = [
        'editItem' => 'edit',
        'createItemFromSearch' => 'create'
    ];

    public function mount($shoppingList = null)
    {
        $this->shoppingLists = ShoppingList::all();
        $this->shoppingList = $shoppingList;
        $this->item = new Item();
    }

//    public function updatedShowItemModal()
//    {
//        $this->emit('itemActive', $this->item );
//    }

    protected function rules()
    {
        return [
            'item.name' => 'required',
        ];
    }

    public function toggleList($id)
    {
        if (! $this->item->id) {
            $this->save();
            $this->showItemModal = true;
        }

        $this->item->shoppingLists()->toggle($id);
        $this->itemShoppingLists = $this->item->refresh()->shoppinglists->keyBy('id')->toArray();
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
        $this->emit('itemActive', $this->item );
        $this->itemShoppingLists = $this->item->shoppinglists->keyBy('id')->toArray();
        $this->showItemModal = true;
    }

    public function delete()
    {
        $this->item->delete();

        $this->showItemModal = false;
        $this->reset('itemShoppingLists');

        $this->emit('itemDeleted');
    }

    public function save()
    {
        $this->validate();

        $this->item->save();

        if($this->item->wasRecentlyCreated && $this->shoppingList) {
            $this->item->shoppingLists()->attach($this->shoppingList->id);
        }

        $this->showItemModal = false;

        $this->emit('itemSaved', $this->item);
    }

    public function render()
    {
        $this->itemShoppingLists = $this->item->shoppinglists->keyBy('id')->toArray();

        return view('shopping-lists.add-item-modal');
    }
}
