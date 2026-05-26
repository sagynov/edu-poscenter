<?php

namespace App\View\Components;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public int $category)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $categories = Category::where('is_active', true)->with('translation')->get();
        $resolved = CategoryResource::collection($categories)->resolve();
        // Строим дерево из плоского массива
        $tree = $this->buildTree($resolved);

        $current_category = Category::where('id', $this->category)->with('articles.translations')->get();

        return view('components.sidebar', [
            'categories'       => $tree,
            'current_category' => $current_category,
        ]);
    }

    private function buildTree(array $items, int $parentId = null): array
    {
        $branch = [];
        foreach ($items as $item) {
            if ($item['parent_id'] === $parentId) {
                $item['children'] = $this->buildTree($items, $item['id']);
                $branch[] = $item;
            }
        }
        return $branch;
    }
}
