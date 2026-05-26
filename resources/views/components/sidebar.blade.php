<aside class="flex flex-col gap-1">
    @include('components.category-tree', [
        'categories'       => $categories,
        'current_category' => $current_category,
    ])
</aside>