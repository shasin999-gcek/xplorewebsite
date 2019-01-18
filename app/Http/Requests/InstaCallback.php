<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstaCallback extends FormRequest
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
            'amount' => 'required|string',
            'buyer' => 'required|string',
            'TXNID' => 'required|string',
            'BANKTXNID' => 'required|string',
            'TXNAMOUNT' => 'required|string',
            'CURRENCY' => 'required|string',
            'STATUS' => 'required|string',
            'RESPCODE' => 'required|string',
            'RESPMSG' => 'required|string',
            'TXNDATE' => 'required|string',
            'GATEWAYNAME' => 'required|string',
            'BANKNAME' => 'required|string',
            'PAYMENTMODE' => 'required|string',
            'CHECKSUMHASH' => 'required|string'
        ];
    }
}
