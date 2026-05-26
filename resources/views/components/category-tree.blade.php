@foreach ($categories as $category)
    <div class="flex flex-col">
        <a
            href="{{ route('category.show', $category['slug']) }}"
            class="px-3 py-1.5 rounded-md transition {{ $current_category === $category['id'] ? 'text-sky-600 font-semibold bg-sky-50' : 'text-gray-700 hover:text-sky-600 hover:bg-gray-50' }}"
        >
            {{ $category['name'] }}
        </a>

        {{-- Рекурсия для дочерних категорий --}}
        @if (!empty($category['children']))
            <div class="ml-4 flex flex-col mt-1">
                @include('components.category-tree', [
                    'categories'       => $category['children'],
                    'current_category' => $current_category,
                ])
            </div>
        @endif
    </div>
@endforeach