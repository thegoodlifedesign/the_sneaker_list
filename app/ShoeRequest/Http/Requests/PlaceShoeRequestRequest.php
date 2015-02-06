<?php namespace TGL\ShoeRequest\Http\Requests;

use TGL\Core\Http\Requests\Request;

class PlaceShoeRequestRequest extends Request
{
    public function rules()
    {
        return [
            'brand' => 'required',
            'model' => 'required',
            'size' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}