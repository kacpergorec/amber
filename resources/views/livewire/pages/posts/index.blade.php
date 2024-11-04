<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-3">
        <a href="{{ route('posts.create') }}" class="block w-fit bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-4 rounded transition-colors">
            {{ __('Add') }}
        </a>
        <ul>
            @foreach($posts as $post)
                <li>
                    {{$post->title}}
                    <a href="{{ route('posts.edit', $post) }}" class="text-primary-600 dark:text-primary-400">
                        {{ __('Edit') }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
posts
