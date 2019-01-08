<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkshop extends FormRequest
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
            'description' => 'required|string|max:500',
            'reg_fee' => 'required|numeric',
            'poster_image' => 'required|file|mimes:jpeg,bmp,png',
            'thumbnail_image' => 'required|file|mimes:jpeg,bmp,png',
            'pdf_file' => 'required|file|mimes:pdf',
            'starts_on' => 'required|date',
            'ends_on' => 'required|date'
        ];
    }
}
