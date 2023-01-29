@props(['checked' => false])
<input type="checkbox" {!! $attributes->merge([ 'class' => 'h-5 w-5 rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}
        {{ $checked ? 'checked' : '' }}>
