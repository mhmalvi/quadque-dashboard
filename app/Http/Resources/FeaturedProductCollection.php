<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FeaturedProductCollection extends ResourceCollection
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
            'data' => $this->collection->map(function($res)
            {
                return [
                    'id' => $res->id,
                    'product' => $res->product,
                    'status' => $res->status,
                    'created_at' => $res->created_at,
                ];
            })
        ];
    }
}
