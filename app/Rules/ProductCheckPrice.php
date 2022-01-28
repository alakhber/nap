<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ProductCheckPrice implements Rule
{
    private $discount ;

    public function __construct($discount)
    {
        $this->discount = $discount ?? 0;
    }

    public function passes($attribute, $value)
    {
        if($value-$this->discount>0){
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Endirim qiyməti Məhsulun qiymətindən böyük ola bilməz';
    }
}
