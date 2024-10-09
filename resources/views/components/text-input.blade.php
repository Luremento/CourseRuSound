@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-300 focus:border-indigo-50 focus:ring-indigo-500rounded-md shadow-sm',
]) !!}>
