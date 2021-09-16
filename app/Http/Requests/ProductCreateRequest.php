<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductCreateRequest extends ProductRequest
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

    public function save()
    {
        $product = Product::create([
            'uuid' => Str::orderedUuid(),
            'sku' => $this->sku,
            'product' => $this->title,
            'slug' => $this->slug ? Str::slug($this->slug) : Str::slug($this->title),
            'descriptions' => $this->description,
            'category_id' => $this->filled('category') ? $this->getCategoryId() : null,
            'brand_id' => $this->filled('brand') ? $this->getBrandId() : null,
            'price' => $this->price,
            'discount' => $this->discount ?? 0.00,
            'discount_type' => $this->discount_type,
            'unit' => $this->sale_unit,
            'unit_type_id' => $this->filled('unit_type') ? $this->getUnitTypeId() : null,
            'thumbnail' => $this->filled('thumbnail') ? $this->storeThumbnailImages() : null,
            'alt' => Str::slug($this->title),
            'publish' => $this->isDraft ? 0 : 1
        ]);

        if ($product->id) {
            /**
             * Save product seo
             */
            $this->saveProductSeo($product->id);

            /**
             * save gallary images
             */
            if ($this->filled('images')) {
                $this->storeGallaryImages($product->id);
            }
        }
    }
}
