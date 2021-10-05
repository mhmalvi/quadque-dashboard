<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrdersCollection extends ResourceCollection
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
                    'user_id' => $res->id,
                    'order_no' => $res->order_no,
                    'payment_type' => $res->payment_type,
                    'total_price' => $res->amount,
                    'cart_info' => $res->cart,
                    'payment_status' => $res->payment_status,
                    'order_status' => $res->order_status,
                    'shipment_id' => $res->shipment_id,
                    'created_at' => $res->created_at->format("d-m-Y"),
                ];
            })
        ];
    }
}
