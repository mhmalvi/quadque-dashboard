<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BrandResourceController extends ResourceCollection
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
                    'title' => $res->brand,
                    'slug' => $res->slug,
                    'description' => is_null($res->description) ? "---" : $res->description,
                    'icon' => $res->icon,
                    'created' => $res->created_at
                ];
            })
        ];
    }
}
