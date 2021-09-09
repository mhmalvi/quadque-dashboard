<?php

namespace App\Http\Requests;

use App\Models\Brand;
use Illuminate\Support\Str;

class BrandCreateRequest extends BrandRequest
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
            'name' => 'required|string|max:255'
        ];
    }

    /**
     * Save
     */
    public function save()
    {
        return Brand::create([
            'uuid' => Str::orderedUuid(),
            'brand' => $this->name,
            'slug' => is_null($this->slug) ? Str::slug($this->name) : Str::slug($this->slug),
            'description' => $this->description,
            'icon' => $this->hasFile('icon') ? $this->storeThumbnail() : null
        ]);
    }
}
