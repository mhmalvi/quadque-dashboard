<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Support\Str;

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
        $category = Category::create([
            'uuid' => Str::orderedUuid(),
            'parent_id' => is_null($this->parent) ? null : Category::where('uuid', $this->parent)->first()->id,
            'category' => $this->name,
            'slug' => $this->filled('slug') ? Str::slug($this->slug) : Str::slug($this->name),
            'description' => $this->description,
            'icon' => $this->hasFile('thumbnail') ? $this->storeThumbnail() : null
        ]);

        $this->activity("Created {$this->name} category");

        return $category;
    }
}
