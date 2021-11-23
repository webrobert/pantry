<?php

namespace App\Http\Livewire\ShoppingLists;

use \App\Models\ShoppingList;
use Livewire\Component;

class FastSwitch extends Component
{
    public $shoppingLists;
    public $activeList;

    public function mount()
    {
        $this->shoppingLists = ShoppingList::all();
    }

    public function chooseStore($id = null)
    {
        return redirect()->to($id
            ? route('shoppingLists.show', $id)
            : route('items.index')
        );
    }

    public function render()
    {
        return view('shopping-lists.fast-switch');
    }
}
