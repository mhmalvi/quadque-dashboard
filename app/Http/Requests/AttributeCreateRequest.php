<?php

namespace App\Http\Requests;

use App\Models\Attribute;

class AttributeCreateRequest extends AttributeRequest
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
            'name' => "required",
        ];
    }

    public function save()
    {
        Attribute::create([
            'attribute' => $this->name,
            'description' => $this->description,
        ]);
    }
}
