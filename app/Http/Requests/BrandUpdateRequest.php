<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use App\Models\Brand;

class BrandUpdateRequest extends BrandRequest
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
            'name' => 'required|string|max:255',
        ];
    }

    public function update(Brand $brand)
    {
        $slug = $this->filled('slug') ? Str::slug($this->slug) : Str::slug($this->name);

        $brand->brand = $this->name;
        $brand->slug = $slug;
        $brand->description = $this->description;
        $brand->icon = $this->hasFile('thumbnail') ? $this->storeThumbnail() : null;

        $brand->save();

        $this->activity("Update {$this->name} brand");

        return $brand;
    }
}
