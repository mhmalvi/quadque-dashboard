<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Support\Str;

class CreateCategoryRequest extends CategoryRequest
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
        $category = Category::create([
            'uuid' => Str::orderedUuid(),
            'parent_id' => $this->parent,
            'category' => $this->name,
            'slug' => $this->filled('slug') ? Str::slug($this->slug) : Str::slug($this->name),
            'description' => $this->description,
            'icon' => $this->hasFile('thumbnail') ? $this->storeThumbnail() : null
        ]);

        $this->userActivity("Created {$this->name} category");

        return $category;
    }
}
