<?php

namespace App\Http\Requests;

use App\Rules\ProductCheckPrice;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'name'=>['required','min:3','max:225'],
            'price'=>['required','regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/',new ProductCheckPrice($this->discount)],
            'discount'=>['nullable','regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'],
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Məhsulun Adı Boş Buraxıla Bilməz !',
            'name.min'=>'Məhsulun Adı Minimum 3 Simvol Olmalıdır!',
            'name.min'=>'Məhsulun Adı Maksimum 225 Simvol Olmalıdır!',
            'price.required'=>'Məsulun Qiyməti Qeyd Olunmayıb !',
            'price.regex'=>'Məsulun Qiyməti Düzgün Qeyd Olunmayıb !',
            'discount.regex'=>'Endirim Qiyməti Düzgün Qeyd Olunmayıb !',
          
        ];
    }
}
