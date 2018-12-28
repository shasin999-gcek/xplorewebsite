<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvent extends FormRequest
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
            'name' => 'required|string|max:50',
            'category_id' => 'required|numeric',
            'type' => 'required|string|max:20',
            'description' => 'required|string|max:500',
            'reg_fee' => 'required|numeric',
            'f_price' => 'required|numeric',
            's_price' => 'required|numeric',
            't_price' => 'required|numeric',
            'poster_image' => 'required|file|mimes:jpeg,bmp,png',
            'thumbnail_image' => 'required|file|mimes:jpeg,bmp,png'
        ];
    }
}
