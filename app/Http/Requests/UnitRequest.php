<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
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
            'type_id' => 'required|exists:types,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Unit name is required.',
            'type_id.required' => 'Please select a unit type.',
        ];
    }
}
