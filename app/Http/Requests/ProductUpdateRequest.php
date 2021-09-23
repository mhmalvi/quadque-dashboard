<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductUpdateRequest extends FormRequest
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

        $data = [
            'sku' => $this->sku,
            'product' => $this->title,
            'slug' => $this->slug,
            'descriptions' => $this->descriptions,
            'price' => $this->price,
            'discount' => $this->discount,
            'discount_type' => $this->discoun_type,
        ];

        if($brand)
        {
            $data['brand_id'] = $brand->id;
        }
        if($category)
        {
            $data['category_id'] = $category->id;
        }

        $product->update($data);
    }
}
