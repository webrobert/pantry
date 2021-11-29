<div class="possible-products">
    @foreach($this->items as $item)
        {{-- @dump($item)--}}
        <div>{{ $item['description'] }}</div>
    @endforeach
</div>
