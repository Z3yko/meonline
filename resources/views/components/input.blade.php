@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-mygreenSDark focus:ring focus:ring-mygreenDark focus:ring-opacity-50']) !!}>
