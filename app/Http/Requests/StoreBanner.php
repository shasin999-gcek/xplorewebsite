<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBanner extends FormRequest
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
            'e_w_id' => 'required|string|max:50',
            'type' => 'required|string|max:1',
            'banner_image' => 'required|file|mimes:jpeg,bmp,png',
        ];
    }
}
