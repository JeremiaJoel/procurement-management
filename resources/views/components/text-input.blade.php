@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'pl-10 pr-4 py-3 rounded-lg w-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500']) }}>
