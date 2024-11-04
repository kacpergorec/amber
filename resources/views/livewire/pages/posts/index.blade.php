<x-app-layout>



    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <h1 class="text-3xl my-6">
            {{__('Posts')}}
        </h1>
        <div class="card bg-white dark:bg-base-300 overflow-x-auto p-3">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Title')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('Author')}}</th>
                    <th>{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $key => $post)
                    <tr>
                        <td class="text-zinc-400">
                            {{++$key}}
                        </td>
                        <td>
                            <a href="{{route('posts.edit',$post)}}" class="link link-hover">
                                {{$post->title}}
                            </a>
                        </td>
                        <td>
                            <span class="badge badge-ghost text-zinc-900 dark:text-zinc-100" style="--tw-bg-opacity:.5">
                                    {{$post->publishedAt ? __('Published') : __('Draft')}}
                            </span>
                        </td>
                        <td>
                            {{$post->author->name}}
                        </td>
                        <td>
                            <a href="{{route('posts.destroy',$post)}}" class="link link-hover link-error">
                                {{__('Delete')}}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
