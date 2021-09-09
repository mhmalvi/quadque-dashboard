<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryResourceCollection extends ResourceCollection
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
                    'title' => $res->category,
                    'slug' => $res->slug,
                    'parent' => is_null($res->parent_id) ? "--" : $res->parent->category,
                    'description' => is_null($res->description) ? "---" : $res->description,
                    'icon' => is_null($res->icon) ? null : $res->icon,
                    'created' => $res->created_at
                ];
            })
        ];
    }
}
