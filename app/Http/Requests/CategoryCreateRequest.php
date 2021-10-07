<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryCreateRequest extends CategoryRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max: 255',
        ];
    }

    public function save()
    {
        $parent_category_id = is_null($this->parent) ? null : Category::where('uuid', $this->parent)->first()->id;

        $category = Category::create([
            'uuid' => Str::orderedUuid(),
            'parent_id' => $parent_category_id,
            'category' => $this->name,
            'slug' => $this->getSlug(),
            'level' => $this->parent ? $this->level() : 2,
            'description' => $this->description,
            'icon' => $this->filled('thumbnail') ? $this->storeThumbnail() : null
        ]);

        $this->activity("Created {$this->name} category");

        return $category;
    }

    private function level()
    {
        $parent = Category::where('uuid', $this->parent)->first();

        if ($parent->level == 2) {
            return 1;
        }
        return 0;
    }
}
