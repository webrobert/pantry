<?php

namespace App\Http\Livewire\Products;

use App\Services\KrogerApi\Products;
use Livewire\Component;

class ProductSuggestions extends Component
{
    public $activeItem;

    protected $listeners = ['itemActive'];

    public function itemActive($item)
    {
        $this->activeItem = $item;
    }

    public function getItemsProperty()
    {
        return isset($this->activeItem['name'])
            ? (New Products())->search( $this->activeItem['name'], '70300108' )['data']
            : [];
    }

    public function render()
    {
        return view('products.product-suggestions');
    }
}
