<?php namespace TGL\ShoeRequest\Http\Requests;

use TGL\Core\Http\Requests\Request;

class SetShoeRequestPriceRequest extends Request
{
    public function rules()
    {
        return [
            'shoe_request_number' => 'required',
            'price' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}