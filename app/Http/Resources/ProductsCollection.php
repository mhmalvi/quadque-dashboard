<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($res) {
                return [
                    'id' => $res->uuid,
                    'sku' => $res->sku,
                    'title' => $res->product,
                    'slug' => $res->slug,
                    'category' => $res->category_id ? $res->category->category : '--',
                    'brand' => $res->brand_id ? $res->brand->brand : '--',
                    'thumbnail' => $res->thumbnail
                ];
            })
        ];
    }
}
