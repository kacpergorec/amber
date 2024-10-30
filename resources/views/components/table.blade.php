<!-- resources/views/components/table.blade.php -->
<div class="relative overflow-x-auto shadow-md">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                <div class="flex items-center">
                    <input id="checkbox-all" type="checkbox"
                           class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checkbox-all" class="sr-only">checkbox</label>
                </div>
            </th>
            @foreach($columns as $key => $header)
                <th scope="col" class="px-6 py-3">
                    {{ $header }}
                </th>
            @endforeach
            @if(isset($actions))
                <th scope="col" class="px-6 py-3 text-right">
                    Akcje
                </th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-{{ $item['id'] }}" type="checkbox"
                               class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-{{ $item['id'] }}" class="sr-only">checkbox</label>
                    </div>
                </td>
                @foreach($columns as $key => $header)
                    <td class="px-6 py-4 text-gray-500 whitespace-nowrap dark:text-white">
                        {{ $item[$key] }}
                    </td>
                @endforeach
                <td class="px-6 py-4 justify-end flex gap-4">
                    @foreach($actions as $action)
                        @if(array_key_exists('route', $action))
                            @php
                               // Dynamic Routes - Replace placeholders (ex. $id) with actual values ($item['id'])
                                $params = array_map(
                                    fn($p) => str_starts_with($p, '$') ? $item[trim($p, '$')] : $p,
                                    $action['params']
                                );
                            @endphp
                            <a href="{{ route($action['route'], $params) }}"
                               class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                {{ $action['label'] }}
                            </a>
                        @else
                            <a class="dark:text-blue-500 hover:underline" href="#">{{ $action['label'] }}</a>
                        @endif
                    @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
