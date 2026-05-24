@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-2 border-turquoise bg-old-lace text-cerulean focus:border-grapefruit focus:ring-grapefruit rounded-md shadow-sm w-full transition duration-150']) !!}>