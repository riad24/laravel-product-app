<?php

namespace App\Http\Requests;

use App\Rules\IniAmount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'name'            => [
                'required',
                'string',
                'max:190',
                Rule::unique("products", "name")->ignore($this->route('product.id'))
            ],
            'price'             => ['required', new IniAmount()],
            'quantity'          => ['required', 'numeric'],
            'description'       => ['nullable', 'string', 'max:2000'],
            'image'             => 'nullable|mimes:jpeg,jpg,png,gif|max:3096',
        ];
    }

}
