<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StorePostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'min:3|max:255',
            'name' => 'min:3|max:255',
            'description' => 'min:3',
            'price' => 'min:1'
        ];
    }
    public function messages()
    {
        return [
            'required' => 'поле обязательно для ввода',
            'min' => 'Поле :attribute должно содержать минимум :min символов',
            'max' => 'Поле :attribute должно содержать минимум :max символов',
            'unique' => 'Поле должно быть уникальным'
        ];
    }
    public function failedValidation(Validator $validator)
        {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
