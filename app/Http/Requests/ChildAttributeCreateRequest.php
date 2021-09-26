<?php

namespace App\Http\Requests;

use App\Models\ChildAttribute;

class ChildAttributeCreateRequest extends ChildAttributeRequest
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
            'name' => 'required',
            'parent_id' => 'required',
        ];
    }

    public function save()
    {
        ChildAttribute::create([
            'name' => $this->name,
            'attribute_id' => $this->parent_id,
        ]);
    }
}
