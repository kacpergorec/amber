@props(['active' => false])
<a
    {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-start text-sm leading-5 text-zinc-700 dark:text-zinc-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 focus:outline-none focus:bg-neutral-100 dark:focus:bg-neutral-800 transition duration-150 ease-in-out' . ($active ? ' font-bold dark:text-white text-black' : '')]) }}>{{ $slot }}</a>
