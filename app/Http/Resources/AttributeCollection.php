<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AttributeCollection extends ResourceCollection
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
                    'title' => $res->attribute,
                    'description' => is_null($res->description) ? "--" : $res->description,
                    'children' => new ChildAttributesCollection(
                        $res->children
                    ),
                    'created_at' => $res->created_at->format("Y-m-d H:i"),
                ];
            })
        ];
    }
}
