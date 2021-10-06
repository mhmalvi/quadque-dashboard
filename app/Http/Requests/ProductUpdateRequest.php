<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;

class ProductUpdateRequest extends ProductRequest
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
            'title' => 'required|string|max:255',
            'price' => 'required|int',
            'thumbanil' => 'mimes:jpg,png',
        ];
    }

    public function update(Product $product)
    {
        $brand = Brand::where('slug', $this->brand)->first();
        $category = Category::where('slug', $this->category)->first();

        $product->sku = $this->sku;
        $product->product = $this->title;
        $product->slug = $this->filled('slug') ? Str::slug($this->slug) : Str::slug($this->title);
        $product->descriptions = $this->descriptions;
        $product->price = $this->price;
        $product->discount = $this->discount;
        $product->discount_type = $this->discoun_type;

        if ($brand) {
            $product->brand_id = $brand->id;
        }
        if ($category) {
            $product->category_id = $category->id;
        }

        if ($this->filled('thumbnail')) {
            $this->storeThumbnailImages();
        }

        $product->save();
    }
}
