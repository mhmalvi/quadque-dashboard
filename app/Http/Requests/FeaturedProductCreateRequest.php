<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;
use App\Models\FeaturedProduct;

class FeaturedProductCreateRequest extends FormRequest
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
            'products' => "required",
        ];
    }

    public function save()
    {
        foreach($this->products as $item)
        {
            $product = Product::where('product', $item)->first();

            if(!FeaturedProduct::where('product_id', $product->id)->first())
            {
                $featured_product = new FeaturedProduct();

                $featured_product->product_id = $product->id;

                $featured_product->save();
            }

        }
    }
}
