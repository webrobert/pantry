<div class="relative">
    <input type="text" id="floating_outlined"
           class="pr-8 truncate block px-2.5 pb-2.5 pt-4
                           w-full text-sm text-gray-900
                           bg-transparent rounded-lg border-1 border-gray-400
                           appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
           placeholder=" "
           value="{{ $value }}"
           disabled>
    <label for="floating_outlined"
           class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-gray-100 px-2
                        peer-focus:px-2 peer-focus:text-blue-600
                        peer-focus:dark:text-blue-500
                        peer-placeholder-shown:scale-100
                        peer-placeholder-shown:-translate-y-1/2
                        peer-placeholder-shown:top-1/2
                        peer-focus:top-2
                        peer-focus:scale-75
                        peer-focus:-translate-y-4
                        left-1">
        {{ $label }}
    </label>

    @isset($action)
    {{ $action }}
    @endisset
</div>