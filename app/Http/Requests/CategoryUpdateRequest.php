<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryUpdateRequest extends CategoryRequest
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

    /**
     * Update
     */
    public function update($category)
    {
        $parent = Category::where('uuid', $this->parent)->first();

        if($category->parent_id == $parent->id)
        {
            $slug = $this->filled('slug') ? Str::slug($this->slug) : $category->slug;
        }
        else
        {
            $slug = $this->filled('slug') ? Str::slug($this->slug) : $this->getSlug();

        }

        $category->category = $this->name;
        $category->slug = $slug;
        $category->parent_id = is_null($parent) ? null : $parent->id;
        $category->description = $this->description;

        if ($this->hasFile('thumbnail')) {
            Storage::delete('public/categories/' . $category->icon);
            $category->icon = $this->storeThumbnail();
        }

        $this->activity("Created {$this->name} category");

        $category->save();
    }
}
